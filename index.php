<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
include 'config.php';
include 'header.php';
?>

<main class="feed">
<?php
$sql = "SELECT posts.*, users.username FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postId = $row['id'];

        // Check if current user liked this post
        $liked = $conn->query("SELECT id FROM likes WHERE user_id={$_SESSION['user_id']} AND post_id=$postId")->num_rows > 0;
        
        echo "<div class='post-card'>";
        
        // Post Header
        echo "<div class='post-header'>
                <img src='uploads/default.png' class='avatar'>
                <span class='username'>{$row['username']}</span>";
        
        // Delete option
        if ($row['user_id'] == $_SESSION['user_id']) {
            echo "<form method='post' action='delete_post.php' class='delete-form'>
                    <input type='hidden' name='post_id' value='{$row['id']}'>
                    <button type='submit' class='delete-btn'>Delete</button>
                  </form>";
        }
        echo "</div>";
        
        // Media
        if ($row['media_type'] == 'image') {
            echo "<img src='{$row['media_url']}' class='post-img'>";
        } else {
            echo "<video controls class='post-img'><source src='{$row['media_url']}'></video>";
        }

        // Likes count
        $likesQuery = $conn->query("SELECT COUNT(*) as like_count FROM likes WHERE post_id={$row['id']}");
        $likesCount = $likesQuery->fetch_assoc()['like_count'];

        // Like & Comment Buttons
        echo "<div class='post-actions'>
                <form class='like-form' data-postid='{$row['id']}'>
                    <input type='hidden' name='post_id' value='{$row['id']}'>
                    <button type='submit' class='like-btn ".($liked ? 'liked' : '')."'>❤️</button>
                </form>
                <button class='comment-toggle' data-id='{$row['id']}'>💬</button>
                <span class='like-count' id='like-count-{$row['id']}'>{$likesCount} likes</span>
              </div>";

        // Caption
        echo "<p class='caption'><b>{$row['username']}</b> {$row['caption']}</p>";

        // Preview 2 comments
        $commentsQuery = $conn->query("SELECT comments.*, users.username FROM comments 
                                       JOIN users ON comments.user_id = users.id 
                                       WHERE comments.post_id={$row['id']} 
                                       ORDER BY comments.created_at DESC LIMIT 2");
        echo "<div class='comments-preview'>";
        if ($commentsQuery->num_rows > 0) {
            while ($comment = $commentsQuery->fetch_assoc()) {
                echo "<p><b>{$comment['username']}</b> {$comment['comment_text']}</p>";
            }
        }
        $totalComments = $conn->query("SELECT COUNT(*) as cnt FROM comments WHERE post_id={$row['id']}")->fetch_assoc()['cnt'];
        if ($totalComments > 2) {
            echo "<p class='view-comments' data-id='{$row['id']}'>View all {$totalComments} comments</p>";
        }
        echo "</div>";

        // Full comment form hidden initially
        echo "<div class='comments-section' id='comments-{$row['id']}' style='display:none;'>
                <form method='post' action='add_comment.php'>
                    <input type='hidden' name='post_id' value='{$row['id']}'>
                    <input type='text' name='comment_text' placeholder='Add a comment...' required>
                    <button type='submit'>Post</button>
                </form>
              </div>";

        echo "</div>"; // post-card
    }
} else {
    echo "<p>No posts yet. Upload something!</p>";
}
?>
</main>

<script>
// Toggle comment section
document.querySelectorAll('.comment-toggle, .view-comments').forEach(button => {
    button.addEventListener('click', () => {
        const postId = button.getAttribute('data-id');
        const section = document.getElementById('comments-' + postId);
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    });
});

// AJAX Like
document.querySelectorAll('.like-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const postId = this.dataset.postid;
        fetch('like_post.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('like-count-' + postId).innerText = data.likes + " likes";
            this.querySelector('.like-btn').classList.toggle('liked', data.liked);
        });
    });
});
</script>

<?php include 'navbar.php'; ?>
