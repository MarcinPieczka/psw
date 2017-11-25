<?php
ob_start();
require('libs_includer.php');
session_load();
?>
<html>
<head>
    <?php readfile("partials/head.html") ?>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    <?php include("partials/menu.php")?>
    <div class="settings_container">
        <h2>Edit background collor</h2>
        <form class = "form-signin" role = "form"
        action = "" method = "post">
        <input id="color-input" type = "color" name="color" value="#AC6732">
        <button id="save-btn" type = "submit"
        name = "submit">Save</button>
    </div>
</form>

    <?php
    if (isset($_POST['submit']) && !empty($_POST['color'])) {
        setcookie('color', $_POST['color']);
    }
    ?>

</div>
</body>
</html>
