<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn){
    die('Could not connect: ' . mysqli_error());
}
$query = "
drop database if exists art_db;
";
$res = mysqli_query($conn, $query);
var_dump($res);
?>
