<?phpsession_start();?>
<?php
include 'config.php';

function getRingkasanData()
{
    global $connect;
    $query = "SELECT COUNT(*) AS total_obat FROM obat";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function getPenjualanBulanIni()
{
    global $connect;
    $query = "SELECT SUM(total_harga) AS penjualan_bulan_ini FROM transaksi WHERE MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['penjualan_bulan_ini'];
}

function getTransaksiBulanIni()
{
    global $connect;
    $query = "SELECT COUNT(*) AS transaksi_bulan_ini FROM transaksi WHERE MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['transaksi_bulan_ini'];
}

function getJumlahJenis()
{
    global $connect;
    $query = "SELECT COUNT(*) AS jumlah_jenis FROM jenis";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['jumlah_jenis'];
}

function getJumlahKategori()
{
    global $connect;
    $query = "SELECT COUNT(*) AS jumlah_kategori FROM kategori";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['jumlah_kategori'];
}

function getJumlahLokasi()
{
    global $connect;
    $query = "SELECT COUNT(*) AS jumlah_lokasi FROM lokasi";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['jumlah_lokasi'];
}

$ringkasanData = getRingkasanData();
$penjualanBulanIni = getPenjualanBulanIni();
$transaksiBulanIni = getTransaksiBulanIni();
$jumlahJenis = getJumlahJenis();
$jumlahKategori = getJumlahKategori();
$jumlahLokasi = getJumlahLokasi();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php 

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

include 'sidebar.php';
  ?>

  <div class="content">
  
  </div>

        <div class="content">
            <?php include 'sidebar.php'; ?>

            <div class="main">
                <h1>Dashboard</h1>
                <h2>Ringkasan Data</h2><br>

                <div id='card_flex'>
                <div class='dashboard_card' style='background-color: #4caf50'>
                    <div>Total Obat</div>
                    <div style='font-size: 30px'><?php echo $ringkasanData['total_obat']; ?></div>
                </div>
                <div class='dashboard_card' style='background-color: lightblue'>
                    <div>Penjualan Bulan Ini</div>
                    <div style='font-size: 30px'><?php echo $penjualanBulanIni; ?></div>
                </div>
                <div class='dashboard_card' style='background-color: orange'>
                    <div>Transaksi Bulan Ini</div>
                    <div style='font-size: 30px'><?php echo $transaksiBulanIni; ?></div>
                </div>
                <div class='dashboard_card' style='background-color: #ff0000'>
                    <div>Jumlah Jenis</div>
                    <div style='font-size: 30px'><?php echo $jumlahJenis; ?></div>
                </div>
                <div class='dashboard_card' style='background-color: #00ffff'>
                    <div>Jumlah Kategori</div>
                    <div style='font-size: 30px'><?php echo $jumlahKategori; ?></div>
                </div>
                <div class='dashboard_card' style='background-color: #66ff66'>
                    <div>Jumlah Lokasi</div>
                    <div style='font-size: 30px'><?php echo $jumlahLokasi; ?></div>
                </div>
                </div>   

            </div>
        </div>

    </div>
</body>
</html>