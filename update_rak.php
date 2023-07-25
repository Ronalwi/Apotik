<?php
include 'config.php';

$id = $_GET['id'];
        $query = mysqli_query($connect, "SELECT * FROM lokasi WHERE id_rak = '$id'");
        $data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $id_rak = $_POST['id_rak'];
    $nama_rak = $_POST['nama_rak'];

    $queryUpdate = mysqli_query($connect, "UPDATE lokasi SET id_rak='$id_rak', nama_rak='$nama_rak' WHERE id_rak = '$id_rak'");

    if($queryUpdate){
        header('Location: rak.php');
    }
}
?>

<html>
    <head>
        <title>Form Ubah Rak</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah Rak</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>NO</td>
                    <td><input type="text" name="id_rak" id="id_rak" value="<?php echo $data['id_rak'] ?>" disabled></td>
                    <td><input type="text" name="id_rak" id="id_rak" value="<?php echo $data['id_rak'] ?>" hidden></td>
                </tr>
                <tr>
                    <td>Nama Rak</td>
                    <td><input type="text" name="nama_rak" id="nama_rak" value="<?php echo $data['nama_rak'] ?>"></td>
                </tr>
                        
                <tr>
                <td><input type="hidden" name="id_rak" value="<?php echo $data['id_rak'] ?>"></td>
                <td><button type="submit" name="submit" value="update">Ubah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>