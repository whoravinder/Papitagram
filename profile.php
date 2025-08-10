<?php
session_start();
include 'config.php';
$userId = $_SESSION['user_id'];

// Fetch user info
$user = $conn->query("SELECT * FROM users WHERE id = $userId")->fetch_assoc();
$username = htmlspecialchars($user['username']);
$bio = htmlspecialchars($user['bio']);
$avatar = htmlspecialchars($user['avatar']);

// Fetch post count
$postCount = $conn->query("SELECT COUNT(*) AS total FROM posts WHERE user_id = $userId")->fetch_assoc()['total'];
?>

<?php include 'header.php'; ?>

<div class="profile-header">
    <img src="<?= $avatar ?>" class="avatar-large">
    <div class="profile-info">
        <h2><?= $username ?></h2>
        <div class="stats">
            <span><?= $postCount ?> posts</span>
        </div>
        <p><?= $bio ?></p>
        <form method="post" action="update_avatar.php" enctype="multipart/form-data">
            <input type="file" name="avatar" required>
            <button type="submit">Update Avatar</button>
        </form>
    </div>
</div>

<div class="profile-grid">
<?php
$posts = $conn->query("SELECT * FROM posts WHERE user_id = $userId ORDER BY created_at DESC");
while ($row = $posts->fetch_assoc()) {
    if ($row['media_type'] == 'image') {
        echo "<img src='{$row['media_url']}'>";
    } else {
        echo "<video src='{$row['media_url']}' autoplay muted loop></video>";
    }
}
?>
</div>

<?php include 'navbar.php'; ?>
