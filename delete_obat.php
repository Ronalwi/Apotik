<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM obat WHERE id_obat = '$id'");

if ($query) {
    header('Location: obat.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}