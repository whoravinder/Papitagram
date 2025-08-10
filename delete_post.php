<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    // Verify if post belongs to the user
    $check = $conn->query("SELECT * FROM posts WHERE id=$post_id AND user_id=$user_id");
    if ($check && $check->num_rows > 0) {
        $conn->query("DELETE FROM posts WHERE id=$post_id");
    }
}
header('Location: index.php');
exit();
