<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
include 'config.php';
$receiver_id = intval($_GET['user']);
include 'header.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $msg = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO messages(sender_id, receiver_id, message) VALUES({$_SESSION['user_id']}, $receiver_id, '$msg')");
}

$res = $conn->query("SELECT * FROM messages WHERE (sender_id={$_SESSION['user_id']} AND receiver_id=$receiver_id) OR (sender_id=$receiver_id AND receiver_id={$_SESSION['user_id']}) ORDER BY created_at");
?>
<div class="chat-box">
<?php while($row=$res->fetch_assoc()): ?>
    <div class="<?= $row['sender_id']==$_SESSION['user_id']?'my-msg':'other-msg' ?>">
        <?= htmlspecialchars($row['message']) ?>
    </div>
<?php endwhile; ?>
<form method="post" class="chat-input">
    <input type="text" name="message" placeholder="Type a message..." required>
    <button type="submit">Send</button>
</form>
</div>
<?php include 'navbar.php'; ?>
