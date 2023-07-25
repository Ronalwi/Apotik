<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM user WHERE id_user = '$id'");

if ($query) {
    header('Location: user.php');
    exit(); 
} else {
    echo "Error deleting record: " . mysqli_error($connect);
}