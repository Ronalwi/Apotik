<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Obat</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='main.js'></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<?php 

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

include 'sidebar.php'; ?>

  <div class="content">
   
    <div id="box1">
        <table border="1" width="90%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Obat</th>
                    <th>Nama Obat</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Rak</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class='disable_kasir'>Aksi</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM obat INNER JOIN jenis ON obat.id_jenis=jenis.id_jenis INNER JOIN kategori ON obat.kategori_obat=kategori.id_kategori INNER JOIN lokasi ON obat.id_rak=lokasi.id_rak order by id_obat asc";
                        $result = mysqli_query($connect, $query);

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_obat']?></td>
                        <td><?php echo $data['nama_obat']?></td>
                        <td><?php echo $data['nama_jenis']?></td>
                        <td><?php echo $data['harga_obat']?></td>
                        <td><?php echo $data['stock']?></td>
                        <td><?php echo $data['nama_kategori']?></td>
                        <td><?php echo $data['nama_rak']?></td>
                        <td><?php echo $data['status']?></td>
                        <td><?php echo $data['keterangan']?></td>
                        
                        <td class='disable_kasir'>

                        <button onclick="location.href='update_obat.php?id=<?php echo $data['id_obat']; ?>'">Ubah</button>
                        <button onclick="location.href='delete_obat.php?id=<?php echo $data['id_obat']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr class='disable_kasir'>
                   <td colspan='11'><button onclick="location.href='insert_obat.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    