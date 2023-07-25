<?php
session_start();
?>

<div class="sidebar">
<h1>Apotek</h1>
    <ul>
        <li><a href="dashboard.php" <?php if ($currentPage == 'dashboard') echo 'class="active"'; ?>>Dashboard</a></li>
        <li><a href="obat.php" <?php if ($currentPage == 'obat') echo 'class="active"'; ?>>Obat</a></li>
        <li><a href="kategori.php" <?php if ($currentPage == 'kategori') echo 'class="active"'; ?>>Kategori Obat</a></li>
        <li><a href="rak.php" <?php if ($currentPage == 'rak') echo 'class="active"'; ?>>Lokasi Obat</a></li>
        <li><a href="jenis.php" <?php if ($currentPage == 'jenis') echo 'class="active"'; ?>>Jenis Obat</a></li>
        <li><a href="transaksi.php" <?php if ($currentPage == 'transaksi') echo 'class="active"'; ?>>Transaksi</a></li>
        <li><a href="user.php" <?php if ($currentPage == 'user') echo 'class="active"'; ?>>User</a></li>
        <li><a href="karyawan.php" <?php if ($currentPage == 'karyawan') echo 'class="active"'; ?>>Karyawan</a></li>
        
    </ul>
</div>

<?php
include 'config.php';
if (!isset($_SESSION['username'])) {
    // echo "<script>window.location.href = 'index.php';</script>";
}else {
    if ($_SESSION['level'] == 'kasir') {
        ?>
        <style type="text/css">
            .sidebar ul li:nth-child(1),
            .sidebar ul li:nth-child(3),
            .sidebar ul li:nth-child(4),
            .sidebar ul li:nth-child(5),
            .sidebar ul li:nth-child(7),
            .sidebar ul li:nth-child(8),
            .disable_kasir {
                display: none;
            }
            </style>
        <?php
    }

} ?>