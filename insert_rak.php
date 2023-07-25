<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_rak = $_POST['id_rak'];
    $nama_rak = $_POST['nama_rak'];

    // $query = mysqli_query($connect, "INSERT INTO lokasi (id_rak, nama_rak) VALUES ('$id_rak', '$nama_rak')");

    // Validasi apakah ID rak sudah ada
    $checkQuery = mysqli_query($connect, "SELECT id_rak FROM lokasi WHERE id_rak = '$id_rak'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID rak sudah ada. Silakan masukkan ID rak yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO lokasi (id_rak, nama_rak) VALUES ('$id_rak', '$nama_rak')");

    if($query){
        header('Location: rak.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah Rak</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Tambah Rak</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>No</td>
                    <td><input type="text" name="id_rak" required></td>
                </tr>
                <tr>
                    <td>Nama Rak</td>
                    <td><input type="text" name="nama_rak" required></td>
                </tr>
                                       
                    </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                <td><button type="submit" name="submit" value="insert">Tambah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>