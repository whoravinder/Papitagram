<?php
session_start();
include 'config.php';
$user_id = $_SESSION['user_id'];
$post_id = intval($_POST['post_id']);

$check = $conn->query("SELECT * FROM likes WHERE user_id=$user_id AND post_id=$post_id");
if ($check->num_rows > 0) {
    $conn->query("DELETE FROM likes WHERE user_id=$user_id AND post_id=$post_id");
    echo "unliked";
} else {
    $conn->query("INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    echo "liked";
}
