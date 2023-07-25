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

    // $query = mysqli_query($connect, "INSERT INTO obat VALUES ('$id_obat', '$nama_obat', '$jenis', '$harga_obat', '$stock', '$kategori', '$lokasi', '$status', '$keterangan')");

    // Validasi apakah ID obat sudah ada
    $checkQuery = mysqli_query($connect, "SELECT id_obat FROM obat WHERE id_obat = '$id_obat'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID obat sudah ada. Silakan masukkan ID obat yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO obat VALUES ('$id_obat', '$nama_obat', '$jenis', '$harga_obat', '$stock', '$kategori', '$lokasi', '$status', '$keterangan')");


    if($query){
        header('Location: obat.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah Obat</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
    <?php
    
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">
    
        <h1>Tambah Obat</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id Obat</td>
                    <td><input type="text" name="id_obat" required></td>
                </tr>
                <tr>
                    <td>Nama Obat</td>
                    <td><input type="text" name="nama_obat" required></td>
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
                                    <option value="<?php echo $data['id_jenis'] ?>"><?php echo $data['nama_jenis'] ?></option>
                                <?php } ?>
                    </select>
                    </td>

                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga_obat" required></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stock" required></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><select name="kategori" id="kategori">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM kategori");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama_kategori'] ?></option>
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
                                    <option value="<?php echo $data['id_rak'] ?>"><?php echo $data['nama_rak'] ?></option>
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
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php endforeach; ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><input type="text" name="keterangan" required></td>
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