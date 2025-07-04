
<?php
include 'koneksi.php';
include_once 'functions.php';

// Tangkap kata kunci pencarian jika ada
$kataKunci = isset($_GET['q']) ? trim($_GET['q']) : '';




// Buat query pencarian
if (!empty($kataKunci)) {
    $query = mysqli_query($conn, "SELECT * FROM berita WHERE judul LIKE '%$kataKunci%' OR isi LIKE '%$kataKunci%' ORDER BY tanggal DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC"); // TETAP tampilkan berita
}


?>

<?php
echo highlight("Ini adalah berita tentang ekonomi dan politik", "ekonomi");
?>



<!-- KONTEN KARTU BERITA -->
<div class="scroll-wrapper my-4 position-relative">
    <!-- Tombol Geser Kiri -->
    <button class="scroll-btn btn btn-outline-secondary position-absolute top-50 start-0 translate-middle-y" id="scrollLeft">
        <i class="bi bi-chevron-left"></i>
    </button>

    <!-- Kontainer Berita -->
    <div id="beritaContainer" class="d-flex px-3"
        style="scroll-behavior: smooth; overflow-x: auto; overflow-y: hidden; gap: 1rem; scrollbar-width: none; -ms-overflow-style: none;">

        <?php if (mysqli_num_rows($query) > 0) : ?>
            <?php while ($data = mysqli_fetch_array($query)) : ?>
                <div class="card flex-shrink-0" style="width: 18rem; min-width: 18rem;">
                    <?php if (!empty($data['gambar'])) : ?>
                        <img src="uploads/<?= htmlspecialchars($data['gambar']) ?>" class="card-img-top" alt="Gambar Berita">
                    <?php elseif (!empty($data['video'])) : ?>
                        <video class="card-img-top" controls>
                            <source src="uploads/<?= htmlspecialchars($data['video']) ?>" type="video/mp4">
                        </video>
                    <?php else : ?>
                        <img src="img/default.jpg" class="card-img-top" alt="Default">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($data['judul']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($data['headline']) ?></p>
                        <small class="text-muted"><?= $data['tanggal'] ?> | <?= $data['kategori'] ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="w-100 text-center">
                <div class="alert alert-warning m-auto" style="max-width: 400px;">
                    Tidak ditemukan berita untuk kata kunci: <strong><?= htmlspecialchars($kataKunci) ?></strong>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tombol Geser Kanan -->
    <button class="scroll-btn btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y" id="scrollRight">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>

