<?php
ob_start();
require('libs_includer.php');
session_load();
?>
/*
TODO:
    - display message about what is your personal blog if there are no blog posts yet
    - allow to write a new post
    - basically all features of normal view of blog
*/
<html>
<head>
    <?php readfile("partials/head.html") ?>
</head>
<body>
    <?php include("partials/menu.php")?>
    <?php
    $blog_posts = get_blog_posts($_SESSION['username']);
    foreach($blog_posts as $key=>$row): ?>
    <tr>
        <td>
            <hr>
            <div class="comment-header">
                <?php echo $row['user'] . ' at ' . $row['created']; ?>
                <?php echo $row['title']; ?>
            </div>
            <div class="comment-text"><?php echo break_into_lines($row['text'], 70); ?></div>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php
    if(isset($_POST['submit']) && !empty($_POST['blog-post-text']) && isset($_SESSION['username'])) {
        save_blog_post($_POST['blog-post-title'], $_POST['blog-post-text']);
        redirect($_SERVER['REQUEST_URI']);
    }
    ?>
    <form action="" method="post" id="blog-post-form">
        <input name="blog-post-title" type="text" placeholder="Title"/>
        <textarea name="blog-post-text" rows="6" cols="70" placeholder="type your blog post here"
            maxlength="400" wrap="hard" required></textarea>
        <button type="submit" name="submit">Send</button>
    </form>
</body>
</html>
