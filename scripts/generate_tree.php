<?php
require __DIR__ . '/../vendor/autoload.php';

function hitungEntropy($labelCounts, $total)
{
    if ($total == 0) return 0;
    $entropy = 0.0;
    foreach ($labelCounts as $count) {
        if ($count > 0) {
            $p = $count / $total;
            $entropy -= $p * log($p, 2);
        }
    }
    return round($entropy, 4);
}

function findBestSplit($samples, $labels, $featureIndex)
{
    $values = array_column($samples, $featureIndex);
    sort($values);
    $unique = array_values(array_unique($values));
    $candidates = [];
    for ($i = 0; $i < count($unique) - 1; $i++) {
        $candidates[] = ($unique[$i] + $unique[$i + 1]) / 2.0;
    }
    foreach ($unique as $v) $candidates[] = $v;

    $total = count($labels);
    $labelCounts = array_count_values($labels);
    $entropyRoot = hitungEntropy($labelCounts, $total);

    $best = [
        'threshold' => null,
        'information_gain' => 0,
        'weighted_entropy' => null,
        'left_count' => 0,
        'right_count' => 0,
        'left_labels' => [],
        'right_labels' => [],
        'left_entropy' => 0,
        'right_entropy' => 0,
    ];

    foreach ($candidates as $threshold) {
        $leftLabels = [];
        $rightLabels = [];
        foreach ($samples as $k => $sample) {
            if ($sample[$featureIndex] >= $threshold) {
                $rightLabels[] = $labels[$k];
            } else {
                $leftLabels[] = $labels[$k];
            }
        }
        $leftCount = count($leftLabels);
        $rightCount = count($rightLabels);
        if ($leftCount + $rightCount == 0) continue;
        $leftEntropy = hitungEntropy(array_count_values($leftLabels), $leftCount);
        $rightEntropy = hitungEntropy(array_count_values($rightLabels), $rightCount);
        $weightedEntropy = ($leftCount / $total) * $leftEntropy + ($rightCount / $total) * $rightEntropy;
        $infoGain = $entropyRoot - $weightedEntropy;
        if ($infoGain > $best['information_gain']) {
            $best = [
                'threshold' => $threshold,
                'information_gain' => $infoGain,
                'weighted_entropy' => round($weightedEntropy, 4),
                'left_count' => $leftCount,
                'right_count' => $rightCount,
                'left_labels' => array_count_values($leftLabels),
                'right_labels' => array_count_values($rightLabels),
                'left_entropy' => round($leftEntropy, 4),
                'right_entropy' => round($rightEntropy, 4),
            ];
        }
    }
    return $best;
}

function bangunStrukturPohon($samples, $labels)
{
    $total = count($labels);
    $labelCounts = array_count_values($labels);
    $root = [
        'type' => 'root',
        'label' => 'Root',
        'total' => $total,
        'distribution' => $labelCounts,
        'entropy' => hitungEntropy($labelCounts, $total),
        'children' => []
    ];

    $bestTerjual = findBestSplit($samples, $labels, 0);
    $bestLama = findBestSplit($samples, $labels, 1);
    $bestRoot = ($bestTerjual['information_gain'] >= $bestLama['information_gain']) ? ['feature' => 0, 'info' => $bestTerjual] : ['feature' => 1, 'info' => $bestLama];
    $featureNames = [0 => 'Terjual', 1 => 'Lama Barang'];

    $leftSamples = [];
    $leftLabels = [];
    $rightSamples = [];
    $rightLabels = [];
    $threshold = $bestRoot['info']['threshold'];
    $featureIndex = $bestRoot['feature'];

    foreach ($samples as $k => $sample) {
        if ($sample[$featureIndex] >= $threshold) {
            $rightSamples[] = $sample;
            $rightLabels[] = $labels[$k];
        } else {
            $leftSamples[] = $sample;
            $leftLabels[] = $labels[$k];
        }
    }

    $rightCounts = array_count_values($rightLabels);
    $rightLabel = (!empty($rightCounts)) ? array_keys($rightCounts, max($rightCounts))[0] : null;
    $root['children'][] = [
        'type' => 'leaf',
        'condition' => $featureNames[$featureIndex] . ' >= ' . $threshold,
        'label' => $rightLabel ?: 'N/A',
        'total' => count($rightLabels),
        'distribution' => $rightCounts,
        'entropy' => hitungEntropy($rightCounts, count($rightLabels)),
    ];

    if (count($leftLabels) > 0) {
        $leftCounts = array_count_values($leftLabels);
        $leftNode = [
            'type' => 'node',
            'condition' => $featureNames[$featureIndex] . ' < ' . $threshold,
            'label' => 'Node 2',
            'total' => count($leftLabels),
            'distribution' => $leftCounts,
            'entropy' => hitungEntropy($leftCounts, count($leftLabels)),
            'children' => []
        ];

        $otherFeature = ($featureIndex === 0) ? 1 : 0;
        $bestLeftSplit = findBestSplit($leftSamples, $leftLabels, $otherFeature);
        $thLeft = $bestLeftSplit['threshold'];

        $leftLama = [];
        $leftLamaLabels = [];
        $rightLama = [];
        $rightLamaLabels = [];
        foreach ($leftSamples as $k => $sample) {
            if ($sample[$otherFeature] >= $thLeft) {
                $rightLama[] = $sample;
                $rightLamaLabels[] = $leftLabels[$k];
            } else {
                $leftLama[] = $sample;
                $leftLamaLabels[] = $leftLabels[$k];
            }
        }

        $rightLamaCounts = array_count_values($rightLamaLabels);
        $rightLamaLabel = (!empty($rightLamaCounts)) ? array_keys($rightLamaCounts, max($rightLamaCounts))[0] : null;
        $leftNode['children'][] = [
            'type' => 'leaf',
            'condition' => $featureNames[$otherFeature] . ' >= ' . $thLeft,
            'label' => $rightLamaLabel ?: 'N/A',
            'total' => count($rightLamaLabels),
            'distribution' => $rightLamaCounts,
            'entropy' => hitungEntropy($rightLamaCounts, count($rightLamaLabels)),
        ];

        $leftLamaCounts = array_count_values($leftLamaLabels);
        $leftLamaLabel = (!empty($leftLamaCounts)) ? array_keys($leftLamaCounts, max($leftLamaCounts))[0] : null;
        $leftNode['children'][] = [
            'type' => 'leaf',
            'condition' => $featureNames[$otherFeature] . ' < ' . $thLeft,
            'label' => $leftLamaLabel ?: 'N/A',
            'total' => count($leftLamaLabels),
            'distribution' => $leftLamaCounts,
            'entropy' => hitungEntropy($leftLamaCounts, count($leftLamaLabels)),
        ];

        $root['children'][] = $leftNode;
    }

    return $root;
}

$path = __DIR__ . '/../test_data.csv';
if (!file_exists($path)) {
    echo json_encode(['error' => 'test_data.csv not found']) . "\n";
    exit(1);
}
$fh = fopen($path, 'r');
$header = fgetcsv($fh);
$samples = [];
$labels = [];
$rows = [];
while (($row = fgetcsv($fh)) !== false) {
    if (count($row) < 5) continue;
    $nama = $row[0] ?? 'Tanpa Nama';
    $terjual = isset($row[3]) ? intval($row[3]) : 0;
    $lama = isset($row[4]) ? intval($row[4]) : 0;
    $samples[] = [$terjual, $lama];
    // label using same simple rule as simulate_upload
    $label = ($terjual >= 50) ? 'TINGKATKAN STOCK' : 'KURANGI STOCK';
    $labels[] = $label;
    $rows[] = ['nama' => $nama, 'terjual' => $terjual, 'lama' => $lama, 'status' => $label];
}
fclose($fh);

$entropyGain = [
    'terjual' => findBestSplit($samples, $labels, 0),
    'lama' => findBestSplit($samples, $labels, 1),
];
$entropyGain['best_root'] = ($entropyGain['terjual']['information_gain'] >= $entropyGain['lama']['information_gain']) ? $entropyGain['terjual'] : $entropyGain['lama'];

$tree = bangunStrukturPohon($samples, $labels);

echo json_encode(['entropyGain' => $entropyGain, 'tree' => $tree, 'rows' => $rows], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
