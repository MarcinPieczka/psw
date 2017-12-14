<?php
ob_start();
require('libs_includer.php');
session_load();
?>
<html>
<head>
    <?php readfile("partials/head.html") ?>
</head>
<body>

    <?php include("partials/menu.php") ?>
    <?php
    session_unset();
    redirect('info.php?msg=You_have_logged_out_successfully');
    ?>
</body>
</html>
