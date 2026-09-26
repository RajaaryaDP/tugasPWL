<?php
require_once __DIR__ . '/koneksi.php';

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
            $gambar = uploadGambar('gambar') ?? '';

            $stmt = mysqli_prepare($conn, 'INSERT INTO berita (judul, gambar, isi, penulis, tanggal) VALUES (?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sssss', $judul, $gambar, $isi, $penulis, $tanggal);
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
    <title>Input Berita</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="container">
        <nav class="tab-bar" aria-label="Navigasi utama">
            <a href="index.php">Portal Berita</a>
            <a href="tambah.php" class="active">Input Berita</a>
        </nav>

        <section class="card form-wrap">
            <h2 style="margin-top: 0; font-size: 2.2rem;">Input Berita</h2>

            <?php if ($error): ?>
                <div class="alert error"><?php echo e($error); ?></div>
            <?php endif; ?>

            <form action="tambah.php" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div>
                        <label for="judul">Judul Berita:</label>
                        <input type="text" id="judul" name="judul" value="<?php echo isset($_POST['judul']) ? e($_POST['judul']) : ''; ?>" required>
                    </div>

                    <div>
                        <label for="gambar">Gambar:</label>
                        <div class="file-label">
                            <input type="file" id="gambar" name="gambar" accept="image/*">
                            <span class="muted">Pilih gambar</span>
                        </div>
                    </div>

                    <div>
                        <label for="isi">Isi Berita:</label>
                        <textarea id="isi" name="isi" required><?php echo isset($_POST['isi']) ? e($_POST['isi']) : ''; ?></textarea>
                    </div>

                    <div>
                        <label for="penulis">Penulis:</label>
                        <input type="text" id="penulis" name="penulis" value="<?php echo isset($_POST['penulis']) ? e($_POST['penulis']) : ''; ?>" required>
                    </div>

                    <div>
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo isset($_POST['tanggal']) ? e($_POST['tanggal']) : ''; ?>" required>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 20px;">
                    <button type="submit" class="btn">Submit</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
