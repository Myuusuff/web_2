<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM berita WHERE id=$id");
    $data = mysqli_fetch_array($query);
} else {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $judul    = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $headline = $_POST['headline'];
    $isi      = $_POST['isi'];
    $pengirim = $_POST['pengirim'];

    $update = mysqli_query($conn, "UPDATE berita SET 
        judul='$judul',
        kategori='$kategori',
        headline='$headline',
        isi='$isi',
        pengirim='$pengirim'
        WHERE id=$id");

    if ($update) {
        header("Location: index.php?page=arsip&status=edit_sukses");
    } else {
        header("Location: index.php?page=arsip&status=edit_gagal");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Portal Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Input Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#arsip">Arsip</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    <h2>Edit Berita</h2>
    <form method="post">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $data['judul'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-select">
                <option <?= $data['kategori'] == 'Ekonomi' ? 'selected' : '' ?>>Ekonomi</option>
                <option <?= $data['kategori'] == 'Teknologi' ? 'selected' : '' ?>>Teknologi</option>
                <option <?= $data['kategori'] == 'Olahraga' ? 'selected' : '' ?>>Olahraga</option>
                <option <?= $data['kategori'] == 'Politik' ? 'selected' : '' ?>>Politik</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Headline</label>
            <textarea name="headline" class="form-control"><?= $data['headline'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Isi</label>
            <textarea name="isi" class="form-control" rows="5"><?= $data['isi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Pengirim</label>
            <input type="text" name="pengirim" value="<?= $data['pengirim'] ?>" class="form-control">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
