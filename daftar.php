<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Daftar</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            color: #444444;
        }
        a {
            color: #1acc8d;
            text-decoration: none;
        }
        a:hover {
            color: #34e5a6;
            text-decoration: none;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        #footer {
            background: #010351;
            padding: 20px 0 30px 0; /* Meningkatkan padding untuk background lebih besar */
            color: #fff;
            font-size: 14px;
        }
        #footer .copyright {
            border-top: 1px solid #010479;
            text-align: center;
            padding-top: 10px;
        }
        #map {
            height: 500px; /* Ensure map container has a height */
        }
        .suggestion-item {
            padding: 5px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #e9e9e9;
        }
        @media (max-width: 768px) {
            .modal-lg {
                max-width: 90%;
            }
            .modal-map {
                max-height: calc(100vh - 100px);
                overflow-y: auto;
            }
            .d-grid .btn {
                width: 100%; /* Membuat tombol memenuhi lebar grid pada tampilan mobile */
            }
            .text-center.text-md-start {
                flex-direction: column;
                align-items: center;
            }
            .text-center.text-md-start p, 
            .text-center.text-md-start a {
                margin-bottom: 5px; /* Menambahkan margin antara elemen teks dan link */
            }
        }
        @media (min-width: 769px) {
            .d-grid .btn {
                width: auto; /* Mengatur lebar tombol kembali pada tampilan desktop */
            }
        }
    </style>
</head>
<body>
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="card border-light-subtle shadow-sm">
          <div class="row g-0">
            <div class="col-12">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-8">
                    <div class="mb-5 text-center">
                      <h2 class="fw-bold"><i class="ri-user-add-fill"></i> DAFTAR AKUN</h2>
                      <h4>Silakan Lengkapi Data Diri Anda!</h4>
                    </div>
                  </div>
                </div>
                <?php 
                session_start();
                if(isset($_SESSION['error'])): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                  </div>
                <?php endif; ?>
                <form action="daftar-proses.php" method="POST">
                  <input type="hidden" class="form-control" name="id_mahasiswa" id="id_mahasiswa" placeholder="id_mahasiswa">
                  <div class="row justify-content-center gy-3">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required>
                        <label for="nama" class="form-label">Nama Lengkap</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" required>
                        <label for="nim" class="form-label">NIM</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                          <option value="" selected disabled>Pilih Jenis Kelamin</option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3" style="height: 55px;">
                          <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
                          <button class="btn btn-secondary" type="button" id="locationButton" data-bs-toggle="modal" data-bs-target="#locationModal"><i class="ri-map-pin-line"></i> Pilih Lokasi</button>
                      </div>
                      <input type="hidden" class="form-control" name="latitude" id="latitude" required>
                      <input type="hidden" class="form-control" name="longitude" id="longitude" required>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="telepon" id="telepon" placeholder="Nomor Telepon" required>
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="kesukaan" id="kesukaan" placeholder="Kesukaan" required>
                        <label for="kesukaan" class="form-label">Kesukaan</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                          <div class="d-grid gap-1 d-md-flex justify-content-md-end mb-2">
                              <button class="btn btn-danger me-md-2 mb-2 mb-md-0" id="resetForm"><i class="ri-refresh-line"></i> Reset</button>
                              <button class="btn btn-primary" name="submit" type="submit"><i class="ri-user-add-line"></i> Daftar</button>
                          </div>
                      </div>
                    <div class="col-md-12 text-center text-md-start mt-3">
                      <div class="d-flex justify-content-center align-items-center">
                        <p class="mb-0 me-2">Sudah ada akun?</p>
                        <a href="masuk.php">Masuk disini!</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-map">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="locationModalLabel">Pilih Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari lokasi...">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">Cari</button>
        </div>
        <div id="suggestionList"></div> <!-- Daftar saran pencarian -->
        <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmLocation" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright 2024 <strong><span>Kelompok 2 IMK</span></strong>. All Rights Reserved
      </div>
    </div>
</footer>

<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([-6.1751, 106.8650], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });

document.getElementById('confirmLocation').addEventListener('click', function () {
    if (marker) {
        var latlng = marker.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        document.getElementById('locationButton').innerHTML = '<span style="color: white;">Lokasi sudah dipilih</span>';
        document.getElementById('locationButton').classList.remove('btn-secondary');
        document.getElementById('locationButton').classList.add('btn-success');
        // Mengosongkan nilai input untuk lokasi
        document.getElementById('searchInput').value = '';
        document.getElementById('latitudeInput').value = '';
        document.getElementById('longitudeInput').value = '';
        // Menghapus marker dari peta
        if (marker) {
            map.removeLayer(marker);
        }
    } else {
        alert('Silakan pilih lokasi terlebih dahulu');
    }
});


    document.getElementById('searchInput').addEventListener('input', function () {
        var query = this.value;
        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + query;

        fetch(url)
        .then(response => response.json())
        .then(data => {
            var suggestions = data.map(item => item.display_name);
            showSuggestions(suggestions);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function showSuggestions(suggestions) {
    var suggestionList = document.getElementById('suggestionList');
    suggestionList.innerHTML = '';
    suggestions.forEach(function (suggestion) {
        var item = document.createElement('div');
        item.textContent = suggestion;
        item.classList.add('suggestion-item');
        item.addEventListener('click', function () {
            document.getElementById('searchInput').value = suggestion;
            suggestionList.innerHTML = '';
            updateMapLocation(suggestion);
        });
        suggestionList.appendChild(item);
    });
}

function updateMapLocation(location) {
    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + location;

    fetch(url)
    .then(response => response.json())
    .then(data => {
        var lat = data[0].lat;
        var lon = data[0].lon;
        var newLatLng = new L.LatLng(lat, lon);
        map.setView(newLatLng, 13);
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(newLatLng).addTo(map);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.getElementById('searchButton').addEventListener('click', function () {
    var query = document.getElementById('searchInput').value;
    if (query.trim() !== '') {
        searchLocation(query);
    }
});

function searchLocation(query) {
    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + query;

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            var location = data[0];
            updateMapLocation(location.display_name);
        } else {
            console.log('Lokasi tidak ditemukan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.getElementById('resetForm').addEventListener('click', function() {
    // Mendapatkan semua elemen input dalam form
    var inputs = document.querySelectorAll('input[type="text"], input[type="tel"], input[type="date"], input[type="password"], select');
    
    // Mereset nilai semua input menjadi kosong
    inputs.forEach(function(input) {
        input.value = '';
    });

    // Menghapus kelas btn-success dari tombol Pilih Lokasi jika ada
    var locationButton = document.getElementById('locationButton');
    if (locationButton.classList.contains('btn-success')) {
        locationButton.classList.remove('btn-success');
        locationButton.classList.add('btn-secondary');
        locationButton.innerHTML = 'Pilih Lokasi';
    }
});


    document.getElementById('locationModal').addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
            map.invalidateSize();
        }, 10);
    });
});
</script>
</body>
</html>
