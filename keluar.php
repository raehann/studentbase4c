<?php
session_start();
require 'koneksi.php';

// Set timezone ke WIB
date_default_timezone_set('Asia/Jakarta');

// Mendapatkan IP address pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

// Mendapatkan informasi pengguna dari session dan mencatat aktivitas logout
if (isset($_SESSION['id_admin'])) {
    $id_admin = $_SESSION['id_admin'];
    $aktivitas = 'Logout';
    $waktu = date('Y-m-d H:i:s');
    $tanggal = date('Y-m-d');
    $queryLog = "INSERT INTO log_aktivitas (id_admin, aktivitas, waktu, tanggal, ip) VALUES ('$id_admin', '$aktivitas', '$waktu', '$tanggal', '$ip_address')";
    mysqli_query($con, $queryLog);
} elseif (isset($_SESSION['id_mahasiswa'])) {
    $id_mahasiswa = $_SESSION['id_mahasiswa'];
    $aktivitas = 'Logout';
    $waktu = date('Y-m-d H:i:s');
    $tanggal = date('Y-m-d');
    $queryLog = "INSERT INTO log_aktivitas (id_mahasiswa, aktivitas, waktu, tanggal, ip) VALUES ('$id_mahasiswa', '$aktivitas', '$waktu', '$tanggal', '$ip_address')";
    mysqli_query($con, $queryLog);
}

// Menghapus semua session
session_unset();
session_destroy();

// Redirect ke halaman utama
header("Location: index.php");
exit();
?>