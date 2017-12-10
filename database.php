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
    <?php include("partials/menu.php")?>
    <h2>Comments</h2>
    <table>
        <?php
        $comments = get_all_comments();
        foreach($comments as $key=>$row): ?>
        <tr>
            <td>
                <hr>
                <div class="username-field">
                    User: <?php echo $row['user']?>
                </div>
                <div>
                    Creation date: <?php echo $row['created']?>
                </div>
                <div>
                    Text: <?php echo $row['text']?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Users</h2>
    <table>
        <?php
        $users = get_all_users();
        foreach($users as $key=>$row): ?>
        <tr>
            <td>
                <hr>
                <div class="username-field">
                    Login: <?php echo $row['login']?>
                </div>
                <div>
                    Account type: <?php echo $row['type']?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
