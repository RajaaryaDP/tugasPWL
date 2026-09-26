<?php
require_once __DIR__ . '/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    redirect('index.php');
}

$result = mysqli_query($conn, "SELECT * FROM berita WHERE id = $id LIMIT 1");
$berita = mysqli_fetch_assoc($result);

if (!$berita) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $isi = trim($_POST['isi'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $tanggal = trim($_POST['tanggal'] ?? '');

    if ($judul === '' || $isi === '' || $penulis === '' || $tanggal === '') {
        $error = 'Semua field wajib diisi.';
    } else {
        try {
            $gambarBaru = uploadGambar('gambar', $berita['gambar']) ?? '';

            $stmt = mysqli_prepare($conn, 'UPDATE berita SET judul = ?, gambar = ?, isi = ?, penulis = ?, tanggal = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'sssssi', $judul, $gambarBaru, $isi, $penulis, $tanggal, $id);
            mysqli_stmt_execute($stmt);
            redirect('index.php');
        } catch (Throwable $e) {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="logo-wrap" aria-label="Logo"></div>
        <div class="page-title">Latihan</div>
    </header>

    <main class="container">
        <h1 class="hero-title"><span class="bullet">•</span>Buatlah fungsi CRUD pada web portal seperti dibawah ini :</h1>

        <nav class="tab-bar" aria-label="Navigasi utama">
            <a href="index.php">Portal Berita</a>
            <a href="index.php">Home</a>
            <a href="tambah.php">Input Berita</a>
        </nav>

        <section class="card form-wrap">
            <h2 style="margin-top: 0; font-size: 2.2rem;">Edit Berita</h2>

            <?php if ($error): ?>
                <div class="alert error"><?php echo e($error); ?></div>
            <?php endif; ?>

            <form action="edit.php?id=<?php echo (int) $berita['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div>
                        <label for="judul">Judul Berita:</label>
                        <input type="text" id="judul" name="judul" value="<?php echo e($_POST['judul'] ?? $berita['judul']); ?>" required>
                    </div>

                    <div>
                        <label for="gambar">Gambar:</label>
                        <div class="file-label">
                            <input type="file" id="gambar" name="gambar" accept="image/*">
                            <?php if (!empty($berita['gambar'])): ?>
                                <span class="muted">Gambar saat ini: <?php echo e($berita['gambar']); ?></span>
                            <?php else: ?>
                                <span class="muted">Tidak ada gambar</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label for="isi">Isi Berita:</label>
                        <textarea id="isi" name="isi" required><?php echo e($_POST['isi'] ?? $berita['isi']); ?></textarea>
                    </div>

                    <div>
                        <label for="penulis">Penulis:</label>
                        <input type="text" id="penulis" name="penulis" value="<?php echo e($_POST['penulis'] ?? $berita['penulis']); ?>" required>
                    </div>

                    <div>
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo e($_POST['tanggal'] ?? $berita['tanggal']); ?>" required>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 20px;">
                    <button type="submit" class="btn">Update</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
