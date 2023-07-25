<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM kategori WHERE id_kategori = '$id'");

if ($query) {
    header('Location: kategori.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}