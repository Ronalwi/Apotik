<?php
include 'config.php';

$id = $_GET['id'];
        $query = mysqli_query($connect, "SELECT * FROM kategori WHERE id_kategori = '$id'");
        $data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    $queryUpdate = mysqli_query($connect, "UPDATE kategori SET id_kategori='$id_kategori', nama_kategori='$nama_kategori' WHERE id_kategori = '$id_kategori'");

    if($queryUpdate){
        header('Location: kategori.php');
    }
}
?>

<html>
    <head>
        <title>Form Ubah Kategori</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah Kategori</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>NO</td>
                    <td><input type="text" name="id_kategori" id="id_kategori" value="<?php echo $data['id_kategori'] ?>" disabled></td>
                    <td><input type="text" name="id_kategori" id="id_kategori" value="<?php echo $data['id_kategori'] ?>" hidden></td>
                </tr>
                <tr>
                    <td>Nama Kategori</td>
                    <td><input type="text" name="nama_kategori" id="nama_kategori" value="<?php echo $data['nama_kategori'] ?>"></td>
                </tr>
                        
                <tr>
                <td><input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'] ?>"></td>
                <td><button type="submit" name="submit" value="update">Ubah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>