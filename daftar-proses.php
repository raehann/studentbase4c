<?php
require('koneksi.php');
session_start();

$error = '';
$validate = '';
if (isset($_SESSION['nama'])) header('Location: index.php');

if (isset($_POST['submit'])) {
    $nama = stripslashes($_POST['nama']);
    $nama = mysqli_real_escape_string($con, $nama);
    $nim = stripslashes($_POST['nim']);
    $nim = mysqli_real_escape_string($con, $nim);
    $tanggal_lahir = stripslashes($_POST['tanggal_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($con, $tanggal_lahir);
    $jenis_kelamin = stripslashes($_POST['jenis_kelamin']);
    $jenis_kelamin = mysqli_real_escape_string($con, $jenis_kelamin);
    $alamat = stripslashes($_POST['alamat']);
    $alamat = mysqli_real_escape_string($con, $alamat);
    $telepon = stripslashes($_POST['telepon']);
    $telepon = mysqli_real_escape_string($con, $telepon);
    $kesukaan = stripslashes($_POST['kesukaan']);
    $kesukaan = mysqli_real_escape_string($con, $kesukaan);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $latitude = stripslashes($_POST['latitude']);
    $latitude = mysqli_real_escape_string($con, $latitude);
    $longitude = stripslashes($_POST['longitude']);
    $longitude = mysqli_real_escape_string($con, $longitude);

    if (!empty(trim($nama)) && !empty(trim($nim)) && !empty(trim($tanggal_lahir)) && !empty(trim($jenis_kelamin)) && !empty(trim($alamat)) && !empty(trim($telepon)) && !empty(trim($kesukaan)) && !empty(trim($password)) && !empty(trim($latitude)) && !empty(trim($longitude))) {
        if (cek_nim($nim, $con) == 0) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO mahasiswa (id_mahasiswa, nama, nim, tanggal_lahir, jenis_kelamin, alamat, telepon, kesukaan, password, latitude, longitude) VALUES ('', '$nama', '$nim', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$telepon', '$kesukaan', '$pass', '$latitude', '$longitude')";
            $result = mysqli_query($con, $query);

            if ($result) {
                $_SESSION['nama'] = $nama;
                $_SESSION['nim'] = $nim;
                $_SESSION['tanggal_lahir'] = $tanggal_lahir;
                $_SESSION['jenis_kelamin'] = $jenis_kelamin;
                $_SESSION['alamat'] = $alamat;
                $_SESSION['telepon'] = $telepon;
                $_SESSION['kesukaan'] = $kesukaan;
                header('Location: masuk.php');
            } else {
                $_SESSION['error'] = 'Pendaftaran Mahasiswa Gagal !!';
                header('Location: daftar.php');
            }
        } else {
            $_SESSION['error'] = 'NIM sudah terdaftar !!';
            header('Location: daftar.php');
        }
    } else {
        $_SESSION['error'] = 'Data tidak boleh kosong !!';
        header('Location: daftar.php');
    }
}

function cek_nim($nim, $con) {
    $nim = mysqli_real_escape_string($con, $nim);
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    if ($result = mysqli_query($con, $query)) return mysqli_num_rows($result);
}
?>
