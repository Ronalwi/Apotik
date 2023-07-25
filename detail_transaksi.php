<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Kategori Obat</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='main.js'></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<?php
include 'config.php';
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

 if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM detail_transaksi INNER JOIN obat ON detail_transaksi.id_obat=obat.id_obat INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = '$id'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);
    setLocale(LC_ALL, 'id-ID', 'id_ID');

    if ($result) {
        // header('location: kategori.php');
    } else {
        echo 'Gagal Dihapus';
    }
 }

    include 'sidebar.php';
  ?>

  <div class="content">

  <h1>
    Detail Transaksi
  </h1><br>
  <h3>
    ID Transaksi :
    <?php echo $data['id_transaksi']  ?>
  </h3>
  <h3>
    Nama Transaksi :
    <?php echo $data['nama_pelanggan']  ?>
  </h3>
  <h3>
    Usia :
    <?php echo $data['usia']  ?>
  </h3>
  <h3>
    No. Telepon :
    <?php echo $data['no_hp']  ?>
  </h3><br>

    <div id="box1">
        <table border="1" width="90%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
                        $no = 1;
                        $query = "SELECT * FROM detail_transaksi INNER JOIN obat ON detail_transaksi.id_obat=obat.id_obat INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = '$id'";
                        $result = mysqli_query($connect, $query);
                        setLocale(LC_ALL, 'id-ID', 'id_ID');

                        while ($data = mysqli_fetch_array($result))
                        {
                            $subtotal = $data['harga_obat'] * $data['jumlah_pembelian'];
                    ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['nama_obat']?></td>
                        <td><?php echo $data['jumlah_pembelian']?></td>
                        <td><?php echo $subtotal?></td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                    <tr>
                        <td colspan='3' align='right'>total</td>
                        <td>
                            <?php
                                $query = "SELECT SUM(harga_obat * jumlah_pembelian) AS total FROM detail_transaksi INNER JOIN obat ON detail_transaksi.id_obat=obat.id_obat INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = '$id'";
                                $result = mysqli_query($connect, $query);
                                $data = mysqli_fetch_array($result);
                                echo $data['total'];
                            ?>
                    </tr>
                    <tr>
                   <td colspan='4'><button onclick="location.href='transaksi.php'">Kembali</button></td> 
            </tr>
            </tbody>
        </table>

    </div>
    </div>
</body>
</html>    