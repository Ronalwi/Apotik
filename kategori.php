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

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

    <div id="box1">
        <table border="1" width="90%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM kategori order by id_kategori asc";
                        $result = mysqli_query($connect, $query);

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_kategori']?></td>
                        <td><?php echo $data['nama_kategori']?></td>

                        <td>

                        <button onclick="location.href='update_kategori.php?id=<?php echo $data['id_kategori']; ?>'">Ubah</button>
                        <button onclick="location.href='delete_kategori.php?id=<?php echo $data['id_kategori']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr>
                   <td colspan='4'><button onclick="location.href='insert_kategori.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    