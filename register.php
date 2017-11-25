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
    <h2>Register</h2>
    <div class = "container form-signin">
        <?php

        $msg = '';

        if (isset($_POST['submit']) && !empty($_POST['username'])
        && !empty($_POST['password1']) && !empty($_POST['password2'])) {
            if ($_POST['password1'] != $_POST['password2']) {
                $msg = 'repeated password must be identical to password';
            } else {
                $registration_result = register($_POST['username'], $_POST['password1']);
                if ($registration_result) {
                    redirect('info.php?msg=You_have_registered_succesfully');
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
        <input type = "text" class = "form-control"
        name = "username" placeholder = "username"
        required autofocus></br>
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
