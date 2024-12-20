<?php
session_start();
include('../koneksi.php');

// Check if user is logged in
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: ../masuk.php');
    exit;
}

// Get form data
$id_admin = $_SESSION['id_admin'];
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare update query
$sql = "UPDATE akun SET 
    username='$username'";

// Check if password is provided
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", password='$hashed_password'";
}

$sql .= " WHERE id_admin='$id_admin'";

if ($con->query($sql) === TRUE) {
    $_SESSION['message'] = "Profil admin berhasil diedit";
} else {
    $_SESSION['message'] = "Error updating profile: " . $con->error;
}

header('Location: index.php');
?>
