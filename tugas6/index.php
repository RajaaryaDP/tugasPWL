<?php
require_once __DIR__ . '/koneksi.php';

$sql = "SELECT * FROM berita ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$beritaList = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="container">
        <nav class="tab-bar" aria-label="Navigasi utama">
            <a href="index.php" class="active">Portal Berita</a>
            <a href="tambah.php">Input Berita</a>
        </nav>

        <section class="card form-wrap">
            <div class="form-actions" style="margin-bottom: 20px; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 2rem;">Daftar Berita</h2>
                <a href="tambah.php" class="btn">+ Tambah Berita</a>
            </div>

            <?php if (empty($beritaList)): ?>
                <div class="alert muted">Belum ada data berita. Silakan tambah berita baru.</div>
            <?php else: ?>
                <div class="table-wrap">
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th style="width: 90px;">Gambar</th>
                                <th>Judul</th>
                                <th style="width: 180px;">Penulis</th>
                                <th style="width: 140px;">Tanggal</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beritaList as $berita): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($berita['gambar']) && is_file(__DIR__ . '/gambar/' . $berita['gambar'])): ?>
                                            <img class="thumb" src="gambar/<?php echo e($berita['gambar']); ?>" alt="<?php echo e($berita['judul']); ?>">
                                        <?php else: ?>
                                            <div class="thumb" style="display:grid;place-items:center;color:#666;font-size:0.75rem;">No Image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo e($berita['judul']); ?></strong><br>
                                        <span class="muted"><?php echo nl2br(e(substr($berita['isi'], 0, 120))); ?><?php echo strlen($berita['isi']) > 120 ? '...' : ''; ?></span>
                                    </td>
                                    <td><?php echo e($berita['penulis']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($berita['tanggal'])); ?></td>
                                    <td>
                                        <div class="action-group">
                                            <a class="btn btn-secondary" href="edit.php?id=<?php echo (int) $berita['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="hapus.php?id=<?php echo (int) $berita['id']; ?>" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
