<?php
header("Content-type: text/css; charset: UTF-8");
$color = '#AC6732;';
if (isset($_COOKIE['color'])) {
    $color = $_COOKIE['color'] . ';';
}
?>

body {
    background-color:<?php print $color; ?>
}
