<?php
require 'koneksi.php';

if (isset($_GET['q'])) {
    $q = $_GET['q'];

    // Split the search query into individual terms
    $terms = explode(' ', $q);

    // Initialize an empty array to store the WHERE conditions
    $conditions = array();

    // Build the WHERE conditions for each term
    foreach ($terms as $term) {
        $conditions[] = "nama LIKE '%$term%' OR nim LIKE '%$term%' OR alamat LIKE '%$term%'";
    }

    // Join the WHERE conditions with OR operator
    $whereClause = implode(' OR ', $conditions);

    // Construct the SQL query
    $sql = "SELECT id_mahasiswa, nama, nim, alamat, latitude, longitude FROM mahasiswa WHERE $whereClause";
    $result = $con->query($sql);

    $mahasiswa = array();
    while ($row = $result->fetch_assoc()) {
        $mahasiswa[] = $row;
    }

    $con->close();
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-y: hidden; /* Disable vertical scroll */
        }

        @media (max-width: 992px) {
            body, html {
                overflow-y: auto; /* Enable vertical scroll for mobile devices */
            }
        }

#main {
    margin-top: 100px; /* Tambahkan spasi dari atas sesuai dengan kebutuhan */
    display: flex;
    justify-content: center; /* Tengah-tengah secara horizontal */
    flex-direction: column; /* Agar konten berada di tengah secara vertikal */
    min-height: calc(100vh - 200px); /* Menyisakan ruang untuk footer */
}

footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 100px; /* Tinggi footer sesuai kebutuhan */
    background-color: #f8f9fa; /* Warna background footer */
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

/* Additional styles for scrollable table */
.scrollable-table-container {
    overflow-y: auto;
    max-height: 400px;
}
table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            position: sticky;
            top: 0;
            background-color: #f2f2f2;
            z-index: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            position: sticky;
            top: 0;
            background-color: #f2f2f2;
            z-index: 1;
        }
</style>
</head>
<body>
      <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php"><span>StudentBase4C</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="index.php#features">Fitur</a></li>
          <li><a class="nav-link scrollto" href="index.php#faq">FAQ</a></li>
          <li><a class="nav-link scrollto active" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">Cari Mahasiswa</a></li>
          <li><a class="nav-link scrollto" href="daftar.php">Daftar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    <div class="container" id="main">
        <h2>Hasil Pencarian</h2>
        <div class="scrollable-table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($mahasiswa) > 0): ?>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td><a href="data-mahasiswa.php?id=<?= htmlspecialchars($mhs['id_mahasiswa']); ?>"><?= htmlspecialchars($mhs['nama']); ?></a></td>
                                <td><?= htmlspecialchars($mhs['nim']); ?></td>
                                <td>
                                    <a href="https://www.google.com/maps/place/<?php echo htmlspecialchars($mhs['latitude']); ?>,+<?php echo htmlspecialchars($mhs['longitude']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($mhs['alamat']); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Tidak ada hasil yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer id="footer">
    <div class="container">
        <div class="copyright">
        &copy; Copyright 2024 <strong><span>Kelompok 2 IMK</span></strong>. All Rights Reserved
        </div>
    </div>
    </footer>

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
            console.log(`ID yang diklik: ${id}`);
            window.location.href = `data-mahasiswa.php?id=${id}`;
        }
    });
    </script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
