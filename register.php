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
    <?php if (isset($_SESSION['username'])) : ?>
        <h2>Update Password</h2>
    <?php else : ?>
        <h2>Register</h2>
    <?php endif; ?>
    <div class = "container form-signin">
        <?php

        $msg = '';
        if (empty($_POST['username']) && isset($_SESSION['username'])) {
            $_POST['username'] = $_SESSION['username'];
        }
        if (isset($_POST['submit']) && !empty($_POST['username'])
        && !empty($_POST['password1']) && !empty($_POST['password2'])) {
            if ($_POST['password1'] != $_POST['password2']) {
                $msg = 'repeated password must be identical to password';
            } else {
                $registration_result = register($_POST['username'], $_POST['password1']);
                if ($registration_result) {
                    if (isset($_SESSION['username'])) {
                        redirect('info.php?msg=You_have_changed_password_succesfully');
                    } else {
                        redirect('info.php?msg=You_have_registered_succesfully');
                    }
                } else {
                    $msg = 'this userneme is already used';
                }
            }
        }
        ?>
    </div>
    <div class = "container">

        <form class = "form-signin" role = "form"
        action = "" method = "post">
        <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
        <?php if (isset($_SESSION['username'])) : ?>
            <input type = "text" class = "form-control"
            name = "username" placeholder = <?php echo $_SESSION['username'] ?>
            value = <?php echo $_SESSION['username'] ?> disabled
            required autofocus></br>
        <?php else : ?>
            <input type = "text" class = "form-control"
            name = "username" placeholder = "username"
            required autofocus></br>
        <?php endif; ?>
        <input type = "password" class = "form-control"
        name = "password1" placeholder = "password" required>
        <input type = "password" class = "form-control"
        name = "password2" placeholder = "repeat password" required>
        <button class = "btn btn-lg btn-primary btn-block" type = "submit"
        name = "submit">Register</button>
    </form>
</div>
</body>
</html>
