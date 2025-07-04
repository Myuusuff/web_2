<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT gambar, video FROM berita WHERE id = $id");
    $data = mysqli_fetch_array($query);

    if ($data) {
        if (!empty($data['gambar'])) unlink("uploads/" . $data['gambar']);
        if (!empty($data['video'])) unlink("uploads/" . $data['video']);

        $hapus = mysqli_query($conn, "DELETE FROM berita WHERE id = $id");

        if ($hapus) {
            header("Location: index.php?page=arsip&status=hapus_sukses");
            exit();
        } else {
            header("Location: index.php?page=arsip&status=hapus_gagal");
        }
    }
} else {
    header("Location: index.php");
}
?>