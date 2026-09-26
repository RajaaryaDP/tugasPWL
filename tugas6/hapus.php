<?php
require_once __DIR__ . '/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    redirect('index.php');
}

$result = mysqli_query($conn, "SELECT * FROM berita WHERE id = $id LIMIT 1");
$berita = mysqli_fetch_assoc($result);

if ($berita) {
    if (!empty($berita['gambar'])) {
        hapusGambar($berita['gambar']);
    }

    mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
}

redirect('index.php');
