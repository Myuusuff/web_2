  // ==========================
  // Scroll Berita Horizontal
  // ==========================
  // Scroll Berita Horizontal
  // ==========================
document.addEventListener('DOMContentLoaded', function () {
  const btnLeft = document.getElementById('scrollLeft');
  const btnRight = document.getElementById('scrollRight');
  const beritaContainer = document.getElementById('beritaContainer');

  if (btnLeft && beritaContainer) {
    btnLeft.addEventListener('click', () => {
      beritaContainer.scrollBy({ left: -300, behavior: 'smooth' });
    });
  }

  if (btnRight && beritaContainer) {
    btnRight.addEventListener('click', () => {
      beritaContainer.scrollBy({ left: 300, behavior: 'smooth' });
    });
  }
});


// Dark Mode awal sebelum DOM siap
if (localStorage.getItem('mode') === 'dark') {
  document.body.classList.add('dark-mode');
  document.documentElement.classList.add('dark-mode');
}

window.addEventListener('load', () => {
  // Preloader
  const preloader = document.getElementById('preloader');
  if (preloader) {
    preloader.style.opacity = '0';
    preloader.style.transition = 'opacity 0.5s ease';
    setTimeout(() => preloader.style.display = 'none', 500);
  }
});

document.addEventListener('DOMContentLoaded', function () {
  // ==========================
  // Validasi Form Input Berita
  // ==========================
  const form = document.getElementById('formBerita');
  const alertBox = document.getElementById('formAlert');
  const alertMsg = document.getElementById('alertMessage');
  const closeBtn = alertBox?.querySelector('.btn-close');
  const maxImageSize = 10 * 1024 * 1024;
  const maxVideoSize = 100 * 1024 * 1024;
  const allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

  function showError(e, msg) {
    e.preventDefault();
    alertMsg.textContent = msg;
    alertBox.classList.remove('d-none', 'fade');
    alertBox.classList.add('show', 'fixed-alert');
    alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  closeBtn?.addEventListener('click', () => {
    alertBox.classList.remove('show');
    alertBox.classList.add('d-none');
  });

  form?.addEventListener('submit', function (e) {
    alertBox.classList.add('d-none');
    const judul = form.querySelector('[name="judul"]').value.trim();
    const kategori = form.querySelector('[name="kategori"]').value.trim();
    const headline = form.querySelector('[name="headline"]').value.trim();
    const isi = form.querySelector('[name="isi"]').value.trim();
    const pengirim = form.querySelector('[name="pengirim"]').value.trim();
    const gambar = form.querySelector('[name="gambar"]').files[0];
    const video = form.querySelector('[name="video"]').files[0];

    if (!judul || !kategori || !headline || !isi || !pengirim) {
      return showError(e, "Semua kolom wajib diisi!");
    }

    if (gambar) {
      if (!allowedImageTypes.includes(gambar.type)) {
        return showError(e, "File gambar harus JPG, JPEG, PNG, atau GIF!");
      }
      if (gambar.size > maxImageSize) {
        return showError(e, "Ukuran gambar maksimal 10MB!");
      }
    }

    if (video && video.size > maxVideoSize) {
      return showError(e, "Ukuran video maksimal 100MB!");
    }
  });


  // ==========================
  // Modal Hapus
  // ==========================
  const modalHapusEl = document.getElementById('modalHapus');
  const modalHapus = modalHapusEl ? new bootstrap.Modal(modalHapusEl) : null;
  const judulHapus = document.getElementById('judulHapus');
  const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');

  document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const judul = this.getAttribute('data-judul');
      if (judulHapus) judulHapus.textContent = judul;
      if (btnKonfirmasiHapus) btnKonfirmasiHapus.href = `delete.php?id=${id}&confirm=1`;
      modalHapus?.show();
    });
  });

  // ==========================
  // Toggle Dark Mode
  // ==========================
  const toggleBtn = document.getElementById('darkModeToggle');
  const modeIcon = document.getElementById('modeIcon');
  const navbar = document.getElementById('mainNavbar');

  toggleBtn?.addEventListener('click', function () {
    const isDark = document.body.classList.toggle('dark-mode');
    modeIcon.classList.add('rotate');
    setTimeout(() => modeIcon.classList.remove('rotate'), 400);

    if (isDark) {
      modeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
      navbar?.classList.add('navbar-dark', 'bg-dark');
      navbar?.classList.remove('navbar-light', 'bg-light');
      localStorage.setItem('mode', 'dark');
    } else {
      modeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
      navbar?.classList.remove('navbar-dark', 'bg-dark');
      navbar?.classList.add('navbar-light', 'bg-light');
      localStorage.setItem('mode', 'light');
    }
  });

  // ==========================
  // Tombol TTS (Text to Speech)
  // ==========================
  const ttsButton = document.getElementById("ttsButton");
  const isiBerita = document.querySelector("textarea[name='isi']");
  const alertSuara = document.getElementById("alertSuara");
  const pesanSuara = document.getElementById("pesanSuara");

  ttsButton?.addEventListener("click", function () {
    let text = isiBerita?.value.trim() || "Isi berita masih kosong.";
    if (pesanSuara && alertSuara) {
      pesanSuara.textContent = text;
      alertSuara.classList.remove("d-none");
    }
    const suara = new SpeechSynthesisUtterance(text);
    suara.lang = "id-ID";
    window.speechSynthesis.cancel();
    window.speechSynthesis.speak(suara);
  });
  
});


  

  // ==========================
  // Pencarian Berita (Tombol Kecil Lalu Melebar)
  // ==========================
document.addEventListener('DOMContentLoaded', function () {
  const btnCari = document.getElementById('btnCari');
  const inputCari = document.getElementById('inputCari');
  const formCari = document.getElementById('formCari');
  const alertBox = document.getElementById('alertPencarian');
  const pesanPencarian = document.getElementById('pesanPencarian');
  const beritaContainer = document.getElementById('beritaContainer');
  let aktif = false;

  // Tampilkan alert
  function tampilkanAlertPencarian(pesan = "Masukkan kata kunci pencarian") {
    if (alertBox && pesanPencarian) {
      pesanPencarian.textContent = pesan;
      alertBox.classList.remove("d-none", "fade");
      alertBox.classList.add("show", "fixed-alert");

      setTimeout(() => {
        alertBox.classList.remove("show");
        alertBox.classList.add("fade", "d-none");
      }, 3000);
    }
  }

  // Fungsi fetch berita
  function cariBerita(keyword) {
    fetch(`berita.php?q=${encodeURIComponent(keyword)}`)
      .then(res => res.text())
      .then(html => {
        if (beritaContainer) {
          beritaContainer.innerHTML = html;
          beritaContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      })
      .catch(err => {
        console.error('Gagal mengambil berita:', err);
        beritaContainer.innerHTML = `<p class="text-danger">Gagal memuat berita.</p>`;
      });
  }

  // Tombol klik
  btnCari.addEventListener('click', function () {
    if (!aktif) {
      inputCari.classList.add('active');
      inputCari.classList.remove('d-none');
      inputCari.focus();
      aktif = true;
    } else {
      const keyword = inputCari.value.trim();
      if (keyword !== '') {
        cariBerita(keyword);
      } else {
        tampilkanAlertPencarian();
        inputCari.focus();
      }
    }
  });

  // Enter
  inputCari.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      const keyword = inputCari.value.trim();
      if (keyword !== '') {
        cariBerita(keyword);
      } else {
        tampilkanAlertPencarian();
      }
    }
  });

  // Ketik otomatis cari
  inputCari.addEventListener('input', function () {
    const keyword = inputCari.value.trim();
    cariBerita(keyword);
  });

  // Klik luar
  document.addEventListener('click', function (e) {
    if (aktif && !formCari.contains(e.target) && e.target !== btnCari) {
      inputCari.classList.remove('active');
      inputCari.classList.add('d-none');
      aktif = false;
    }
  });
});






