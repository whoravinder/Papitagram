<?php
include 'config.php';
$post_id = intval($_GET['post_id']);
$res = $conn->query("SELECT comments.comment_text, users.username FROM comments JOIN users ON comments.user_id=users.id WHERE post_id=$post_id ORDER BY comments.created_at DESC");
while($row=$res->fetch_assoc()){
    echo "<p><b>{$row['username']}:</b> {$row['comment_text']}</p>";
}
