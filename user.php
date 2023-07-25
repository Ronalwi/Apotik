<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User</title>
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
                    <th>Id User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Nama Karyawan</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody align="center">
                    <?php
			    	    include 'config.php';
                        $no = 1;
                        $query = "SELECT user.*, karyawan.nama_karyawan FROM user INNER JOIN karyawan ON user.id_karyawan = karyawan.id_karyawan ORDER BY user.id_user ASC";
                        $result = mysqli_query($connect, $query);

                        while ($data = mysqli_fetch_array($result))
			    	    
			    	    {
			        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id_user']?></td>
                        <td><?php echo $data['username']?></td>
                        <td><?php echo $data['password']?></td>
                        <td><?php echo $data['level_user']?></td>
                        <td><?php echo $data['id_karyawan']?></td>

                        <td>

                        <button onclick="location.href='update_user.php?id=<?php echo $data['id_user']; ?>'">Ubah</button>
                        <button onclick="location.href='delete_user.php?id=<?php echo $data['id_user']; ?>'">Hapus</button>
                 
                        </td>
                </tr>
                <?php
                $no++;
                        }
                ?>
                <tr>
                   <td colspan='7'><button onclick="location.href='insert_user.php'">Tambah</button></td> 
            </tr>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    