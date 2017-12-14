<?php
ob_start();
require('libs_includer.php');
session_load();
?>
<html>
<head>
    <?php readfile("partials/head.html") ?>
    <link rel="stylesheet" type="text/css" href="css/blog.css">
</head>
<body>
    <?php include("partials/menu.php")?>
    <?php
    $blog_posts = get_blog_posts($_SESSION['username']);
    foreach($blog_posts as $key=>$row): ?>
    <tr>
        <td>
            <hr>
            <h2 class="blog-post-title">
                <?php echo $row['title']; ?>
            </h2>
            <div class="blog-post-text"><?php echo break_into_lines($row['text'], 150); ?></div>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php
    if(isset($_POST['submit']) && !empty($_POST['blog-post-text']) && isset($_SESSION['username'])) {
        save_blog_post($_POST['blog-post-title'], $_POST['blog-post-text']);
        redirect($_SERVER['REQUEST_URI']);
    }
    ?>
    <hr>
    <br><br>
    <form action="" method="post" id="blog-post-form">
        <input name="blog-post-title" type="text" placeholder="Title"/>
        <textarea name="blog-post-text" rows="40" cols="150" placeholder="type your blog post here"
            maxlength="10000" wrap="hard" required></textarea>
        <button type="submit" name="submit">Send</button>
    </form>
</body>
</html>
