<?php
ob_start();
require('libs_includer.php');
session_load();
?>
<div class="navbar">
    <a class="navbar-a" href="index.php">Home</a>
    <div class="dropdown">
        <button class="dropbtn">Works
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a class="navbar-a" href="work-1.php">Work 1</a>
            <a class="navbar-a" href="work-2.php">Work 2</a>
        </div>

    </div>
    <div class="dropdown">
        <button class="dropbtn">Blogs
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a class="navbar-a" href="blogs.php">Find a Blog</a>
            <?php
            if (isset($_SESSION['username'])) {
            echo '<a class="navbar-a" href="my-blog.php">My Blog</a>';
            }
            ?>
        </div>
    </div>
    <?php
    if (! isset($_SESSION['username'])) {
        echo '<a class="navbar-a-right" href="register.php">Register</a>';
        echo '<a class="navbar-a-right" href="login.php">Login</a>';
    } else {
        echo '<a class="navbar-a-right" href="account.php">Logged in as <strong>' . $_SESSION['username'] . '</strong></a>';
        echo '<a class="navbar-a-right" href="logout.php">Logout</a>';
        echo '<a class="navbar-a-right" href="register.php">Change Password</a>';
    }

    ?>
</div>
