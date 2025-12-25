<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\DB;
use App\Services\ID3DecisionTree;

class ProductController extends Controller
{
    // =========================================================================
    // 1. HALAMAN UTAMA & INPUT
    // =========================================================================
    
    public function index()
    {
        return view('input-upload');
    }

    // =========================================================================
    // 2. PROSES UPLOAD CSV
    // =========================================================================

    public function uploadCsv(Request $request)
    {
        $request->validate([ 'file_csv' => 'required|file|mimes:csv,txt' ]);

        $file = $request->file('file_csv');
        $fileName = $file->getClientOriginalName();
        
        // Bersihkan data lama dengan nama file yang sama (Reset)
        History::where('nama_file', $fileName)->delete();

        $path = $file->getRealPath();
        $file_handle = fopen($path, 'r');
        fgetcsv($file_handle); // Skip Header Row

        $semua_hasil = [];
        
        // Load ID3 model jika ada
        $modelPath = storage_path('app/id3_model.json');
        $classifier = null;
        if (file_exists($modelPath)) {
            try {
                $modelData = json_decode(file_get_contents($modelPath), true);
                $classifier = new ID3DecisionTree();
                // Load trained tree dari file
                $reflection = new \ReflectionClass($classifier);
                $treeProperty = $reflection->getProperty('tree');
                $treeProperty->setAccessible(true);
                $treeProperty->setValue($classifier, $modelData['tree']);
                
                $featureNamesProperty = $reflection->getProperty('featureNames');
                $featureNamesProperty->setAccessible(true);
                $featureNamesProperty->setValue($classifier, $modelData['feature_names']);
            } catch (\Exception $e) {
                $classifier = null;
            }
        }

        while (($row = fgetcsv($file_handle)) !== false) {
            // Validasi baris data minimal 5 kolom (Nama, Kategori, Kelas, Performa, Durasi)
            if (count($row) < 5) continue;

            $nama       = $row[0] ?? 'Tanpa Nama';  // Kolom 1: Nama Produk
            $kategori   = $row[1] ?? '-';            // Kolom 2: Kategori
            $kelas      = $row[2] ?? '-';            // Kolom 3: Kelas Harga
            $performa   = $row[3] ?? '-';            // Kolom 4: Performa
            $durasi     = $row[4] ?? '-';            // Kolom 5: Durasi Endap
            $csvLabel   = $row[5] ?? null;           // Kolom 6 (opsional): Target Class untuk training

            // Encode data untuk prediksi
            $fiturPrediksi = [
                $this->encodeKategori($kategori),
                $this->encodeKelas($kelas),
                $this->encodePerforma($performa),
                $this->encodeDurasi($durasi)
            ];

            // Tentukan Status (Prediksi vs Manual)
            $finalStatus = null;
            if (!empty($csvLabel)) {
                $finalStatus = $csvLabel; 
            } elseif ($classifier) {
                try { $finalStatus = $classifier->predict($fiturPrediksi); } catch (\Exception $e) { $finalStatus = null; }
            }

            // Jika AI gagal/tidak ada, pakai Logika If-Else Manual
            if ($finalStatus === null) {
                $finalStatus = $this->logikaManual($performa, $durasi);
            }

            $props = $this->getStatusProps($finalStatus);

            // Simpan ke Database
            History::create([
                'nama_produk'   => $nama,
                'kategori'      => $kategori,
                'kelas_harga'   => $kelas,
                'performa_jual' => $performa,
                'durasi_endap'  => $durasi,
                'status'        => $finalStatus,
                'rekomendasi'   => $props['saran'],
                'warna'         => $props['warna'],
                'nama_file'     => $fileName
            ]);

            // Data array untuk session (feedback instan)
            $semua_hasil[] = [
                'nama' => $nama, 'kategori' => $kategori, 'kelas' => $kelas,
                'performa' => $performa, 'durasi' => $durasi, 'status' => $finalStatus,
                'saran' => $props['saran'], 'warna' => $props['warna']
            ];
        }
        fclose($file_handle);

        // Redirect dengan session flash data
        return redirect()->route('hasil.analisa')
            ->with('success', 'Data berhasil diproses dan disimpan.')
            ->with('last_uploaded_file', $fileName);
    }

    // =========================================================================
    // 3. HASIL ANALISA (UPDATED)
    // =========================================================================

    public function hasilAnalisa(Request $request) 
    { 
        // 1. Ambil daftar file unik untuk Dropdown Filter
        $files = History::select('nama_file', DB::raw('MAX(created_at) as tgl_upload'))
                    ->groupBy('nama_file')
                    ->orderBy('tgl_upload', 'desc')
                    ->get();

        // 2. Tentukan File mana yang akan ditampilkan
        $selected_file = null;

        // Prioritas A: User memilih via filter
        if ($request->has('file')) {
            $selected_file = $request->query('file');
        } 
        // Prioritas B: User baru saja upload (ambil dari session)
        elseif (session()->has('last_uploaded_file')) {
            $selected_file = session('last_uploaded_file');
        } 
        // Prioritas C: Default (ambil file terbaru di DB)
        elseif ($files->isNotEmpty()) {
            $selected_file = $files->first()->nama_file;
        }

        // 3. Ambil Data Detail dari Database
        $data_mentah = collect([]); 
        if ($selected_file) {
            $data_mentah = History::where('nama_file', $selected_file)->get();
        }

        // 4. Mapping Data Database ke Format View
        // Kita sesuaikan nama field DB (nama_produk) dengan nama variabel di View ($row['nama'])
        $data_formatted = $data_mentah->map(function($item) {
            return [
                'nama'     => $item->nama_produk,
                'kategori' => $item->kategori,
                'kelas'    => $item->kelas_harga,
                'performa' => $item->performa_jual,
                'durasi'   => $item->durasi_endap,
                'status'   => $item->status,
                'warna'    => $item->warna ?? 'secondary', // Ambil dari DB atau default
                'saran'    => $item->rekomendasi ?? '-'     // Ambil dari DB atau strip
            ];
        });

        return view('hasil-analisa', [
            'files'         => $files,
            'selected_file' => $selected_file,
            'data'          => $data_formatted
        ]);
    }

    // =========================================================================
    // 4. VISUALISASI TREE (PROSES FILE)
    // =========================================================================

    public function prosesFile(Request $request)
    {
        $fileName = $request->query('file');
        
        if (!$fileName) {
            return redirect('/')->with('error', 'Parameter file tidak ditemukan.');
        }

        $histories = History::where('nama_file', $fileName)->get();
        if ($histories->isEmpty()) {
            return redirect('/')->with('error', 'Data tidak ditemukan untuk file tersebut.');
        }

        $samples = [];
        $labels = [];
        foreach ($histories as $h) {
            $samples[] = [
                $this->encodeKategori($h->kategori),
                $this->encodeKelas($h->kelas_harga),
                $this->encodePerforma($h->performa_jual),
                $this->encodeDurasi($h->durasi_endap)
            ];
            $labels[] = $h->status; 
        }

        $entropyGain = $this->hitungEntropyDanGainLengkap($samples, $labels);
        $treeStructure = $this->bangunStrukturPohon($samples, $labels);

        return view('pemrosesan-file', [
            'fileName' => $fileName,
            'totalData' => count($labels),
            'entropyGain' => $entropyGain,
            'treeStructure' => $treeStructure,
            'rawData' => $histories
        ]);
    }

    // =========================================================================
    // 5. RIWAYAT & HAPUS DATA
    // =========================================================================

    public function riwayat(Request $request) 
    { 
        $query = History::query();
        if ($request->has('file')) {
            $query->where('nama_file', $request->query('file'));
        }
        
        // Ambil waktu upload untuk setiap file (file paling baru)
        $fileTimestamps = History::select('nama_file', \DB::raw('MAX(created_at) as latest_upload'))
            ->groupBy('nama_file')
            ->get()
            ->pluck('latest_upload', 'nama_file');
        
        return view('riwayat', [
            'histories' => $query->latest()->get(),
            'files' => History::distinct()->pluck('nama_file'),
            'fileTimestamps' => $fileTimestamps
        ]); 
    }

    public function hapusByFile(Request $request) 
    { 
        // Support hapus via Form (POST/DELETE) atau URL Query (GET - tidak disarankan tapi jaga-jaga)
        $file = $request->input('file') ?? $request->query('file');
        
        if($file) {
            History::where('nama_file', $file)->delete();
            return redirect()->route('riwayat.index')->with('success', 'Riwayat file "' . $file . '" berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Nama file tidak valid.'); 
    }

    public function hapusSemua() 
    { 
        History::truncate(); 
        return redirect()->route('riwayat.index')->with('success', 'Semua data riwayat berhasil dibersihkan.'); 
    }

    // =========================================================================
    // 6. EVALUASI MODEL (ID3 TRAINING)
    // =========================================================================

    public function evaluasi()
    {
        $histories = History::whereNotNull('status')->orderBy('created_at', 'asc')->get();
        $total = $histories->count();
        
        if ($total < 5) {
            return view('evaluasi', ['enough_data' => false, 'message' => 'Data riwayat minimal 5 baris untuk evaluasi.']);
        }

        $samples = []; $labels = [];
        foreach ($histories as $h) {
            $samples[] = [
                $this->encodeKategori($h->kategori),
                $this->encodeKelas($h->kelas_harga),
                $this->encodePerforma($h->performa_jual),
                $this->encodeDurasi($h->durasi_endap)
            ];
            $labels[] = $h->status;
        }

        // Split Data 80:20
        $indices = range(0, $total - 1); 
        shuffle($indices);
        $trainSize = max(1, (int) round($total * 0.8));
        
        $trainSamples = []; $trainLabels = [];
        $testSamples = []; $testLabels = [];

        foreach ($indices as $idx => $originalKey) {
            if ($idx < $trainSize) {
                $trainSamples[] = $samples[$originalKey];
                $trainLabels[] = $labels[$originalKey];
            } else {
                $testSamples[] = $samples[$originalKey];
                $testLabels[] = $labels[$originalKey];
            }
        }

        // Train Model dengan ID3 Algorithm
        $classifier = new ID3DecisionTree();
        $classifier->setMaxDepth(10);
        $classifier->setMinSamplesSplit(2);
        $classifier->train($trainSamples, $trainLabels, ['Kategori', 'Kelas', 'Performa', 'Durasi']);
        
        // Simpan Model sebagai JSON
        $modelData = [
            'tree' => $classifier->getTree(),
            'feature_names' => ['Kategori', 'Kelas', 'Performa', 'Durasi'],
            'trained_at' => now()->toDateTimeString()
        ];
        file_put_contents(storage_path('app/id3_model.json'), json_encode($modelData, JSON_PRETTY_PRINT));

        // Test Model
        $correct = 0; 
        $confusion = [];
        $uniqueLabels = array_unique($labels);
        foreach ($uniqueLabels as $l) { $confusion[$l] = ['TP' => 0, 'FP' => 0, 'FN' => 0, 'TN' => 0]; }

        foreach ($testSamples as $k => $fitur) {
            $true = $testLabels[$k];
            $pred = $classifier->predict($fitur);
            
            if (!isset($confusion[$pred])) {
                $confusion[$pred] = ['TP' => 0, 'FP' => 0, 'FN' => 0, 'TN' => 0];
            }
            
            if ($pred === $true) { 
                $correct++; 
                $confusion[$true]['TP']++; 
            } else { 
                $confusion[$true]['FN']++; 
                $confusion[$pred]['FP']++; 
            }
        }

        $testCount = count($testSamples);
        $accuracy = $testCount > 0 ? $correct / $testCount : 0;

        // Hitung metrics tambahan per class
        $classMetrics = [];
        foreach ($confusion as $class => $metrics) {
            $precision = ($metrics['TP'] + $metrics['FP']) > 0 
                ? $metrics['TP'] / ($metrics['TP'] + $metrics['FP']) 
                : 0;
            $recall = ($metrics['TP'] + $metrics['FN']) > 0 
                ? $metrics['TP'] / ($metrics['TP'] + $metrics['FN']) 
                : 0;
            $f1 = ($precision + $recall) > 0 
                ? 2 * ($precision * $recall) / ($precision + $recall) 
                : 0;
            
            $classMetrics[$class] = [
                'precision' => round($precision, 4),
                'recall' => round($recall, 4),
                'f1_score' => round($f1, 4)
            ];
        }

        return view('evaluasi', [
            'enough_data' => true,
            'total' => $total,
            'train_count' => count($trainSamples),
            'test_count' => $testCount,
            'accuracy' => $accuracy,
            'confusion' => $confusion,
            'class_metrics' => $classMetrics,
            'algorithm' => 'ID3 Decision Tree'
        ]);
    }

    // =========================================================================
    // 7. HELPER FUNCTIONS (ALGORITMA ID3 & LOGIKA)
    // =========================================================================

    /**
     * Bangun struktur pohon ID3 untuk visualisasi
     * Menggunakan algoritma ID3 murni dengan Information Gain
     */
    private function bangunStrukturPohon($samples, $labels, $depth = 0, $availableFeatures = null)
    {
        if ($availableFeatures === null) {
            $availableFeatures = range(0, 3); // 4 fitur: Kategori, Kelas, Performa, Durasi
        }

        $total = count($labels);
        $counts = array_count_values($labels);
        $entropy = $this->hitungEntropy($counts, $total);
        
        $node = [
            'label' => 'Node',
            'total' => $total,
            'distribution' => $counts,
            'entropy' => $entropy,
            'children' => [],
            'css_class' => 'btn-light'
        ];

        // Stopping Criteria 1: Pure node (entropy = 0)
        if ($entropy == 0) {
            $finalLabel = array_keys($counts)[0];
            $node['label'] = $finalLabel . " (Pure)";
            $node['is_leaf'] = true;
            
            $props = $this->getStatusProps($finalLabel);
            $node['css_class'] = 'btn-' . $props['warna'];
            return $node;
        }

        // Stopping Criteria 2: Sample terlalu sedikit
        if ($total < 2) {
            $finalLabel = array_keys($counts, max($counts))[0];
            $node['label'] = $finalLabel . " (Min)";
            $node['is_leaf'] = true;
            
            $props = $this->getStatusProps($finalLabel);
            $node['css_class'] = 'btn-' . $props['warna'];
            return $node;
        }

        // Stopping Criteria 3: Max depth
        if ($depth >= 5) {
            $finalLabel = array_keys($counts, max($counts))[0];
            $node['label'] = $finalLabel . " (Depth)";
            $node['is_leaf'] = true;
            
            $props = $this->getStatusProps($finalLabel);
            $node['css_class'] = 'btn-' . $props['warna'];
            return $node;
        }

        // Stopping Criteria 4: Tidak ada fitur tersisa
        if (empty($availableFeatures)) {
            $finalLabel = array_keys($counts, max($counts))[0];
            $node['label'] = $finalLabel . " (No Features)";
            $node['is_leaf'] = true;
            
            $props = $this->getStatusProps($finalLabel);
            $node['css_class'] = 'btn-' . $props['warna'];
            return $node;
        }

        $features = ['Kategori', 'Kelas', 'Performa', 'Durasi'];
        
        // Cari best split menggunakan Information Gain (ID3)
        $bestSplit = null;
        $bestIdx = -1;
        $bestGain = -1;

        foreach ($availableFeatures as $i) {
            $split = $this->findBestSplitID3($samples, $labels, $i, $entropy);
            if ($split['information_gain'] > $bestGain) {
                $bestSplit = $split;
                $bestIdx = $i;
                $bestGain = $split['information_gain'];
            }
        }

        // Jika tidak ada gain positif, buat leaf
        if (!$bestSplit || $bestSplit['information_gain'] <= 0) {
            $finalLabel = array_keys($counts, max($counts))[0];
            $node['label'] = $finalLabel . " (No Gain)";
            $node['is_leaf'] = true;
            $props = $this->getStatusProps($finalLabel);
            $node['css_class'] = 'btn-' . $props['warna'];
            return $node;
        }

        // Buat internal node
        $node['label'] = $features[$bestIdx] . " (IG: " . number_format($bestSplit['information_gain'], 4) . ")";
        $node['is_leaf'] = false;
        $node['css_class'] = 'btn-secondary';
        
        $th = $bestSplit['threshold'];
        $thLabel = $this->decodeValue($bestIdx, $th);

        // Split data
        $lS = []; $lL = [];
        $rS = []; $rL = [];
        foreach ($samples as $k => $s) {
            if ($s[$bestIdx] < $th) {
                $lS[] = $s; $lL[] = $labels[$k];
            } else {
                $rS[] = $s; $rL[] = $labels[$k];
            }
        }

        // Remove fitur yang sudah dipakai (pure ID3)
        $remainingFeatures = array_diff($availableFeatures, [$bestIdx]);

        // Build child nodes
        if (count($lL) > 0) {
            $childL = $this->bangunStrukturPohon($lS, $lL, $depth + 1, $remainingFeatures);
            $childL['condition'] = "< " . $thLabel; 
            $node['children'][] = $childL;
        }
        if (count($rL) > 0) {
            $childR = $this->bangunStrukturPohon($rS, $rL, $depth + 1, $remainingFeatures);
            $childR['condition'] = ">= " . $thLabel;
            $node['children'][] = $childR;
        }

        return $node;
    }

    /**
     * Hitung Entropy dan Information Gain lengkap untuk semua fitur
     * Sesuai dengan algoritma ID3 standar
     */
    private function hitungEntropyDanGainLengkap($samples, $labels)
    {
        $total = count($labels);
        $labelCounts = array_count_values($labels);
        $entropyRoot = $this->hitungEntropy($labelCounts, $total);

        $results = [
            'entropy_root' => $entropyRoot,
            'label_distribution' => $labelCounts, 
            'splits' => [],
            'algorithm' => 'ID3 (Information Gain)'
        ];

        $features = ['Kategori', 'Kelas Harga', 'Performa Jual', 'Durasi Endap'];
        for ($i = 0; $i < 4; $i++) {
            $split = $this->findBestSplitID3($samples, $labels, $i, $entropyRoot);
            $split['fitur'] = $features[$i];
            $results['splits'][] = $split;
        }

        // Sort berdasarkan Information Gain (descending)
        usort($results['splits'], function($a, $b) {
            return $b['information_gain'] <=> $a['information_gain'];
        });

        return $results;
    }

    /**
     * Find best split untuk satu fitur menggunakan ID3
     * ID3 menggunakan Information Gain = Entropy(parent) - Weighted Entropy(children)
     */
    private function findBestSplitID3($samples, $labels, $featureIndex, $entropyRoot)
    {
        $values = array_column($samples, $featureIndex);
        $unique = array_values(array_unique($values));
        sort($unique);
        
        $total = count($labels);
        $best = ['information_gain' => -1, 'threshold' => null];

        foreach ($unique as $val) {
            $leftLabels = []; 
            $rightLabels = [];
            
            foreach ($samples as $k => $s) {
                if ($s[$featureIndex] < $val) {
                    $leftLabels[] = $labels[$k];
                } else {
                    $rightLabels[] = $labels[$k];
                }
            }

            $lCount = count($leftLabels); 
            $rCount = count($rightLabels);
            
            // Skip jika split tidak menghasilkan pembagian
            if ($lCount == 0 || $rCount == 0) continue;

            // Hitung weighted entropy setelah split
            $lEnt = $this->hitungEntropy(array_count_values($leftLabels), $lCount);
            $rEnt = $this->hitungEntropy(array_count_values($rightLabels), $rCount);
            
            $weightedEntropy = ($lCount/$total)*$lEnt + ($rCount/$total)*$rEnt;
            
            // Information Gain (ID3)
            $gain = $entropyRoot - $weightedEntropy;

            if ($gain > $best['information_gain']) {
                $best = [
                    'threshold' => $val,
                    'threshold_label' => $this->decodeValue($featureIndex, $val),
                    'information_gain' => round($gain, 6),
                    'weighted_entropy' => round($weightedEntropy, 6),
                    'left_entropy' => round($lEnt, 6),
                    'right_entropy' => round($rEnt, 6),
                    'left_samples' => $lCount,
                    'right_samples' => $rCount
                ];
            }
        }
        
        if ($best['information_gain'] == -1) {
            $best = [
                'threshold' => 0, 
                'threshold_label' => '-', 
                'information_gain' => 0,
                'weighted_entropy' => $entropyRoot,
                'left_entropy' => 0,
                'right_entropy' => 0,
                'left_samples' => 0,
                'right_samples' => $total
            ];
        }
        
        return $best;
    }

    /**
     * Hitung Entropy menggunakan formula Shannon
     * Entropy = -Σ(p_i * log2(p_i))
     * 
     * Entropy = 0 → Pure (semua data 1 class)
     * Entropy = 1 → Maximum impurity (distribusi merata)
     */
    private function hitungEntropy($counts, $total) {
        if ($total == 0) return 0;
        
        $entropy = 0;
        foreach ($counts as $c) { 
            if ($c == 0) continue;
            $p = $c / $total; 
            $entropy -= $p * log($p, 2); 
        }
        
        return round($entropy, 6);
    }

    private function encodeKategori($val) { return crc32(strtolower(trim($val))); }
    private function encodeKelas($val) {
        $v = strtolower(trim($val));
        if ($v == 'premium') return 3; if ($v == 'standar') return 2; if ($v == 'ekonomis') return 1; return 0;
    }
    private function encodePerforma($val) {
        $v = strtolower(trim($val));
        if ($v == 'laris') return 3; if ($v == 'sedang') return 2; if ($v == 'macet') return 1; return 0;
    }
    private function encodeDurasi($val) {
        $v = strtolower(trim($val));
        if ($v == 'lama') return 3; if ($v == 'normal') return 2; if ($v == 'baru') return 1; return 0;
    }

    private function decodeValue($featureIndex, $val) {
        if ($featureIndex == 1) return ($val == 3 ? "Premium" : ($val == 2 ? "Standar" : "Ekonomis"));
        if ($featureIndex == 2) return ($val == 3 ? "Laris" : ($val == 2 ? "Sedang" : "Macet"));
        if ($featureIndex == 3) return ($val == 3 ? "Lama" : ($val == 2 ? "Normal" : "Baru"));
        return $val;
    }

    private function logikaManual($performa, $durasi) {
        $p = strtolower($performa); $d = strtolower($durasi);
        if ($p == 'laris' && $d == 'baru') return 'Restock Segera';
        if ($p == 'macet' && $d == 'lama') return 'Stok Mati';
        if ($p == 'macet' && $d == 'normal') return 'Perlu Evaluasi';
        if ($p == 'sedang') return 'Restock Terjadwal';
        return 'Stok Optimal';
    }

    private function getStatusProps($status) {
        $s = strtolower(trim($status));
        if (strpos($s, 'segera') !== false || strpos($s, 'prioritas') !== false) return ['saran' => 'Produksi/restock ASAP! Produk laris dan stok baru.', 'warna' => 'success'];
        if (strpos($s, 'mati') !== false || strpos($s, 'dead') !== false)      return ['saran' => 'STOP produksi. Clearance sale/diskon besar.', 'warna' => 'dark'];
        if (strpos($s, 'evaluasi') !== false || strpos($s, 'warning') !== false)   return ['saran' => 'Evaluasi harga/promosi. Penjualan macet.', 'warna' => 'warning text-dark'];
        if (strpos($s, 'terjadwal') !== false || strpos($s, 'restock') !== false)   return ['saran' => 'Restock sesuai jadwal rutin. Penjualan steady.', 'warna' => 'info'];
        return ['saran' => 'Maintain stok saat ini. Kondisi sudah baik.', 'warna' => 'secondary'];
    }
}