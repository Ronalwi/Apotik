<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_obat = $_POST['id_obat'];
    $nama_obat = $_POST['nama_obat'];
    $jenis = $_POST['jenis'];
    $harga_obat = $_POST['harga_obat'];
    $stock = $_POST['stock'];
    $kategori = $_POST['kategori'];
    $lokasi = $_POST['lokasi'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($connect, "UPDATE obat SET nama_obat = '$nama_obat', id_jenis = '$jenis', harga_obat = '$harga_obat', stock = '$stock', kategori_obat = '$kategori', id_rak = '$lokasi', status = '$status', keterangan = '$keterangan' WHERE id_obat = '$id_obat'");

    if($query){
        header('Location: obat.php');
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM obat INNER JOIN jenis ON obat.id_jenis=jenis.id_jenis INNER JOIN kategori ON obat.kategori_obat=kategori.id_kategori INNER JOIN lokasi ON obat.id_rak=lokasi.id_rak WHERE id_obat = '$id' order by id_obat asc";

    if ($data = mysqli_fetch_array(mysqli_query($connect, $query))) {
        $id_obat = $data['id_obat'];
        $nama_obat = $data['nama_obat'];
        $jenis = $data['nama_jenis'];
        $harga_obat = $data['harga_obat'];
        $stock = $data['stock'];
        $kategori = $data['nama_kategori'];
        $lokasi = $data['nama_rak'];
        $status = $data['status'];
        $keterangan = $data['keterangan'];
    }
}

?>

<html>
    <head>
        <title>Form Ubah obat</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah obat</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id Obat</td>
                    <td><input type="text" name="id_obat" disabled value="<?php echo $id_obat?>"></td>
                    <td><input type="text" name="id_obat" hidden value="<?php echo $id_obat?>"></td>
                </tr>
                <tr>
                    <td>Nama Obat</td>
                    <td><input type="text" name="nama_obat" required value="<?php echo $nama_obat?>"></td>
                </tr>
                <tr>
                    <td>Jenis</td>
                    <td>
                    <select name="jenis" id="jenis">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM jenis");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_jenis'] ?>" <?php if ($jenis== $data['nama_jenis']) {echo 'selected';}?>><?php echo $data['nama_jenis'] ?></option>
                                <?php } ?>
                    </select>
                    </td>

                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga_obat" required value="<?php echo $harga_obat?>"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stock" required value="<?php echo $stock?>"></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><select name="kategori" id="kategori">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM kategori");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_kategori'] ?>" <?php if ($kategori== $data['nama_kategori']) {echo 'selected';}?>><?php echo $data['nama_kategori'] ?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Rak</td>
                    <td><select name="lokasi" id="lokasi">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM lokasi");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_rak'] ?>" <?php if ($lokasi== $data['nama_rak']) {echo 'selected';}?>><?php echo $data['nama_rak'] ?></option>
                                <?php } ?>
                            </select></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php
                            $result = mysqli_query($connect, "SHOW COLUMNS FROM obat LIKE 'status'");
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $enumValues = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type']));
                            }
                            ?>
                            <select name="status" id="status">
                                <?php foreach ($enumValues as $value) : ?>
                                    <option value="<?php echo $value ?>" <?php if ($status== $value) { echo 'selected'; }?> ><?php echo $value ?></option>
                                <?php endforeach; ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><input type="text" name="keterangan" required value="<?php echo $keterangan?>"></td>
                </tr>
                                       
                <tr>
                <td>&nbsp;</td>
                <td><button type="submit" name="submit" value="insert">Ubah</button></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>