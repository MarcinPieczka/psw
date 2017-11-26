<hr>
<table>
    <?php
    $comments = get_comments();
    foreach($comments as $key=>$row): ?>
    <tr>
        <td>
            <hr>
            <div class="comment-header">
                <?php echo $row['user'] . ' at ' . $row['created']; ?>
            </div>
            <div class="comment-text"><?php echo break_into_lines($row['text'], 70); ?></div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
if(isset($_POST['submit']) && !empty($_POST['comment']) && isset($_SESSION['username'])) {
    save_comment($_POST['comment']);
    redirect($_SERVER['REQUEST_URI']);
}
?>
<?php if(isset($_SESSION['username'])) : ?>
<form action="" method="post" id="comment-form">
    <textarea name="comment" rows="6" cols="70" placeholder="type your comment here"
        maxlength="400" wrap="hard" required></textarea>
    <button type="submit" name="submit">Send</button>
</form>
<?php else : ?>
<hr>
<div><strong>
    to comment, you must be logged in
</strong></div>
<?php endif; ?>
