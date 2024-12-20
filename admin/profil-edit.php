<?php
session_start();
include('../koneksi.php');


// Check if user is logged in
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: ../masuk.php');
    exit;
}

// Get form data
$id_mahasiswa = $_POST['id_mahasiswa'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kesukaan = $_POST['kesukaan'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$password = $_POST['password'];

// Prepare update query
$sql = "UPDATE mahasiswa SET 
    nama='$nama', 
    tanggal_lahir='$tanggal_lahir', 
    jenis_kelamin='$jenis_kelamin', 
    alamat='$alamat', 
    telepon='$telepon', 
    kesukaan='$kesukaan', 
    latitude='$latitude', 
    longitude='$longitude'";

// Check if password is provided
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", password='$hashed_password'";
}

$sql .= " WHERE id_mahasiswa='$id_mahasiswa'";

if ($con->query($sql) === TRUE) {
    $_SESSION['message'] = "Profil mahasiswa berhasil diedit";
    // Set timezone ke WIB
    date_default_timezone_set('Asia/Jakarta');

    // Mendapatkan IP address pengguna
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $id_admin = $_SESSION['id_admin'];
    $aktivitas = 'Edit Profil ' . $nama;
    $waktu = date('Y-m-d H:i:s');
    $tanggal = date('Y-m-d');
    $queryLog = "INSERT INTO log_aktivitas (id_admin, aktivitas, waktu, tanggal, ip) VALUES ('$id_admin', '$aktivitas', '$waktu', '$tanggal', '$ip_address')";
    mysqli_query($con, $queryLog);
} else {
    $_SESSION['message'] = "Error updating profile: " . $con->error;
}

header('Location: pencarian.php');
?>
