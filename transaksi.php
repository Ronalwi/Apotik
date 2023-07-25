<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Transaksi Obat</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

    <div id="box1">
        <table border="1" width="90%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM transaksi INNER JOIN user ON transaksi.id_user=user.id_user order by id_transaksi asc";
                        $result = mysqli_query($connect, $query);
                        setLocale(LC_ALL, 'id-ID', 'id_ID');

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
                            $tanggal_transaksi = strftime('%A, %d %B %Y %H : %M', strtotime($data['tanggal_transaksi']));
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_transaksi']?></td>
                        <td><?php echo $data['username']?></td>
                        <td><?php echo $data['nama_pelanggan']?></td>
                        <td><?php echo $tanggal_transaksi ?></td>
                        <td><?php echo $data['total_harga']?></td>

                        <td>

                        <button onclick="location.href='detail_transaksi.php?id=<?php echo $data['id_transaksi']; ?>'">Detail</button>
                        <button class='disable_kasir' onclick="location.href='delete_transaksi.php?id=<?php echo $data['id_transaksi']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr>
                   <td colspan='7'><button onclick="location.href='insert_transaksi.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    