<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM karyawan WHERE id_karyawan = '$id'");

if ($query) {
    header('Location: karyawan.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}