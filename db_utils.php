<?php
function db_connect() {
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if(!$conn){
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_select_db($conn, 'art_db');
    if(!$conn){
        echo "nima1";
    }
    return $conn;
}
$conn = db_connect();

function create_admin() {
    global $conn;
    $passwd = password_hash('admin', PASSWORD_DEFAULT);
    $query = 'insert into Users values(\'admin\',\'' . $passwd . '\', \'admin\');';
    echo $query;
    $res = mysqli_query($conn, $query);
    var_dump($res);
}

function authenticate($username, $password) {
    global $conn;
    $query = 'select passwordHash from Users where login = \'' . $username . '\'';
    $user = mysqli_query($conn, $query);

     if (mysqli_num_rows($user) > 0) {
        $row = mysqli_fetch_assoc($user);
        return password_verify($password, $row['passwordHash']);
     } else {
        return FALSE;
     }
}
function register($username, $password) {
    global $conn;
    $passwd = password_hash($password, PASSWORD_DEFAULT);
    $query = 'insert into Users values(\'' . $username . '\',\'' . $passwd . '\', \'regular\');';
    return mysqli_query($conn, $query);
}
//var_dump(authenticate('admin', 'admin'));
//var_dump(authenticate('admin', 'dupa'));
//var_dump(authenticate('dupa', 'admin'));
//mysqli_close($conn);
?>
