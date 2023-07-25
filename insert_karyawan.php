<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama_karyawan = $_POST['nama_karyawan'];

    $checkQuery = mysqli_query($connect, "SELECT id_karyawan FROM karyawan WHERE id_karyawan = '$id_karyawan'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID karyawan sudah ada. Silakan masukkan ID karyawan yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO karyawan (id_karyawan, nama_karyawan) VALUES ('$id_karyawan', '$nama_karyawan')");

    if($query){
        header('Location: karyawan.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah Karyawan</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php
    
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">
    
        <h1>Tambah Karyawan</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id Karyawan</td>
                    <td><input type="text" name="id_karyawan" required></td>
                </tr>
                <tr>
                    <td>Nama Karyawan</td>
                    <td><input type="text" name="nama_karyawan" required></td>
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