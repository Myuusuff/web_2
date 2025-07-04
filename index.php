<?php include 'koneksi.php'; ?>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>


    


<body>
    <div id="alertPencarian" class="alert alert-warning alert-dismissible fade d-none fixed-alert text-center" role="alert">
  <span id="pesanPencarian">Masukkan kata kunci pencarian</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <div id="preloader">
  <div class="text-center">
    <div class="spinner mx-auto"></div>
    <p style="color:white; margin-top: 15px;">Memuat data, tunggu ko jawaaaa...</p>
  </div>
</div>


<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" id="mainNavbar">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Portal Berita</a>

    <!-- Toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu tengah -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link<?= $page == 'beranda' ? ' active' : '' ?>" href="?page=beranda">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $page == 'input' ? ' active' : '' ?>" href="?page=input">Input Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $page == 'arsip' ? ' active' : '' ?>" href="?page=arsip">Arsip</a>
        </li>
      </ul>
    </div>



    <!-- Tombol dark mode -->
    <div class="d-none d-lg-block ms-10">
      <button id="darkModeToggle" class="btn btn-outline-secondary px-10">
        <i id="modeIcon" class="bi bi-moon-fill"></i>
      </button>
    </div>
  </div>
</nav>





<div class="container">
    <?php if (!empty($status)): ?>
        <?php if ($status == 'sukses'): ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle-fill"></i> Berita berhasil disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($status == 'gagal'): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-x-circle-fill"></i> Gagal menyimpan berita!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($status == 'hapus_sukses'): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-trash-fill"></i> Berita berhasil dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($status == 'edit_sukses'): ?>
            <div class="alert alert-primary alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-pencil-square"></i> Berita berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php elseif ($status == 'gagal_format_gambar'): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-x-circle-fill"></i> Gagal: Format file gambar tidak valid.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($status == 'gagal_ukuran_video'): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-x-circle-fill"></i> Gagal: Ukuran video melebihi 100MB.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($status == 'gagal_format_video'): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-x-circle-fill"></i> Gagal: Format file video tidak valid.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div id="alertSuara" class="alert alert-info alert-dismissible fade show d-none mt-4" role="alert">
    <i class="bi bi-volume-up-fill"></i> <span id="pesanSuara"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>



<?php if ($page == 'beranda'): ?>
    <div class="hero">
        <h1>Selamat Datang di Portal Berita</h1>
        <p>Sumber terpercaya untuk berita terbaru seputar Ekonomi, Teknologi, Olahraga, dan Politik.</p>
    </div>
    <div class="profile-card">
        <img src="img/fotosy.png" alt="Foto Profil">
        <h3>Yusuf</h3>
        <p>Mahasiswa Sistem Informasi </p>
        <p>Email: yusuf01@gmail.com</p>
        <p>Universitas ternama</p>
    </div>

    <!-- FORM PENCARIAN -->
    
    <div id="searchContainer" class="d-flex justify-content-end mt-4 mb-3">
  <form id="formCari" class="d-flex align-items-center position-relative">
    <input type="text" id="inputCari" class="form-control d-none" placeholder="Cari berita...">
    <button type="button" id="btnCari" class="btn btn-outline-primary ms-2">
      <i class="bi bi-search"></i>
    </button>
  </form>
</div>
<div id="beritaContainer">
  
    <h4 class="mt-5">Berita Terbaru</h4>
    <?php include 'berita.php'; ?>
    <?php while ($data = mysqli_fetch_array($query)): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= highlight($data['judul'], $kataKunci) ?></h5>
                <p class="card-text"><?= highlight($data['isi'], $kataKunci) ?></p>
                <?php if ($data['gambar']): ?>
                    <img src="uploads/<?= $data['gambar']; ?>" alt="" class="img-fluid" style="max-height:200px;">
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>


    <!-- Halaman Input -->
<?php elseif ($page == 'input'): ?>
    <h2 class="text-center mt-5">Input Berita</h2>
    <div id="formAlert" class="alert alert-danger d-none alert-dismissible fade" role="alert">
  <i class="bi bi-exclamation-triangle-fill"></i> <span id="alertMessage"></span>
  <button type="button" class="btn-close" aria-label="Close"></button>
</div>

    <form id="formBerita" action="simpan_berita.php" method="post" enctype="multipart/form-data" novalidate>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Judul Berita</label>
                <input type="text" name="judul" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    <option>Ekonomi</option>
                    <option>Teknologi</option>
                    <option>Olahraga</option>
                    <option>Politik</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Headline</label>
            <textarea name="headline" rows="2" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi Berita</label>
            <textarea name="isi" rows="5" class="form-control isi-berita"> </textarea>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
                <label class="form-label">Video</label>
                <input type="file" name="video" class="form-control" accept="video/*">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Pengirim</label>
            <input type="text" name="pengirim" class="form-control">
        </div>
        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Berita</button>
    </form>
<?php elseif ($page == 'arsip'): ?>
    <h2 class="text-center mt-5">Daftar Arsip Berita</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Video</th>
                <th>Pengirim</th>
                <th>Tanggal</th>
                <th>Aksi</th>
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
                echo "<td>
                    <a href='edit.php?id={$data['id']}' class='btn btn-sm btn-primary me-1'><i class='bi bi-pencil'></i></a>
                    <button class='btn btn-sm btn-danger btn-hapus' data-id='{$data['id']}' data-judul='{$data['judul']}'><i class='bi bi-trash'></i></button>
                </td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
<?php endif; ?>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalHapusLabel"><i class="bi bi-trash-fill"></i> Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus berita <strong id="judulHapus"></strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="btnKonfirmasiHapus" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

<button id="ttsButton" class="btn btn-sm btn-outline-primary position-fixed" style="bottom: 20px; right: 20px; z-index: 999;">
    🔊
</button>



<footer class="text-center mt-5">
    <p>&copy; 2023 Portal Berita. All rights reserved.</p>
    <p>Created by Yusuf</p>
</footer>


<script src="main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
