<?php
// mahasiswa/index.php
session_start();
include('../koneksi.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: ../masuk.php');
    exit;
}

if (isset($_GET['hapus_id'])) {
    $hapus_id = $_GET['hapus_id'];
    
    // Hapus data mahasiswa berdasarkan id
    $sql = "DELETE FROM mahasiswa WHERE id_mahasiswa = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $hapus_id);

    if ($stmt->execute()) {
        // Set timezone ke WIB
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan IP address pengguna
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $id_admin = $_SESSION['id_admin'];
        $aktivitas = 'Hapus Data Mahasiswa';
        $waktu = date('Y-m-d H:i:s');
        $tanggal = date('Y-m-d');
        $queryLog = "INSERT INTO log_aktivitas (id_admin, aktivitas, waktu, tanggal, ip) VALUES ('$id_admin', '$aktivitas', '$waktu', '$tanggal', '$ip_address')";
        mysqli_query($con, $queryLog);
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Data mahasiswa berhasil dihapus.'

        );
        header('Location: pencarian.php');
        exit;
    } else {
        echo "Gagal menghapus data mahasiswa". $stmt->error;
    }

    $stmt->close();
}

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Get student data
$id_admin = $_SESSION['id_admin']; // Assuming 'id_admin' is stored in session
$sql = "SELECT * FROM akun WHERE id_admin = '$id_admin'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "No profile found!";
    exit;
}

// Fetch the data for the student to edit
$sql = "SELECT * FROM mahasiswa";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pencarian Mahasiswa</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Gaya CSS untuk mengatur tombol secara horizontal -->
<style>
    .btn-group {
        display: flex;
    }
    .btn-group > .btn {
        flex: 1;
        margin: 0 5px;
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

</style>

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

            <li class="nav-item active">
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
                    <h1 class="h3 mb-4 text-gray-800">Pencarian Mahasiswa</h1>

                    <!-- Tabel Data Mahasiswa -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <?php if (isset($alert)): ?>
                        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
                            <?php echo $alert['message']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php
                            if (isset($_SESSION['message'])) {
                                echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                                        " . $_SESSION['message'] . "
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                                unset($_SESSION['message']);
                            }
                        ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Kesukaan</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['nim']; ?></td>
                                            <td><?php echo $row['tanggal_lahir']; ?></td>
                                            <td><?php echo $row['jenis_kelamin']; ?></td>
                                            <td><a href="https://www.google.com/maps?q=<?php echo $row['latitude'] . ',' . $row['longitude']; ?>" target="_blank"><?php echo $row['alamat']; ?></a></td>
                                            <td><?php echo $row['telepon']; ?></td>
                                            <td><?php echo $row['kesukaan']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-primary edit-btn" 
                                                            data-id="<?php echo $row['id_mahasiswa']; ?>" 
                                                            data-nama="<?php echo $row['nama']; ?>"
                                                            data-tanggal_lahir="<?php echo $row['tanggal_lahir']; ?>"
                                                            data-jenis_kelamin="<?php echo $row['jenis_kelamin']; ?>"
                                                            data-alamat="<?php echo $row['alamat']; ?>"
                                                            data-telepon="<?php echo $row['telepon']; ?>"
                                                            data-kesukaan="<?php echo $row['kesukaan']; ?>"
                                                            data-latitude="<?php echo $row['latitude']; ?>"
                                                            data-longitude="<?php echo $row['longitude']; ?>"
                                                            data-toggle="modal" data-target="#editProfileModal"><i class="fas fa-edit"></i></button>
                                                    <a href="pencarian.php?hapus_id=<?php echo $row['id_mahasiswa']; ?>" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End of Tabel Data Mahasiswa -->
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
                <form method="POST" action="profil-edit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="alamat" name="alamat">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#mapModal" id="selectLocationButton">Pilih Lokasi</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>
                        <div class="form-group">
                            <label for="kesukaan">Kesukaan</label>
                            <input type="text" class="form-control" id="kesukaan" name="kesukaan">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>
                        <input type="hidden" id="id_mahasiswa" name="id_mahasiswa">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Map Modal -->
        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Pilih Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search for an address">
                        <div class="input-group-append">
                            <button id="searchButton" class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>
                    <div id="suggestionList"></div>
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveLocationBtn" data-dismiss="modal">Simpan Lokasi Terbaru</button>
                </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom script to handle edit and delete button clicks -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
    $(document).ready(function() {
        var map, marker;
        var selectedLocation = null;

        function initMap(lat, lng) {
            if (map) {
                map.setView([lat, lng], 13);
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng]).addTo(map);
                }
                map.invalidateSize();
            } else {
                map = L.map('map').setView([lat, lng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                marker = L.marker([lat, lng]).addTo(map);
            }

            map.on('click', function(e) {
                var latlng = e.latlng;
                marker.setLatLng(latlng);
                $('#latitude').val(latlng.lat);
                $('#longitude').val(latlng.lng);
                selectedLocation = latlng;
            });
        }

        $('#mapModal').on('shown.bs.modal', function(e) {
            var latitude = parseFloat($('#latitude').val());
            var longitude = parseFloat($('#longitude').val());

            if (isNaN(latitude) || isNaN(longitude)) {
                latitude = 0; // Default value if invalid
                longitude = 0; // Default value if invalid
            }

            if (map) {
                map.remove();
                $('#map').html('<div id="map" style="height: 500px; width: 100%;"></div>');
            }
            
            initMap(latitude, longitude);
        });

        $('#searchInput').on('input', function() {
            var query = $(this).val();
            if (query.length >= 3) {
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/search?format=json&q=' + query,
                    dataType: 'json',
                    success: function(data) {
                        var suggestions = '';
                        $.each(data, function(index, item) {
                            suggestions += '<div class="suggestion-item" data-lat="' + item.lat + '" data-lon="' + item.lon + '">' + item.display_name + '</div>';
                        });
                        $('#suggestionList').html(suggestions);
                    }
                });
            } else {
                $('#suggestionList').html('');
            }
        });

        $(document).on('click', '.suggestion-item', function() {
            var lat = $(this).data('lat');
            var lon = $(this).data('lon');
            marker.setLatLng([lat, lon]);
            map.panTo([lat, lon]);
            $('#latitude').val(lat);
            $('#longitude').val(lon);
            selectedLocation = { lat: lat, lng: lon };
            $('#suggestionList').html('');
            $('#searchInput').val('');
        });

        $('#searchButton').on('click', function() {
            var query = $('#searchInput').val();
            if (query.length >= 3) {
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/search?format=json&q=' + query,
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            marker.setLatLng([lat, lon]);
                            map.setView([lat, lon], 13);
                            $('#latitude').val(lat);
                            $('#longitude').val(lon);
                            selectedLocation = { lat: lat, lng: lon };
                        }
                    }
                });
            }
        });

        var dataTable = $('#dataTable').DataTable();

        function applyEventListeners() {
        $('.edit-btn').off('click').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var tanggal_lahir = $(this).data('tanggal_lahir');
            var jenis_kelamin = $(this).data('jenis_kelamin');
            var alamat = $(this).data('alamat');
            var telepon = $(this).data('telepon');
            var kesukaan = $(this).data('kesukaan');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');

            $('#id_mahasiswa').val(id);
            $('#nama').val(nama);
            $('#tanggal_lahir').val(tanggal_lahir);
            $('#jenis_kelamin').val(jenis_kelamin);
            $('#alamat').val(alamat);
            $('#telepon').val(telepon);
            $('#kesukaan').val(kesukaan);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);

            $('#selectLocationButton').removeClass('btn-success').addClass('btn-primary').text('Pilih Lokasi');

            if (latitude && longitude) {
                initMap(parseFloat(latitude), parseFloat(longitude));
            }
        });
    }
        // Apply event listeners on initial load
        applyEventListeners();

        // Apply event listeners after each table draw (pagination, sorting, etc.)
        dataTable.on('draw', function() {
            applyEventListeners();
        });

        $('#saveLocationBtn').on('click', function() {
            if (selectedLocation) {
                $('#latitude').val(selectedLocation.lat);
                $('#longitude').val(selectedLocation.lng);

                // Mengubah warna tombol "Pilih Lokasi" pada modal edit profil
                $('#selectLocationButton').addClass('btn-success').removeClass('btn-primary').text('Lokasi Terpilih');
            }
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = url;
            }
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>