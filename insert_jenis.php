<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_jenis = $_POST['id_jenis'];
    $nama_jenis = $_POST['nama_jenis'];

    // Validasi apakah ID jenis sudah ada
    $checkQuery = mysqli_query($connect, "SELECT id_jenis FROM jenis WHERE id_jenis = '$id_jenis'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID jenis sudah ada. Silakan masukkan ID jenis yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO jenis (id_jenis, nama_jenis) VALUES ('$id_jenis', '$nama_jenis')");


    // $query = mysqli_query($connect, "INSERT INTO jenis (id_jenis, nama_jenis) VALUES ('$id_jenis', '$nama_jenis')");

    if($query){
        header('Location: jenis.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah Jenis</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php
    
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">
    
        <h1>Tambah Jenis</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>No</td>
                    <td><input type="text" name="id_jenis" required></td>
                </tr>
                <tr>
                    <td>Nama Jenis</td>
                    <td><input type="text" name="nama_jenis" required></td>
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