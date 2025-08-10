<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    $comment_text = $conn->real_escape_string($_POST['comment_text']);
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO comments(user_id, post_id, comment_text) VALUES($user_id, $post_id, '$comment_text')");
}
header('Location: index.php');
exit();
