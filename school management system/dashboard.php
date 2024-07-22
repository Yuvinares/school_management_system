<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];

echo "<h1>Welcome, $user_name</h1>";
echo "<h2>Role: $user_role</h2>";

if ($user_role == 'admin') {
    echo "<p>Admin content here...</p>";
} elseif ($user_role == 'teacher') {
    echo "<p><b>No activities for you today dear tutor</b></p>";
} elseif ($user_role == 'student') {
    echo "<p><b>No activities for you today dear student</b></p>";
}

echo '<a href="logout.php">Logout</a>';
?>
