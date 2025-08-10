<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $userId = $_SESSION['user_id'];
    $file = $_FILES['avatar'];
    $targetDir = "uploads/";
    $fileName = time() . "_" . basename($file['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $conn->query("UPDATE users SET avatar = '$targetFile' WHERE id = $userId");
    }
}

header("Location: profile.php");
exit();
