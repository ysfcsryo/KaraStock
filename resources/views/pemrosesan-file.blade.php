@extends('layout.main')

@section('page_title', 'Visualisasi Decision Tree & Entropy')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-primary mb-1">
                <i class="bi bi-diagram-3-fill"></i> Analisa File: {{ $fileName }}
            </h4>
            <small class="text-muted">Total Data: <strong>{{ $totalData }}</strong> baris</small>
        </div>
        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(empty($treeStructure['children']) && $totalData > 1)
    <div class="alert alert-warning shadow-sm border-0 d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
        <div>
            <strong>Pohon hanya memiliki 1 Node (Root).</strong><br>
            Hal ini terjadi karena Entropy = 0 (Semua data memiliki keputusan yang sama) atau Information Gain terlalu kecil untuk memecah data.
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <ul class="nav nav-tabs mb-3" id="treeTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="grafik-tab" data-bs-toggle="tab" data-bs-target="#grafik" type="button">
                        <i class="bi bi-diagram-3"></i> Grafik Pohon
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="tabel-entropy-tab" data-bs-toggle="tab" data-bs-target="#tabel-entropy" type="button">
                        <i class="bi bi-calculator"></i> Hitungan Entropy
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="treeTabContent">
                <div class="tab-pane fade show active" id="grafik" role="tabpanel">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body bg-white text-center" style="min-height: 500px; overflow: auto; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 20px 20px;">
                            <svg id="treeSvg" width="1000" height="600"></svg>
                        </div>
                        <div class="card-footer bg-light small text-muted">
                            <i class="bi bi-info-circle"></i> <strong>Legenda:</strong> 
                            <span class="badge bg-success mx-1">Prioritas</span>
                            <span class="badge bg-dark mx-1">Dead Stock</span>
                            <span class="badge bg-danger mx-1">Warning</span>
                            <span class="badge bg-info mx-1">Restock</span>
                            <span class="badge bg-secondary mx-1">Node Cabang</span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tabel-entropy" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success-subtle text-success fw-bold">
                            <i class="bi bi-table"></i> Detail Information Gain (Root Level)
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fitur</th>
                                            <th>Threshold</th>
                                            <th>Gain</th>
                                            <th>Keputusan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($entropyGain['splits'] ?? [] as $split)
                                        <tr class="{{ isset($entropyGain['best_root']) && $split['fitur'] === $entropyGain['best_root']['fitur'] ? 'table-success fw-bold' : '' }}">
                                            <td>{{ $split['fitur'] }}</td>
                                            <td>&lt; {{ $split['threshold_label'] }}</td>
                                            <td>
                                                <span class="badge {{ $split['information_gain'] > 0 ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $split['information_gain'] }}
                                                </span>
                                            </td>
                                            <td>
                                                @if(isset($entropyGain['best_root']) && $split['fitur'] === $entropyGain['best_root']['fitur'])
                                                    <i class="bi bi-check-circle-fill text-success"></i> Root
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="4" class="text-center text-muted">Tidak ada data perhitungan.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="fw-bold text-secondary text-uppercase small mb-3">Statistik Awal</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Entropy Root</span>
                        <span class="fw-bold fs-5 text-primary">{{ $entropyGain['entropy_root'] ?? 0 }}</span>
                    </div>
                    <hr>
                    <small class="text-muted d-block mb-2">Distribusi Target Class:</small>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($entropyGain['label_distribution'] ?? [] as $lbl => $cnt)
                            <span class="badge bg-light text-dark border">{{ $lbl }}: {{ $cnt }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="max-height: 500px; display: flex; flex-direction: column;">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold m-0 text-dark"><i class="bi bi-database-check"></i> Cek Data Masuk</h6>
                    <span class="badge bg-primary rounded-pill">{{ count($rawData ?? []) }}</span>
                </div>
                
                <div class="card-body p-0" style="overflow-y: auto; flex-grow: 1;">
                    <table class="table table-sm table-hover mb-0 small" style="font-size: 0.8rem;">
                        <thead class="table-light sticky-top" style="top: 0; z-index: 2;">
                            <tr>
                                <th>Produk</th>
                                <th>Fitur (K/K/P/D)</th>
                                <th>Target</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rawData ?? [] as $row)
                            <tr>
                                <td class="text-truncate" style="max-width: 100px;" title="{{ $row->nama_produk }}">
                                    {{ $row->nama_produk }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span><i class="bi bi-tag text-muted"></i> {{ $row->kategori }}</span>
                                        <span><i class="bi bi-wallet2 text-muted"></i> {{ $row->kelas_harga }}</span>
                                        <span><i class="bi bi-graph-up text-muted"></i> {{ $row->performa_jual }}</span>
                                        <span><i class="bi bi-hourglass text-muted"></i> {{ $row->durasi_endap }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badgeColor = 'bg-secondary';
                                        $s = strtolower($row->status);
                                        if(strpos($s, 'prioritas')!==false) $badgeColor='bg-success';
                                        elseif(strpos($s, 'dead')!==false) $badgeColor='bg-dark';
                                        elseif(strpos($s, 'warning')!==false) $badgeColor='bg-danger';
                                        elseif(strpos($s, 'restock')!==false) $badgeColor='bg-info';
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">{{ $row->status }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">
                                    <i class="bi bi-inbox-fill fs-1 d-block mb-2"></i>
                                    Data Kosong.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Mengambil data dari PHP dengan aman (Default null jika undefined)
    const treeData = @json($treeStructure ?? null);

    // Debugging: Lihat data di Console Browser (Tekan F12)
    console.log("Tree Structure Data:", treeData);

    function drawTree() {
        const svg = document.getElementById('treeSvg');
        
        // --- 1. Pengecekan Keamanan (Safety Check) ---
        if(!svg) return;

        // Jika data kosong atau null, tampilkan pesan error visual
        if (!treeData || Object.keys(treeData).length === 0) {
            console.error("Data Tree Kosong/Null!");
            svg.innerHTML = `
                <text x="50%" y="45%" text-anchor="middle" fill="#dc2626" font-family="sans-serif" font-weight="bold" font-size="16">
                    Gagal Memuat Visualisasi
                </text>
                <text x="50%" y="50%" text-anchor="middle" fill="#6b7280" font-family="sans-serif" font-size="12">
                    Data struktur pohon tidak ditemukan atau kosong.
                </text>
            `;
            return;
        }

        svg.innerHTML = '';
        
        // --- 2. Konfigurasi Ukuran & Variabel ---
        const nodeRadius = 35;
        const levelHeight = 120;
        
        let nodes = [];
        let links = [];
        let idCounter = 0;

        // --- 3. Fungsi Rekursif (Traverse) ---
        function traverse(node, x, y, level, availableWidth) {
            const currentId = idCounter++;
            const nodeObj = { id: currentId, x, y, data: node };
            nodes.push(nodeObj);

            if (node.children && node.children.length > 0) {
                const childCount = node.children.length;
                const sectionWidth = availableWidth / childCount;
                
                node.children.forEach((child, index) => {
                    const childX = x - (availableWidth / 2) + (sectionWidth / 2) + (index * sectionWidth);
                    const childY = y + levelHeight;
                    
                    const childId = traverse(child, childX, childY, level + 1, sectionWidth);
                    
                    links.push({
                        source: nodeObj,
                        targetX: childX,
                        targetY: childY,
                        condition: child.condition
                    });
                });
            }
            return currentId;
        }

        // --- 4. Mulai Menggambar ---
        // Mulai dari tengah canvas (x=500, y=60)
        traverse(treeData, 500, 60, 1, 900);

        // A. Gambar Garis (Links)
        links.forEach(l => {
            const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            line.setAttribute('x1', l.source.x);
            line.setAttribute('y1', l.source.y + nodeRadius);
            line.setAttribute('x2', l.targetX);
            line.setAttribute('y2', l.targetY - nodeRadius);
            line.setAttribute('stroke', '#cbd5e1');
            line.setAttribute('stroke-width', '2');
            svg.appendChild(line);

            // Label Kondisi (e.g., < Laris)
            if(l.condition) {
                const midX = (l.source.x + l.targetX) / 2;
                const midY = (l.source.y + nodeRadius + l.targetY - nodeRadius) / 2;
                
                // Background Putih untuk teks
                const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
                const width = l.condition.length * 7 + 10;
                rect.setAttribute('x', midX - width/2);
                rect.setAttribute('y', midY - 10);
                rect.setAttribute('width', width);
                rect.setAttribute('height', 20);
                rect.setAttribute('fill', 'white');
                rect.setAttribute('stroke', '#e2e8f0');
                rect.setAttribute('rx', 4);
                svg.appendChild(rect);

                // Teks Kondisi
                const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                text.setAttribute('x', midX);
                text.setAttribute('y', midY + 4);
                text.setAttribute('text-anchor', 'middle');
                text.setAttribute('font-size', '11px');
                text.setAttribute('fill', '#64748b');
                text.setAttribute('font-weight', 'bold');
                text.textContent = l.condition;
                svg.appendChild(text);
            }
        });

        // B. Gambar Nodes (Lingkaran)
        nodes.forEach(n => {
            const g = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            
            // Tentukan Warna
            let fillColor = '#64748b'; 
            let strokeColor = '#475569';
            const cssClass = n.data.css_class || '';

            if (cssClass.includes('success')) { fillColor = '#10b981'; strokeColor = '#059669'; } 
            else if (cssClass.includes('danger')) { fillColor = '#ef4444'; strokeColor = '#dc2626'; } 
            else if (cssClass.includes('dark')) { fillColor = '#1f2937'; strokeColor = '#000000'; } 
            else if (cssClass.includes('info')) { fillColor = '#3b82f6'; strokeColor = '#2563eb'; } 
            else if (cssClass.includes('warning')) { fillColor = '#f59e0b'; strokeColor = '#d97706'; } 
            else if (n.y === 60) { fillColor = '#4f46e5'; strokeColor = '#4338ca'; } // Root

            const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            circle.setAttribute('cx', n.x);
            circle.setAttribute('cy', n.y);
            circle.setAttribute('r', nodeRadius);
            circle.setAttribute('fill', fillColor);
            circle.setAttribute('stroke', strokeColor);
            circle.setAttribute('stroke-width', 3);
            circle.style.filter = "drop-shadow(0px 3px 3px rgba(0,0,0,0.2))";

            g.appendChild(circle);

            // Label Node (Nama Fitur / Keputusan)
            const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            text.setAttribute('x', n.x);
            text.setAttribute('y', n.y + 4);
            text.setAttribute('text-anchor', 'middle');
            text.setAttribute('fill', 'white');
            text.setAttribute('font-size', '10px');
            text.setAttribute('font-family', 'sans-serif');
            text.setAttribute('font-weight', 'bold');
            
            let labelText = n.data.label || '?';
            // Bersihkan teks Gain agar rapi
            if(labelText.includes('(')) labelText = labelText.split('(')[0].trim();
            
            // Text Wrapping sederhana
            if(labelText.length > 8 && labelText.includes(' ')) {
                const parts = labelText.split(' ');
                const tspan1 = document.createElementNS('http://www.w3.org/2000/svg', 'tspan');
                tspan1.setAttribute('x', n.x);
                tspan1.setAttribute('dy', '-0.4em');
                tspan1.textContent = parts[0];
                
                const tspan2 = document.createElementNS('http://www.w3.org/2000/svg', 'tspan');
                tspan2.setAttribute('x', n.x);
                tspan2.setAttribute('dy', '1.2em');
                tspan2.textContent = parts[1];
                
                text.appendChild(tspan1);
                text.appendChild(tspan2);
            } else {
                text.textContent = labelText;
            }

            g.appendChild(text);

            // Info Jumlah Data
            const countText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            countText.setAttribute('x', n.x);
            countText.setAttribute('y', n.y + 50);
            countText.setAttribute('text-anchor', 'middle');
            countText.setAttribute('fill', '#64748b');
            countText.setAttribute('font-size', '11px');
            countText.setAttribute('font-weight', 'bold');
            countText.textContent = `Data: ${n.data.total}`;
            
            g.appendChild(countText);
            svg.appendChild(g);
        });
    }

    document.addEventListener('DOMContentLoaded', drawTree);
</script>

@endsection