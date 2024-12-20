<?php
// admin/index.php
session_start();
include('../koneksi.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: ../masuk.php');
    exit;
}

// Get admin data
$id_admin = $_SESSION['id_admin']; 
$sql = "SELECT * FROM akun WHERE id_admin = '$id_admin'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Silahkan masuk terlebih dahulu!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                <i class="fas fa-user-astronaut"></i>
                </div>
                <div class="sidebar-brand-text mx-3">StudentBase4C</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Administrator</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <li class="nav-item">
                <a class="nav-link" href="pencarian.php">
                    <i class="fas fa-fw fa-search"></i>
                    <span>Pencarian</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="riwayat-aktivitas.php">
                    <i class="fas fa-fw fa-history"></i>
                    <span>History</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../keluar.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </nav>
        <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Administrator</h1>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-info'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                <!-- Profile Information -->
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Username:</strong> <?php echo $admin['username']; ?></p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal" style="width: 150px;">Edit Profil Admin</button>
                    </div>
                </div>
            </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer id="footer">
                <div class="container">
                <div class="copyright text-center" style="padding: 10px; ">
                    &copy; Copyright 2024 <strong><span>Kelompok 2 IMK</span></strong>. All Rights Reserved
                </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="admin-edit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $admin['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
    $(document).ready(function() {
        var map;
        var marker;
        var latitude = parseFloat('<?php echo $student['latitude']; ?>');
        var longitude = parseFloat('<?php echo $student['longitude']; ?>');

        function initializeMap() {
            map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([latitude, longitude]).addTo(map);

            map.on('click', function(e) {
                var latLng = e.latlng;
                marker.setLatLng(latLng).update();
                $('#latitude').val(latLng.lat);
                $('#longitude').val(latLng.lng);
            });
        }

        $('#mapModal').on('shown.bs.modal', function () {
            if (!map) {
                initializeMap();
            } else {
                map.invalidateSize();
            }
        });

        $('#saveLocationBtn').on('click', function() {
            var latLng = marker.getLatLng();
            $('#latitude').val(latLng.lat);
            $('#longitude').val(latLng.lng);
            $('.btn-outline-secondary[data-target="#mapModal"]').text('Lokasi sudah dipilih').removeClass('btn-outline-secondary').addClass('btn-success');
        });

        function showSuggestions(suggestions) {
    var suggestionList = document.getElementById('suggestionList');
    suggestionList.innerHTML = '';
    suggestions.forEach(function (suggestion) {
        var item = document.createElement('div');
        item.textContent = suggestion.display_name;
        item.classList.add('suggestion-item');
        item.addEventListener('click', function () {
            document.getElementById('searchInput').value = suggestion.display_name;
            suggestionList.innerHTML = '';
            searchLocation(suggestion.display_name); // Langsung cari lokasi berdasarkan suggestion yang dipilih
        });
        suggestionList.appendChild(item);
    });
}

function searchLocation(query) {
    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + query;

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            var location = data[0];
            var latLng = [location.lat, location.lon];
            marker.setLatLng(latLng).update();
            map.setView(latLng, 13);
            $('#latitude').val(location.lat);
            $('#longitude').val(location.lon);
        } else {
            console.log('Lokasi tidak ditemukan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

$(document).ready(function() {
    // Event listener for search input
    $('#searchInput').on('input', function() {
        var query = $(this).val();
        if (query.trim() !== '') {
            var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + query;
            fetch(url)
            .then(response => response.json())
            .then(data => {
                showSuggestions(data); // Menampilkan daftar saran berdasarkan input
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            $('#suggestionList').html(''); // Kosongkan suggestion list jika input kosong
        }
    });
});

    });
    </script>
</body>

</html>