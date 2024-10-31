<?php
require 'includes/connection.php';
require 'includes/functions.php';

session_start();

$user = $_SESSION['user'];
$postId = $_GET['id'];
$result = getSinglePost($conn, $postId);

if ($user['id'] != $result['post']['user_id']) {
    header('Location: index.php');
} else {
    deletePost($conn, $postId);
    header('Location: index.php');
}
?>