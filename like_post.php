<?php
session_start();
include 'config.php';

$response = ['liked' => false, 'likes' => 0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    $check = $conn->query("SELECT * FROM likes WHERE user_id=$user_id AND post_id=$post_id");
    if ($check->num_rows > 0) {
        // Unlike
        $conn->query("DELETE FROM likes WHERE user_id=$user_id AND post_id=$post_id");
    } else {
        // Like
        $conn->query("INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
        $response['liked'] = true;
    }

    // Get updated like count
    $countRes = $conn->query("SELECT COUNT(*) as cnt FROM likes WHERE post_id=$post_id");
    $response['likes'] = $countRes->fetch_assoc()['cnt'];
}

header('Content-Type: application/json');
echo json_encode($response);
