<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $conn->real_escape_string($_POST['caption']);
    $fileName = time() . "_" . basename($_FILES['media']['name']);
    $targetFile = "uploads/" . $fileName;
    $mediaType = strpos($_FILES['media']['type'], 'video') !== false ? 'video' : 'image';
    
    if (move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
        $conn->query("INSERT INTO posts(user_id, media_url, media_type, caption) VALUES({$_SESSION['user_id']}, '$targetFile', '$mediaType', '$caption')");
        header('Location: index.php');
        exit();
    } else {
        $error = "Upload failed. Please try again.";
    }
}
include 'header.php';
?>
<div class="upload-container">
    <h2>Upload Post</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post" enctype="multipart/form-data" class="upload-form">
        <input type="file" name="media" accept="image/*,video/*" onchange="previewMedia(event)" required>
        <div class="preview-container">
            <img id="preview-img" class="preview" style="display:none;">
            <video id="preview-video" class="preview" style="display:none;" controls></video>
        </div>
        <input type="text" name="caption" placeholder="Write a caption..." maxlength="2200" required>
        <button type="submit">Post</button>
    </form>
</div>
<script>
function previewMedia(event){
    const file = event.target.files[0];
    if(file.type.startsWith('image')){
        document.getElementById('preview-img').src = URL.createObjectURL(file);
        document.getElementById('preview-img').style.display = 'block';
        document.getElementById('preview-video').style.display = 'none';
    } else {
        document.getElementById('preview-video').src = URL.createObjectURL(file);
        document.getElementById('preview-video').style.display = 'block';
        document.getElementById('preview-img').style.display = 'none';
    }
}
</script>
<?php include 'navbar.php'; ?>
