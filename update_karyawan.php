<?php
include 'config.php';

$id = $_GET['id'];
        $query = mysqli_query($connect, "SELECT * FROM karyawan WHERE id_karyawan = '$id'");
        $data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama_karyawan = $_POST['nama_karyawan'];

    $queryUpdate = mysqli_query($connect, "UPDATE karyawan SET id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan' WHERE id_karyawan = '$id_karyawan'");

    if($queryUpdate){
        header('Location: karyawan.php');
    }
}
?>

<html>
    <head>
        <title>Form Ubah Karyawan</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah Karyawan</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id Karyawan</td>
                    <td><input type="text" name="id_karyawan" id="id_karyawan" value="<?php echo $data['id_karyawan'] ?>" disabled></td>
                    <td><input type="text" name="id_karyawan" id="id_karyawan" value="<?php echo $data['id_karyawan'] ?>" hidden></td>
                </tr>
                <tr>
                    <td>Nama karyawan</td>
                    <td><input type="text" name="nama_karyawan" id="nama_karyawan" value="<?php echo $data['nama_karyawan'] ?>"></td>
                </tr>
                        
                <tr>
                <td><input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'] ?>"></td>
                <td><button type="submit" name="submit" value="update">Ubah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>