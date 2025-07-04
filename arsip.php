<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arsip Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-4">
    <h2 class="text-center">Daftar Arsip Berita</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Judul Berita</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Video</th>
                <th>Pengirim</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$data['judul']}</td>";
            echo "<td>{$data['kategori']}</td>";
            echo $data['gambar'] ? "<td><img src='uploads/{$data['gambar']}' width='100'></td>" : "<td>-</td>";
            echo $data['video'] ? "<td><a href='uploads/{$data['video']}' target='_blank'>{$data['video']}</a></td>" : "<td>-</td>";
            echo "<td>{$data['pengirim']}</td>";
            echo "<td>{$data['tanggal']}</td>";
            echo "</tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>