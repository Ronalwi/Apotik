<?php
session_start();
include 'config.php';

mysqli_close($connect);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>LOGIN</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="text" name="password" required><br>

        <input type="submit" name="submit">
    </form>
  
    <?php
    include 'config.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM user where username = '$_POST[username]' and password = '$_POST[password]'";
        $result = mysqli_query($connect, $query);
        $cek = mysqli_num_rows($result);
        if ($cek > 0) {
            $data = mysqli_fetch_assoc($result);
            if ($data['level_user'] == "admin"){
                header("location:dashboard.php");
            } else if ($data['level_user'] == "kasir"){
                header("location:obat.php");
            }
            
            echo "Login Berhasil";
            
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $data['level_user'];

        } else {
            echo "Login Gagal";
        }
    }

    ?>
</body>
</html>