<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <h1>Login</h1>

        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>

        <form action="" method="POST">
            Username:
            <input type="text" name="username" placeholder="Enter username">
            Password:
            <input type="password" name="password" placeholder="Enter password">
            <div class="submit-data">
                <input type="submit" name="submit" value="Log In" class="btn-primary">
            </div>
        </form>

        <p></p>
    </div>
</body>
</html>

<?php

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        if($count = mysqli_num_rows($res)){
            $_SESSION['login'] = "<div class='success'>Login succeded!</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error'>Login failed!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>