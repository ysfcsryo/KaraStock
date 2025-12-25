<?php
require __DIR__ . '/../vendor/autoload.php';

$path = __DIR__ . '/../test_data.csv';
$fh = fopen($path, 'r');
if (!$fh) {
    echo "failed to open csv\n";
    exit(1);
}
$header = fgetcsv($fh);
$semua = [];
while (($row = fgetcsv($fh)) !== false) {
    if (count($row) < 5) continue;
    $nama = $row[0] ?? 'Tanpa Nama';
    $terjual = isset($row[3]) ? intval($row[3]) : 0;
    $lama = isset($row[4]) ? intval($row[4]) : 0;
    // Use fallback rule (same as controller when model absent)
    if ($terjual >= 50) {
        $label = 'TINGKATKAN STOCK';
        $saran = 'Barang laris manis atau butuh promosi.';
        $warna = 'success';
    } else {
        $label = 'KURANGI STOCK';
        $saran = 'Cuci gudang / Stop produksi.';
        $warna = 'danger';
    }
    $semua[] = [
        'nama' => $nama,
        'terjual' => $terjual,
        'lama' => $lama,
        'status' => $label,
        'saran' => $saran,
        'warna' => $warna
    ];
}
fclose($fh);
echo json_encode($semua, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
