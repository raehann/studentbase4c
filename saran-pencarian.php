<?php
include 'koneksi.php';

$q = $_GET['q'];

$sql = "SELECT id_mahasiswa, nama, nim, alamat FROM mahasiswa WHERE nama LIKE '%$q%' OR nim LIKE '%$q%' OR alamat LIKE '%$q%'";
$result = $con->query($sql);

if (!$result) {
    die('Query error: ' . $con->error);
}

$suggestions = array();
while($row = $result->fetch_assoc()) {
    $suggestions[] = $row;
}

echo json_encode($suggestions);

$con->close();
?>
