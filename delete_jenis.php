<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM jenis WHERE id_jenis = '$id'");

if ($query) {
    header('Location: jenis.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}