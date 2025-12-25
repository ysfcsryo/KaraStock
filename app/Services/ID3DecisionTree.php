<?php

namespace App\Services;

/**
 * Implementasi Algoritma Decision Tree ID3 (Iterative Dichotomiser 3)
 * 
 * Algoritma ini menggunakan:
 * - Entropy untuk mengukur ketidakpastian/impurity
 * - Information Gain untuk memilih atribut terbaik
 * - Recursive tree building
 */
class ID3DecisionTree
{
    private $tree = null;
    private $featureNames = [];
    private $maxDepth = 10;
    private $minSamplesSplit = 2;

    /**
     * Train model dengan dataset
     * 
     * @param array $samples Format: [[f1, f2, f3, ...], ...]
     * @param array $labels Format: [label1, label2, ...]
     * @param array $featureNames Nama fitur untuk tracking
     */
    public function train($samples, $labels, $featureNames = [])
    {
        $this->featureNames = $featureNames ?: range(0, count($samples[0]) - 1);
        
        // Build tree menggunakan ID3 algorithm
        $this->tree = $this->buildTree($samples, $labels, range(0, count($samples[0]) - 1), 0);
    }

    /**
     * Prediksi label untuk satu sample
     * 
     * @param array $sample Format: [f1, f2, f3, ...]
     * @return mixed Predicted label
     */
    public function predict($sample)
    {
        if ($this->tree === null) {
            throw new \Exception('Model belum di-train. Panggil train() terlebih dahulu.');
        }

        return $this->traverseTree($sample, $this->tree);
    }

    /**
     * Prediksi batch samples
     * 
     * @param array $samples Format: [[f1, f2, ...], ...]
     * @return array Predicted labels
     */
    public function predictBatch($samples)
    {
        $predictions = [];
        foreach ($samples as $sample) {
            $predictions[] = $this->predict($sample);
        }
        return $predictions;
    }

    /**
     * Build decision tree menggunakan algoritma ID3
     * 
     * @param array $samples Dataset samples
     * @param array $labels Dataset labels
     * @param array $availableFeatures Index fitur yang masih bisa digunakan
     * @param int $depth Current depth
     * @return array Tree node
     */
    private function buildTree($samples, $labels, $availableFeatures, $depth)
    {
        $labelCounts = array_count_values($labels);
        $totalSamples = count($labels);

        // Stopping criteria 1: Semua label sama (pure node)
        if (count($labelCounts) === 1) {
            return [
                'type' => 'leaf',
                'label' => array_keys($labelCounts)[0],
                'samples' => $totalSamples,
                'distribution' => $labelCounts,
                'entropy' => 0
            ];
        }

        // Stopping criteria 2: Tidak ada fitur tersisa
        if (empty($availableFeatures)) {
            return [
                'type' => 'leaf',
                'label' => $this->getMajorityClass($labelCounts),
                'samples' => $totalSamples,
                'distribution' => $labelCounts,
                'entropy' => $this->calculateEntropy($labelCounts, $totalSamples)
            ];
        }

        // Stopping criteria 3: Max depth tercapai
        if ($depth >= $this->maxDepth) {
            return [
                'type' => 'leaf',
                'label' => $this->getMajorityClass($labelCounts),
                'samples' => $totalSamples,
                'distribution' => $labelCounts,
                'entropy' => $this->calculateEntropy($labelCounts, $totalSamples)
            ];
        }

        // Stopping criteria 4: Jumlah sample terlalu sedikit
        if ($totalSamples < $this->minSamplesSplit) {
            return [
                'type' => 'leaf',
                'label' => $this->getMajorityClass($labelCounts),
                'samples' => $totalSamples,
                'distribution' => $labelCounts,
                'entropy' => $this->calculateEntropy($labelCounts, $totalSamples)
            ];
        }

        // Hitung entropy root (sebelum split)
        $entropyRoot = $this->calculateEntropy($labelCounts, $totalSamples);

        // Cari fitur terbaik menggunakan Information Gain (ID3)
        $bestFeature = $this->findBestFeature($samples, $labels, $availableFeatures, $entropyRoot);

        // Jika tidak ada gain, buat leaf node
        if ($bestFeature === null || $bestFeature['gain'] <= 0) {
            return [
                'type' => 'leaf',
                'label' => $this->getMajorityClass($labelCounts),
                'samples' => $totalSamples,
                'distribution' => $labelCounts,
                'entropy' => $entropyRoot
            ];
        }

        // Split data berdasarkan fitur terbaik
        $splits = $this->splitData($samples, $labels, $bestFeature['index'], $bestFeature['threshold']);

        // Buat internal node
        $node = [
            'type' => 'internal',
            'feature' => $bestFeature['index'],
            'feature_name' => $this->featureNames[$bestFeature['index']] ?? "Feature_{$bestFeature['index']}",
            'threshold' => $bestFeature['threshold'],
            'threshold_label' => $bestFeature['threshold_label'],
            'gain' => $bestFeature['gain'],
            'entropy' => $entropyRoot,
            'samples' => $totalSamples,
            'distribution' => $labelCounts,
            'children' => []
        ];

        // Recursive build untuk setiap split
        $remainingFeatures = array_diff($availableFeatures, [$bestFeature['index']]);

        foreach ($splits as $splitValue => $splitData) {
            if (empty($splitData['labels'])) continue;

            $childNode = $this->buildTree(
                $splitData['samples'],
                $splitData['labels'],
                $remainingFeatures,
                $depth + 1
            );
            
            $childNode['condition'] = $splitValue;
            $node['children'][$splitValue] = $childNode;
        }

        return $node;
    }

    /**
     * Hitung Entropy menggunakan formula Shannon
     * Entropy = -Σ(p_i * log2(p_i))
     * 
     * @param array $labelCounts Count setiap label
     * @param int $total Total samples
     * @return float Entropy value
     */
    private function calculateEntropy($labelCounts, $total)
    {
        if ($total == 0) return 0;

        $entropy = 0;
        foreach ($labelCounts as $count) {
            $probability = $count / $total;
            if ($probability > 0) {
                $entropy -= $probability * log($probability, 2);
            }
        }

        return round($entropy, 6);
    }

    /**
     * Cari fitur terbaik menggunakan Information Gain (ID3)
     * Information Gain = Entropy(parent) - Weighted Average Entropy(children)
     * 
     * @param array $samples Dataset samples
     * @param array $labels Dataset labels
     * @param array $availableFeatures Index fitur yang tersedia
     * @param float $entropyRoot Entropy parent node
     * @return array|null Best feature info
     */
    private function findBestFeature($samples, $labels, $availableFeatures, $entropyRoot)
    {
        $bestGain = -1;
        $bestFeature = null;
        $total = count($labels);

        foreach ($availableFeatures as $featureIndex) {
            // Ambil semua nilai unik untuk fitur ini
            $featureValues = array_column($samples, $featureIndex);
            $uniqueValues = array_unique($featureValues);

            // Untuk setiap nilai threshold yang mungkin
            foreach ($uniqueValues as $threshold) {
                $splits = $this->splitData($samples, $labels, $featureIndex, $threshold);
                
                // Hitung weighted entropy setelah split
                $weightedEntropy = 0;
                foreach ($splits as $splitData) {
                    $splitCount = count($splitData['labels']);
                    if ($splitCount == 0) continue;

                    $splitLabelCounts = array_count_values($splitData['labels']);
                    $splitEntropy = $this->calculateEntropy($splitLabelCounts, $splitCount);
                    
                    $weightedEntropy += ($splitCount / $total) * $splitEntropy;
                }

                // Hitung Information Gain
                $informationGain = $entropyRoot - $weightedEntropy;

                // Update best feature jika gain lebih besar
                if ($informationGain > $bestGain) {
                    $bestGain = $informationGain;
                    $bestFeature = [
                        'index' => $featureIndex,
                        'threshold' => $threshold,
                        'threshold_label' => $threshold,
                        'gain' => round($informationGain, 6)
                    ];
                }
            }
        }

        return $bestFeature;
    }

    /**
     * Split data berdasarkan fitur dan threshold
     * Untuk categorical: exact match
     * Untuk numerical: < threshold vs >= threshold
     * 
     * @param array $samples Dataset samples
     * @param array $labels Dataset labels
     * @param int $featureIndex Index fitur untuk split
     * @param mixed $threshold Nilai threshold
     * @return array Splits: ['left' => [...], 'right' => [...]]
     */
    private function splitData($samples, $labels, $featureIndex, $threshold)
    {
        $splits = [
            'left' => ['samples' => [], 'labels' => []],
            'right' => ['samples' => [], 'labels' => []]
        ];

        foreach ($samples as $i => $sample) {
            $featureValue = $sample[$featureIndex];
            
            // Split strategy: < threshold ke left, >= threshold ke right
            if ($featureValue < $threshold) {
                $splits['left']['samples'][] = $sample;
                $splits['left']['labels'][] = $labels[$i];
            } else {
                $splits['right']['samples'][] = $sample;
                $splits['right']['labels'][] = $labels[$i];
            }
        }

        return $splits;
    }

    /**
     * Traverse tree untuk prediksi
     * 
     * @param array $sample Sample untuk prediksi
     * @param array $node Current tree node
     * @return mixed Predicted label
     */
    private function traverseTree($sample, $node)
    {
        // Jika leaf node, return label
        if ($node['type'] === 'leaf') {
            return $node['label'];
        }

        // Jika internal node, traverse ke child yang sesuai
        $featureValue = $sample[$node['feature']];
        $threshold = $node['threshold'];

        // Tentukan arah traversal
        if ($featureValue < $threshold) {
            $direction = 'left';
        } else {
            $direction = 'right';
        }

        // Jika child tidak ada, return majority class dari node ini
        if (!isset($node['children'][$direction])) {
            return $this->getMajorityClass($node['distribution']);
        }

        // Recursive traverse
        return $this->traverseTree($sample, $node['children'][$direction]);
    }

    /**
     * Get majority class dari distribusi label
     * 
     * @param array $labelCounts Count setiap label
     * @return mixed Majority label
     */
    private function getMajorityClass($labelCounts)
    {
        arsort($labelCounts);
        return array_key_first($labelCounts);
    }

    /**
     * Get tree structure (untuk debugging/visualisasi)
     * 
     * @return array Tree structure
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * Set max depth untuk tree
     * 
     * @param int $depth Max depth
     */
    public function setMaxDepth($depth)
    {
        $this->maxDepth = $depth;
    }

    /**
     * Set minimum samples untuk split
     * 
     * @param int $minSamples Minimum samples
     */
    public function setMinSamplesSplit($minSamples)
    {
        $this->minSamplesSplit = $minSamples;
    }
}
