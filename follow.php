<?php
session_start();
include 'config.php';
$follower = $_SESSION['user_id'];
$following = intval($_POST['following_id']);

$check = $conn->query("SELECT * FROM follows WHERE follower_id=$follower AND following_id=$following");
if ($check->num_rows > 0) {
    $conn->query("DELETE FROM follows WHERE follower_id=$follower AND following_id=$following");
    echo "unfollowed";
} else {
    $conn->query("INSERT INTO follows(follower_id, following_id) VALUES($follower, $following)");
    echo "followed";
}
