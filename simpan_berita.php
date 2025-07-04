<?php
include 'koneksi.php';

// Ambil data form
$judul     = $_POST['judul'];
$kategori  = $_POST['kategori'];
$headline  = $_POST['headline'];
$isi       = $_POST['isi'];
$pengirim  = $_POST['pengirim'];

// Validasi batas ukuran
$maxImageSize = 10 * 1024 * 1024;  // 10 MB
$maxVideoSize = 100 * 1024 * 1024; // 100 MB

$gambar = $_FILES['gambar'];
$video  = $_FILES['video'];

$allowed_image_ext  = ['jpg', 'jpeg', 'png', 'gif'];
$allowed_image_mime = ['image/jpeg', 'image/png', 'image/gif'];

$allowed_video_ext  = ['mp4'];
$allowed_video_mime = ['video/mp4'];

// --- Validasi Gambar (jika ada)
if ($gambar['name'] != '') {
    $extGambar = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
    $mimeGambar = mime_content_type($gambar['tmp_name']);

    if ($gambar['size'] > $maxImageSize) {
        header("Location: index.php?page=input&status=gagal_ukuran_gambar");
        exit;
    }

    if (!in_array($extGambar, $allowed_image_ext) || !in_array($mimeGambar, $allowed_image_mime)) {
        header("Location: index.php?page=input&status=gagal_format_gambar");
        exit;
    }

    $namaGambar = uniqid() . '.' . $extGambar;
    move_uploaded_file($gambar['tmp_name'], "uploads/$namaGambar");
} else {
    $namaGambar = '';
}

// --- Validasi Video (jika ada)
if ($video['name'] != '') {
    $extVideo = strtolower(pathinfo($video['name'], PATHINFO_EXTENSION));
    $mimeVideo = mime_content_type($video['tmp_name']);

    if ($video['size'] > $maxVideoSize) {
        header("Location: index.php?page=input&status=gagal_ukuran_video");
        exit;
    }

    if (!in_array($extVideo, $allowed_video_ext) || !in_array($mimeVideo, $allowed_video_mime)) {
        header("Location: index.php?page=input&status=gagal_format_video");
        exit;
    }

    $namaVideo = uniqid() . '.' . $extVideo;
    move_uploaded_file($video['tmp_name'], "uploads/$namaVideo");
} else {
    $namaVideo = '';
}

// --- Simpan ke database
$sql = "INSERT INTO berita (judul, kategori, headline, isi, gambar, video, pengirim)
        VALUES ('$judul', '$kategori', '$headline', '$isi', '$namaGambar', '$namaVideo', '$pengirim')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?page=arsip&status=sukses");
} else {
    header("Location: index.php?page=input&status=gagal");
}
?>
