<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Rak Obat</title>
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
                    <th>Id Rak</th>
                    <th>Nama Rak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM lokasi order by id_rak asc";
                        $result = mysqli_query($connect, $query);

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_rak']?></td>
                        <td><?php echo $data['nama_rak']?></td>

                        <td>

                        <button onclick="location.href='update_rak.php?id=<?php echo $data['id_rak']; ?>'">Ubah</button>
                        <button onclick="location.href='delete_rak.php?id=<?php echo $data['id_rak']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr>
                   <td colspan='4'><button onclick="location.href='insert_rak.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    