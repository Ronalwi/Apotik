<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    // $query = mysqli_query($connect, "INSERT INTO kategori (id_kategori, nama_kategori) VALUES ('$id_kategori', '$nama_kategori')");

    // Validasi apakah ID kategori sudah ada
    $checkQuery = mysqli_query($connect, "SELECT id_kategori FROM kategori WHERE id_kategori = '$id_kategori'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID kategori sudah ada. Silakan masukkan ID kategori yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO kategori (id_kategori, nama_kategori) VALUES ('$id_kategori', '$nama_kategori')");

    if($query){
        header('Location: kategori.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah Kategori</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php
    
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">
 
        <h1>Tambah Kategori</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>No</td>
                    <td><input type="text" name="id_kategori" required></td>
                </tr>
                <tr>
                    <td>Nama Kategori</td>
                    <td><input type="text" name="nama_kategori" required></td>
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