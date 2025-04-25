<?php
session_start();

// Block access if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to login page
    exit();
} 

// Optional: Check that the request came from the login form
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'admin_login.php') === false) {
    header("Location: admin_login.php");
    exit();
}

$file = 'info_posts.json';
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Handle delete request
        $postId = $_POST['delete'];
        $posts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        // Remove the post with the matching ID
        unset($posts[$postId]);

        // Reindex array and save the updated posts back to the JSON file
        $posts = array_values($posts);
        file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT));

        echo "<script>alert('Post deleted successfully!'); window.location.href='admin_page.php';</script>";
        exit();
    }

    // Handle new post creation
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $date = date("Y-m-d H:i:s");
    $imagePath = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;
        $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $targetFile;
            }
        }
    }

    $newPost = [
        'title' => $title,
        'content' => $content,
        'date' => $date,
        'image' => $imagePath
    ];

    $posts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $posts[] = $newPost;
    file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT));

    echo "<script>alert('Post added successfully!'); window.location.href='post.php';</script>";
    exit();
}

$posts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <link rel="icon" href="logo.jpg" type="image/png">
    <link rel="apple-touch-icon" href="path_to_your_image/apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <title>Africa Driving License School - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .post-container {
            max-width: 900px;
            margin: auto;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .post-form {
            background: #fff;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .post-form input, .post-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .post-form button {
            padding: 10px 20px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }
        .post-form input[type="file"] {
            padding: 5px;
        }
        .post {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
        }
        .post h3 {
            margin: 0 0 10px;
            color: #333;
        }
        .post img {
            max-width: 100%;
            margin-top: 10px;
            border-radius: 6px;
        }
        .date {
            color: #888;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .delete-btn {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="post-container">
    <h2>📝 Post New Information | <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">Logout</a></h2>
    <form method="post" class="post-form" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>
        
        <label>Content:</label>
        <textarea name="content" rows="6" required></textarea>

        <label>Image (optional):</label>
        <input type="file" name="image" accept="image/*">
        
        <button type="submit">Post</button>
    </form>

    <h2>📢 Posted Information</h2>

    <?php 
    if (!empty($posts)) {
        $posts = array_reverse($posts);
        foreach ($posts as $index => $post): ?>
            <div class="post" data-aos="fade-up">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p class="date">📅 <?= htmlspecialchars($post['date']) ?></p>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <?php if (!empty($post['image'])): ?>
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image">
                <?php endif; ?>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    <input type="hidden" name="delete" value="<?= $index ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
    <?php endforeach; } else {
        echo "<p>No information posted yet.</p>";
    } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000 });
</script>
</body>
</html>
