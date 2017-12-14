<?php
ob_start();
require('libs_includer.php');
session_load();
?>

<html>
<head>
    <?php readfile("partials/head.html") ?>
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/info.css">
</head>
<body>

    <?php
        include("partials/menu.php");
        if (isset($_GET['msg'])) {
            $msg = str_replace("_", " ", $_GET['msg']);
            echo '<div id="info-msg">' . $msg . '</div>';
        }
    ?>
<script>
setTimeout(function () {
   window.location.href= 'index.php'; // the redirect goes here
},3000)
</script>
</body>
</html>
