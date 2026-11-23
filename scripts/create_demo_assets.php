<?php

$files = [
    'storage/app/public/demo/pasfoto_gabriel.jpg' => [300, 400, 'GABRIEL J. MAMAHIT', [30, 60, 140]],
    'storage/app/public/demo/kk_gabriel.jpg' => [600, 400, 'KARTU KELUARGA (KK) MAMAHIT', [240, 245, 250]],
    'storage/app/public/demo/ijazah_gabriel.jpg' => [600, 400, 'IJAZAH SMA LEGALISIR', [255, 250, 240]],
    'storage/app/public/demo/kk_sample.jpg' => [600, 400, 'KARTU KELUARGA RESMI', [240, 245, 250]],
    'storage/app/public/demo/ijazah_sample.jpg' => [600, 400, 'IJAZAH SMA ASLI', [255, 250, 240]],
    'storage/app/public/demo/ijazah_buram.jpg' => [600, 400, 'RAPOR SEMESTER 1 (DITOLAK)', [255, 235, 235]],
    'storage/app/public/demo/foto_sample_f.jpg' => [300, 400, 'PAS FOTO FORMAL', [16, 50, 120]],
    'storage/app/public/demo/foto_sample_m.jpg' => [300, 400, 'PAS FOTO FORMAL', [16, 50, 120]],
    'storage/app/public/demo/ktp_sample.jpg' => [600, 380, 'KARTU TANDA PENDUDUK (e-KTP)', [230, 240, 255]]
];

@mkdir('storage/app/public/demo', 0777, true);

foreach ($files as $path => $info) {
    list($w, $h, $text, $rgb) = $info;
    $img = imagecreatetruecolor($w, $h);
    $bg = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]);
    imagefill($img, 0, 0, $bg);
    $textColor = imagecolorallocate($img, 20, 20, 30);
    imagestring($img, 5, 20, (int)($h / 2) - 10, $text, $textColor);
    imagejpeg($img, $path, 90);
    imagedestroy($img);
}

echo "Demo placeholder images generated successfully.\n";
