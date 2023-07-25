<?php
include 'config.php';

// $id = $_GET['id'];
//         $query = mysqli_query($connect, "SELECT * FROM user WHERE id_user = '$id'");
//         $data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level_user = $_POST['level_user'];
    $id_karyawan = $_POST['id_karyawan'];

    $queryUpdate = mysqli_query($connect, "UPDATE user SET id_user='$id_user', username='$username' , password='$password', level_user='$level_user', id_karyawan='$id_karyawan' WHERE id_user='$id_user'"); 

    if($queryUpdate){
        header('Location: user.php');
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT user.*, karyawan.nama_karyawan FROM user INNER JOIN karyawan ON user.id_karyawan = karyawan.id_karyawan WHERE id_user = '$id' ORDER BY user.id_user ASC";
    if ($data = mysqli_fetch_array(mysqli_query($connect, $query))) {
        $id_user = $data['id_user'];
        $username = $data['username'];
        $password = $data['password'];
        $level_user = $data['level_user'];
        $id_karyawan = $data['id_karyawan'];
        
    }
}

?>

<html>
    <head>
        <title>Form Ubah User</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Ubah User</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id User</td>
                    <td><input type="text" name="id_user" id="id_user" value="<?php echo $data['id_user'] ?>" disabled></td>
                    <td><input type="text" name="id_user" id="id_user" value="<?php echo $data['id_user'] ?>" hidden></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username" value="<?php echo $data['username'] ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" id="password" value="<?php echo $data['password'] ?>"></td>
                </tr>
                <tr>
                    <td>Level</td>
                    <td><?php
                            $result = mysqli_query($connect, "SHOW COLUMNS FROM user LIKE 'level_user'");
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $enumValues = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type']));
                            }
                            ?>
                            <select name="level_user" id="level_user">
                                <?php foreach ($enumValues as $value) : ?>
                                    <option value="<?php echo $value ?>" <?php if ($level_user== $value) { echo 'selected'; }?> ><?php echo $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                </tr>
                <tr>
                    <td>Nama Karyawan</td>
                    <td><select name="id_karyawan" id="id_karyawan">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM karyawan");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_karyawan'] ?>" <?php if ($id_karyawan== $data['nama_karyawan']) {echo 'selected';}?>><?php echo $data['nama_karyawan'] ?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                        
                <tr>
                <td></td>
                <td><button type="submit" name="submit" value="update">Ubah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>