<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level_user = $_POST['level_user'];
    $id_karyawan = $_POST['id_karyawan'];


    // Validasi apakah ID kategori sudah ada
    $checkQuery = mysqli_query($connect, "SELECT id_user FROM user WHERE id_user = '$id_user'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "ID user sudah ada. Silakan masukkan ID user yang berbeda.";
    } else {
        $query = mysqli_query($connect, "INSERT INTO user (id_user, username, password, level_user, id_karyawan) VALUES ('$id_user', '$username', '$password', '$level_user', '$id_karyawan')");

    if($query){
        header('Location: user.php');
    }
}
}

?>

<html>
    <head>
        <title>Form Tambah User</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Tambah User</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id User</td>
                    <td><input type="text" name="id_user" required></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" required></td>
                </tr>
                <tr>
                    <td>Level User</td>
                    <td><?php
                            $result = mysqli_query($connect, "SHOW COLUMNS FROM user LIKE 'level_user'");
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $enumValues = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type']));
                            }
                            ?>
                            <select name="level_user" id="level_user">
                                <?php foreach ($enumValues as $value) : ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                <tr>
                    <td>Nama Karyawan</td>
                    <td><select name="id_karyawan" id="id_karyawan">
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM karyawan");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_karyawan'] ?>"><?php echo $data['nama_karyawan'] ?></option>
                                <?php } ?>
                        </select></td>
                </tr>
                                       
                    </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                <td><button type="submit" name="submit" value="insert">Tambah</button></td>
</tr>
            </table>
        </form>
        </div>
    </body>
</html>