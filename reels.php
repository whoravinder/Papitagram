<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
include 'config.php';
?>
<?php include 'header.php'; ?>

<div class="reels">
<?php
$sql="SELECT media_url FROM posts WHERE media_type='video' ORDER BY created_at DESC";
$res=$conn->query($sql);
while($row=$res->fetch_assoc()){
    echo "<video src='{$row['media_url']}' autoplay muted loop></video>";
}
?>
</div>
<script>
document.addEventListener('scroll', () => {
    const videos = document.querySelectorAll('.reels video');
    videos.forEach(video => {
        const rect = video.getBoundingClientRect();
        if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
            video.play();
        } else {
            video.pause();
        }
    });
});
</script>
<?php include 'navbar.php'; ?>
