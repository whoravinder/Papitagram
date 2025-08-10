<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
include 'config.php';
include 'header.php';

$res = $conn->query("SELECT * FROM users WHERE id != {$_SESSION['user_id']}");
?>
<div class="form-container">
<h3>Chats</h3>
<ul>
<?php while($u=$res->fetch_assoc()): ?>
<li><a href="chat.php?user=<?= $u['id'] ?>">Chat with <?= $u['username'] ?></a></li>
<?php endwhile; ?>
</ul>
</div>
<?php include 'navbar.php'; ?>
