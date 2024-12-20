<?php
require 'koneksi.php';
  if (isset($_GET['q'])) {
    $q = $_GET['q'];

    $sql = "SELECT id, nama, nim, alamat FROM mahasiswa WHERE nama LIKE '%$q%' OR nim LIKE '%$q%' OR alamat LIKE '%$q%'";
    $result = $con->query($sql);

    $suggestions = array();
    while ($row = $result->fetch_assoc()) {
      $suggestions[] = $row;
    }

    echo json_encode($suggestions);
    exit();
  }

  $con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>StudentBase4C</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    /*--------------------------------------------------------------
# F.A.Q
--------------------------------------------------------------*/
.faq .faq-list {
  padding: 0;
}

.faq .faq-list ul {
  padding: 0;
  list-style: none;
}

.faq .faq-list li+li {
  margin-top: 15px;
}

.faq .faq-list li {
  padding: 20px;
  background: #fff;
  border-radius: 4px;
  position: relative;
}

.faq .faq-list a {
  display: block;
  position: relative;
  font-family: "Poppins", sans-serif;
  font-size: 16px;
  line-height: 24px;
  font-weight: 500;
  padding: 0 30px;
  outline: none;
  cursor: pointer;
}

.faq .faq-list .icon-help {
  font-size: 24px;
  position: absolute;
  right: 0;
  left: 20px;
  color: #34e5a6;
}

.faq .faq-list .icon-show,
.faq .faq-list .icon-close {
  font-size: 24px;
  position: absolute;
  right: 0;
  top: 0;
}

.faq .faq-list p {
  margin-bottom: 0;
  padding: 10px 0 0 0;
}

.faq .faq-list .icon-show {
  display: none;
}

.faq .faq-list a.collapsed {
  color: #343a40;
}

.faq .faq-list a.collapsed:hover {
  color: #1acc8d;
}

.faq .faq-list a.collapsed .icon-show {
  display: inline-block;
}

.faq .faq-list a.collapsed .icon-close {
  display: none;
}

.modal-backdrop.show {
  opacity: 0.5;
}

.modal-content {
  border-radius: 10px;
  padding: 20px;
}

.modal-dialog {
  max-width: 80%; /* Adjust this as needed */
}

.modal-header h5 {
  font-size: 1.5rem; /* Increase the font size of the modal title */
}

.modal-body .form-control {
  font-size: 1.25rem; /* Increase the font size of the input */
  padding: 15px; /* Increase padding for larger input */
}

.modal-body .input-group {
  display: flex;
  flex-wrap: nowrap;
}

.modal-body .btn {
  font-size: 1.25rem; /* Increase the font size of the button */
  padding: 15px 20px; /* Increase padding for larger button */
}

@media (min-width: 992px) {
  .modal-dialog {
    max-width: 70%;
  }
}

@media (max-width: 991px) {
  .modal-dialog {
    max-width: 90%;
  }
}

@media (max-width: 576px) {
  .modal-body .form-control {
    font-size: 1rem;
    padding: 10px;
  }

  .modal-body .btn {
    font-size: 1rem;
    padding: 10px 15px;
  }
}

@media (max-width: 1200px) {
  .faq .faq-list {
    padding: 0;
  }
}

#suggestionBox {
  border: 1px solid #ccc;
  max-height: 200px;
  overflow-y: auto;
  background-color: #fff;
  position: absolute;
  z-index: 1000;
  width: 100%;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

.suggestion-item {
  padding: 10px;
  cursor: pointer;
}

.suggestion-item:hover {
  background-color: #f0f0f0;
}

.suggestion-item b {
  font-weight: bold;
}
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php"><span>StudentBase4C</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">Cari Mahasiswa</a></li>
          <li><a class="nav-link scrollto" href="daftar.php">Daftar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1>Website Data Mahasiswa Teknik Informatika Kelas <span>4C</span></h1>
            <h2>Kumpulan Data Mahasiswa Teknik Informatika kelas 4C yang terdiri dari Nama, NIM, Tanggal Lahir, Jenis Kelamin, Alamat, Telepon dan Kesukaan </h2>
            <div class="text-center text-lg-start">
              <a href="masuk.php" class="btn-get-started scrollto">Masuk</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="assets/img/img-hero.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

          <div class="icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3 class="text-center">Tentang StudentBase4C</h3>
            <p style="text-align: justify;">Website ini merupakan platform untuk mengelola data mahasiswa kelas seperti nama, alamat, NIM, tanggal lahir, jenis kelamin, nomor telepon, dan kesukaan. Fitur utamanya meliputi menu login dan registrasi untuk mahasiswa dan admin, tampilan daftar mahasiswa, fitur edit, hapus, cari data mahasiswa, tautan alamat terintegrasi Google Maps, serta histori login user. Dalam pengembangannya, website menerapkan 10 prinsip Heuristik Usability Jacob Nielsen.</p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Fitur</h2>
          <p>Fitur StudentBase4C</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <i class="ri-login-box-line" style="color: #ffbb2c;"></i>
              <h3><a href="">Menu login dan registrasi untuk mahasiswa dan admin</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <i class="ri-user-3-line" style="color: #5578ff;"></i>
              <h3><a href="">Tampilan daftar mahasiswa beserta informasi lengkap mereka.</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
              <i class="ri-edit-box-line" style="color: #e80368;"></i>
              <h3><a href="">Fitur edit, cari dan hapus data mahasiswa dapat diakses baik oleh mahasiswa / admin.</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <i class="ri-map-pin-line" style="color: #e361ff;"></i>
              <h3><a href="">Tautan alamat yang terintegrasi dengan Google Maps untuk memudahkan navigasi.</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
              <i class="ri-history-fill" style="color: #47aeff;"></i>
              <h3><a href="">Fitur histori login user untuk meningkatkan keamanan dan transparansi.</a></h3>
            </div>
          </div>

      </div>
    </section><!-- End Features Section -->

          <!-- FAQ Section -->
          <section id="faq" class="faq section-bg">
            <div class="container">
    
              <div class="section-title" data-aos="fade-up">
                <h2>F.A.Q</h2>
                <p>Pertanyaan yang Sering Diajukan</p>
              </div>
    
              <div class="faq-list">
                <ul>

                <li data-aos="fade-up">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-1" class="collapse">Bagaimana cara masuk sebagai admin dan mahasiswa? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                      <p>
                        <b>Masuk Sebagai Admin</b> <br>
                        Username: admin <br>
                        Password: admin <br>

                        <b>Masuk Sebagai Mahasiswa</b> <br>
                        Username: nim (Contoh 11220910000003) <br>
                        Password: nim (Contoh 11220910000003)
                      </p>
                    </div>
                </li>

                  <li data-aos="fade-up" data-aos-delay="100">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-2">Apa itu StudentBase4C? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        <strong>StudentBase4C</strong> adalah platform manajemen data mahasiswa yang memudahkan dalam pengelolaan informasi data mahasiswa Teknik Informatika Kelas 4C.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="100">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Bagaimana cara mendaftar? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda dapat mendaftar dengan mengunjungi halaman pendaftaran dan mengisi form yang disediakan dengan data yang valid.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="200">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Bagaimana cara menambah data mahasiswa? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda dapat menambah data mahasiswa melalui halaman tambah data dengan mengisi form yang telah disediakan.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="400">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Bagaimana cara memilih lokasi alamat mahasiswa menggunakan peta? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Di modal edit, klik tombol "Pilih Lokasi" yang ada di sebelah kolom alamat. Anda akan diarahkan ke modal peta di mana Anda bisa memilih lokasi alamat dengan mengklik pada peta. Koordinat latitude dan longitude akan diisi secara otomatis.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="400">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Bagaimana cara melihat riwayat aktivitas saya? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda bisa melihat riwayat aktivitas Anda dengan mengklik menu "History" di sidebar. Halaman ini akan menampilkan semua aktivitas yang telah Anda lakukan di sistem, termasuk pencarian dan pengeditan data mahasiswa.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="300">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Apakah data mahasiswa aman? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Kami memastikan bahwa data mahasiswa aman dengan menggunakan enkripsi dan langkah-langkah keamanan lainnya.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="400">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">Apa yang harus dilakukan jika data mahasiswa tidak ditemukan? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Jika data mahasiswa tidak ditemukan, pastikan Anda telah memasukkan kata kunci pencarian yang benar. Jika masih tidak ditemukan, mungkin data tersebut belum diinput ke dalam sistem. Hubungi administrator untuk informasi lebih lanjut.
                      </p>
                    </div>
                  </li>
    
                  <li data-aos="fade-up" data-aos-delay="400">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-9" class="collapsed">Bagaimana cara menghubungi layanan bantuan? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-9" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda dapat menghubungi layanan bantuan melalui halaman kontak kami atau mengirim email ke support@studentbase4c.com.
                      </p>
                    </div>
                  </li>
                  
    
                </ul>
              </div>
    
            </div>
          </section><!-- End F.A.Q Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright 2024 <strong><span>Kelompok 2 IMK</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Search Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">Cari Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="searchForm">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="searchQuery">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Cari
              </button>
            </div>
            <div id="suggestionBox"></div>
          </form>
         <p>Contoh Pencarian:</p>
         <p style="margin-top: -20px;"><b>Raihan 11220910000003 Depok</b></p>
        </div>
      </div>
    </div>
  </div>


  <script>
  document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way
    const query = document.getElementById('searchQuery').value;
    if (query.trim() !== '') {
        window.location.href = `pencarian.php?q=${encodeURIComponent(query)}`;
    }
});

  document.getElementById('searchQuery').addEventListener('input', function() {
      const query = this.value;
      if (query.length >= 2) {
          fetchSuggestions(query);
      } else {
          document.getElementById('suggestionBox').innerHTML = '';
      }
  });

  function fetchSuggestions(query) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `saran-pencarian.php?q=${encodeURIComponent(query)}`, true);
      xhr.onload = function() {
          if (this.status === 200) {
              const data = JSON.parse(this.responseText);
              let suggestions = '';
              data.forEach(item => {
                  const regex = new RegExp(`(${query})`, 'gi');
                  const highlightedName = item.nama.replace(regex, "<b>$1</b>");
                  suggestions += `<div class="suggestion-item list-group-item list-group-item-action" data-id="${item.id_mahasiswa}">
                                      ${highlightedName} (${item.nim}) Alamat: ${item.alamat}
                                  </div>`;
              });
              document.getElementById('suggestionBox').innerHTML = suggestions;
          }
      };
      xhr.send();
  }

  document.getElementById('suggestionBox').addEventListener('click', function(e) {
      if (e.target.classList.contains('suggestion-item')) {
          const id = e.target.getAttribute('data-id');
          window.location.href = `data-mahasiswa.php?id=${id}`;
      }
  });
    </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>