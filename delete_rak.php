<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM lokasi WHERE id_rak = '$id'");

if ($query) {
    header('Location: rak.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}