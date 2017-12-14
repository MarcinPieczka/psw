<?php
ob_start();
require('libs_includer.php');
session_load();
?>
<html>
<head>
    <?php readfile("partials/head.html") ?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php include("partials/menu.php") ?>
    <h2>Login</h2>
    <div class = "container form-signin">
        <?php

        $msg = '';

        if (isset($_POST['submit']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {
            if (authenticate($_POST['username'], $_POST['password'])) {
                $_SESSION['username'] = $_POST['username'];
                redirect('info.php?msg=You_have_logged_in_succesfully');
            } else {
                $msg = 'Wrong username or password';
            }
        }
        ?>
    </div>
    <div class = "container">

        <form class = "form-signin" role = "form"
        action = "" method = "post">
        <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
        <input type = "text" class = "form-control"
        name = "username" placeholder = "username"
        required autofocus></br>
        <input type = "password" class = "form-control"
        name = "password" placeholder = "password" required>
        <button class = "btn btn-lg btn-primary btn-block" type = "submit"
        name = "submit">Login</button>
    </form>
</div>
</body>
</html>
