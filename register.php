<?php
session_start();
include 'config.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT id FROM users WHERE email='$email' OR username='$username'");
    if ($check && $check->num_rows > 0) {
        $error = "Username or Email already exists!";
    } else {
        $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            $_SESSION['user_id'] = $conn->insert_id;
            header('Location: index.php');
            exit();
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Papitagram</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="auth-container">
    <h2>Create an Account</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <form method="post" class="auth-form">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
