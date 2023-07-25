<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Jenis Obat</title>
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
                    <th>Id Jenis</th>
                    <th>Nama Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM jenis order by id_jenis asc";
                        $result = mysqli_query($connect, $query);

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_jenis']?></td>
                        <td><?php echo $data['nama_jenis']?></td>

                        <td>

                        <button onclick="location.href='update_jenis.php?id=<?php echo $data['id_jenis']; ?>'">Ubah</button>
                        <button onclick="location.href='delete_jenis.php?id=<?php echo $data['id_jenis']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr>
                   <td colspan='4'><button onclick="location.href='insert_jenis.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    