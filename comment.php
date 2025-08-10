<?php
session_start();
include 'config.php';
$user_id = $_SESSION['user_id'];
$post_id = intval($_POST['post_id']);
$text = $conn->real_escape_string($_POST['comment_text']);

$conn->query("INSERT INTO comments(user_id, post_id, comment_text) VALUES($user_id, $post_id, '$text')");

$res = $conn->query("SELECT comments.comment_text, users.username FROM comments JOIN users ON comments.user_id=users.id WHERE post_id=$post_id ORDER BY comments.created_at DESC");
while($row=$res->fetch_assoc()){
    echo "<p><b>{$row['username']}:</b> {$row['comment_text']}</p>";
}
