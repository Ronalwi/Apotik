<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM transaksi WHERE id_transaksi = '$id'");

if ($query) {
    header('Location: transaksi.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}