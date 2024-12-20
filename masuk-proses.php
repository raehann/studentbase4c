<?php
session_start();
require 'koneksi.php';

if (isset($_POST['nim']) && isset($_POST['password'])) {
    $nim = trim($_POST['nim']); // Trim whitespace from input
    $password = trim($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR']; // Get user's IP address

    date_default_timezone_set('Asia/Jakarta');

    // Check if the user is an admin
    $queryAdmin = "SELECT id_admin, username, password, role FROM akun WHERE role = '$nim'";
    $resultAdmin = mysqli_query($con, $queryAdmin);

    if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);

        if (password_verify($password, $rowAdmin['password'])) {
            $_SESSION['id_admin'] = $rowAdmin['id_admin'];
            $_SESSION['username'] = $rowAdmin['username'];
            $_SESSION['role'] = $rowAdmin['role'];
            $_SESSION['is_logged_in'] = true;

            // Log the admin login activity
            $aktivitas = 'Login';
            $waktu = date('Y-m-d H:i:s');
            $tanggal = date('Y-m-d');
            $sql_log = "INSERT INTO log_aktivitas (id_admin, aktivitas, waktu, tanggal, ip) VALUES ('{$rowAdmin['id_admin']}', '$aktivitas', '$waktu', '$tanggal', '$ip')";
            mysqli_query($con, $sql_log);

            header("Location: admin/index.php"); // Replace with appropriate admin page
            exit();
        } else {
            $_SESSION['error'] = "Password admin salah";
            header("Location: masuk.php");
            exit();
        }
    } else {
        // Check if the user is a student
        $queryStudent = "SELECT id_mahasiswa, nim, nama, tanggal_lahir, jenis_kelamin, alamat, telepon, kesukaan, password FROM mahasiswa WHERE nim = '$nim'";
        $resultStudent = mysqli_query($con, $queryStudent);

        if ($resultStudent && mysqli_num_rows($resultStudent) > 0) {
            $rowStudent = mysqli_fetch_assoc($resultStudent);

            if (password_verify($password, $rowStudent['password'])) {
                $_SESSION['nama'] = $rowStudent['nama'];
                $_SESSION['nim'] = $rowStudent['nim'];
                $_SESSION['tanggal_lahir'] = $rowStudent['tanggal_lahir'];
                $_SESSION['jenis_kelamin'] = $rowStudent['jenis_kelamin'];
                $_SESSION['alamat'] = $rowStudent['alamat'];
                $_SESSION['telepon'] = $rowStudent['telepon'];
                $_SESSION['kesukaan'] = $rowStudent['kesukaan'];
                $_SESSION['id_mahasiswa'] = $rowStudent['id_mahasiswa'];
                $_SESSION['is_logged_in'] = true;

                // Log the student login activity
                $aktivitas = 'Login';
                $waktu = date('Y-m-d H:i:s');
                $tanggal = date('Y-m-d');
                $sql_log = "INSERT INTO log_aktivitas (id_mahasiswa, aktivitas, waktu, tanggal, ip) VALUES ('{$rowStudent['id_mahasiswa']}', '$aktivitas', '$waktu', '$tanggal', '$ip')";
                mysqli_query($con, $sql_log);

                header("Location: mahasiswa/index.php"); // Replace with appropriate student page
                exit();
            } else {
                $_SESSION['error'] = "Password mahasiswa salah";
                header("Location: masuk.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "NIM tidak terdaftar";
            header("Location: masuk.php");
            exit();
        }
    }
}
?>
