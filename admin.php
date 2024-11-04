<?php
include 'includes/connection.php';
include 'includes/functions.php';
include 'components/avatar.php';

session_start();

$user = $_SESSION['user'];
if (!isset($user) || $user['role'] == 'user') {
    header('Location: login.php');
}


$allUsers = getUsers($conn);
$allPosts = getPosts($conn);
$allComments = getComments($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.svg" type="image/x-icon">

    <title>Home | Issue Sedunia</title>
</head>

<body>
    <?php
    include 'components/dialog.php';
    echo dialog();
    ?>
    <h2 class="heading text-center mb-6">Admin Dashboard</h2>
    <nav class="navbar cream shadow border rounded-full">
        <a href="/issue-sedunia" class="logo w-12 h-12 flex items-center justify-center rounded-full">
            <img src="assets/icons/logo.svg" alt="logo">
        </a>

        <div class="navbar-options">
            <a href="/issue-sedunia" class="home-icon w-12 h-12 flex items-center justify-center rounded-full">
                <img src="assets/icons/home.svg" alt="home">
            </a>
            <button type="button" class="btn-fullscreen w-12 h-12 flex items-center justify-center rounded-full" onclick="toggleFullScreen()">
                <img src="assets/icons/fullscreen.svg" alt="fullscreen">
            </button>
            <button type="button" class="music-toggler w-12 h-12 flex items-center justify-center rounded-full">
                <img src="assets/icons/music.svg" alt="music">
            </button>
            <button type="button" class="btn-users profile-icon w-12 h-12 flex items-center justify-center rounded-full">
                <img src="assets/icons/profile.svg" alt="profile">
            </button>
            <button type="button" class="btn-posts profile-icon w-12 h-12 flex items-center justify-center rounded-full">
                <img src="assets/icons/posts.svg" alt="posts">
            </button>
            <button type="button" class="btn-comments profile-icon w-12 h-12 flex items-center justify-center rounded-full">
                <img src="assets/icons/comment.svg" alt="comments">
            </button>
        </div>
        <div>
            <a href="logout.php" class="setting-icon setting w-12 h-12 flex items-center justify-center rounded-full" onclick="return confirmPrompt('Logout','Are you sure you want to logout?', 'logout.php')">
                <img src="assets/icons/logout.svg" alt="logout">
            </a>
        </div>
    </nav>
    <div class="music-container hidden p-c cream border shadow rounded-lg">
        <h2 class="font-bold mb-6">Soundboard</h2>
    </div>

    <section class="content-users py-2 border shadow rounded-lg">
        <h2 class="heading text-center mb-6">Users</h2>
        <?php foreach ($allUsers as $user): ?>
            <div class="px-4 py-4 flex items-center justify-between border-b">
                <div class="flex items-center gap-3">
                    <?php
                    echo renderAvatar($user['username'], $user['photo'], 'avatar', 'Photo Profile', 'post-avatar-desktop');
                    ?>
                    <a href="profile.php?id=<?= $user['id'] ?>" class="heading capitalize"><?= $user['username']; ?></a>
                </div>
                <a href="adminDeleteUser.php<?= $user['id'] ?>" class="px-4 py-2 red flex items-center justify-center rounded shadow border" onclick="return confirmPrompt('Delete User','Are you sure want to delete this user?', 'adminDeleteUser.php?id=<?= $user['id'] ?>')">
                    Delete
                </a>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="content-posts py-2 border shadow rounded-lg hidden">
        <h2 class="heading text-center mb-6">Users</h2>
        <?php foreach ($allPosts as $post): ?>
            <div class="px-4 py-4 flex items-center justify-between border-b">
                <div class="flex items-center gap-3">
                    <a href="post.php?id=<?= $post['id'] ?>" class="heading capitalize"><?= $post['title']; ?></a>
                </div>
                <a href="adminDeletePost.php<?= $post['id'] ?>" class="px-4 py-2 red flex items-center justify-center rounded shadow border" onclick="return confirmPrompt('Delete Post','Are you sure want to delete this post?', 'adminDeletePost.php?id=<?= $post['id'] ?>')">
                    Delete
                </a>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="content-comments py-2 border shadow rounded-lg hidden">
        <h2 class="heading text-center mb-6">Comments</h2>
        <?php foreach ($allComments as $comment): ?>
            <div class="px-4 py-4 flex items-center justify-between border-b">
                <div class="flex items-center gap-3">
                    <div class="heading capitalize"><?= $comment['content']; ?></div>
                </div>
                <a href="adminDeleteComment.php<?= $comment['id'] ?>" class="px-4 py-2 red flex items-center justify-center rounded shadow border" onclick="return confirmPrompt('Delete Comment','Are you sure want to delete this comment?', 'adminDeleteComment.php?id=<?= $comment['id'] ?>')">
                    Delete
                </a>
            </div>
        <?php endforeach; ?>
    </section>
    <script src="js/script.js"></script>
    <script src="js/music.js"></script>
    <script src="js/dialog.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/admin.js"></script>
</body>

</html>