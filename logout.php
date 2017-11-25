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
    <div>Zostałeś wylogowany</div>
    <?php
    session_unset();
    redirect('index.php');
    ?>
</body>
</html>
