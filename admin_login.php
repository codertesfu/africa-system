<?php
session_start();

// If already logged in, redirect
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: post.php');
    exit();
}

// Hardcoded credentials
$validUsername = "africadrive123";
$validPassword = "123456";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));

    // Check credentials
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $username;
        header('Location: admin_page.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Africa Driving License School</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <style>
        body {
            background: #e9f0f7;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }
        .login-box input[type="text"], .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .login-box button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
