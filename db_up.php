<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn){
    die('Could not connect: ' . mysqli_error());
}
$drop = "drop database if exists art_db;";
$create = "create database art_db;";
$create_tables = array("
create table Users (
    login Varchar(30) not null,
    passwordHash Varchar(128) not null,
    type Varchar(12) not null default 'regular',
    primary key(login)
);",
"
create table Comments (
    url Varchar(50) not null,
    user Varchar(30) not null,
    created Timestamp default current_timestamp not null,
    text Varchar(400) not null,
    foreign key(user) references Users(login)
);",
"
create table BlogPosts (
    user Varchar(30) not null,
    created Timestamp default current_timestamp not null,
    title Varchar(100) not null,
    text Text not null,
    foreign key(user) references Users(login)
);
");
$res = mysqli_query($conn, $drop);
var_dump($res);
$res = mysqli_query($conn, $create);
var_dump($res);
mysqli_select_db($conn, 'art_db');
foreach($create_tables as $query) {
    $res = mysqli_query($conn, $query);
    var_dump($res);
}
//var_dump($query);
?>
