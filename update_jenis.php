<?php
include 'config.php';

$id = $_GET['id'];
        $query = mysqli_query($connect, "SELECT * FROM jenis WHERE id_jenis = '$id'");
        $data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $id_jenis = $_POST['id_jenis'];
    $nama_jenis = $_POST['nama_jenis'];

    $queryUpdate = mysqli_query($connect, "UPDATE jenis SET id_jenis='$id_jenis', nama_jenis='$nama_jenis' WHERE id_jenis = '$id_jenis'");

    if($queryUpdate){
        header('Location: jenis.php');
    }
}
?>

<html>
    <head>
        <title>Form Ubah Jenis</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah Jenis</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>NO</td>
                    <td><input type="text" name="id_jenis" id="id_jenis" value="<?php echo $data['id_jenis'] ?>" disabled></td>
                    <td><input type="text" name="id_jenis" id="id_jenis" value="<?php echo $data['id_jenis'] ?>" hidden></td>
                </tr>
                <tr>
                    <td>Nama Jenis</td>
                    <td><input type="text" name="nama_jenis" id="nama_jenis" value="<?php echo $data['nama_jenis'] ?>"></td>
                </tr>
                        
                <tr>
                <td><input type="hidden" name="id_jenis" value="<?php echo $data['id_jenis'] ?>"></td>
                <td><button type="submit" name="submit" value="update">Ubah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>