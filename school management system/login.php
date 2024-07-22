<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name_or_email = $_POST['user_name_or_email'];
    $user_password = $_POST['user_password'];

    $sql = "SELECT * FROM user WHERE user_name = '$user_name_or_email' OR email = '$user_name_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($user_password, $user['user_password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_role'] = $user['user_role'];
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username or email address";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form method="POST" action="login.php">
        <label for="user_name_or_email">Username or Email:</label><br>
        <input type="text" id="user_name_or_email" name="user_name_or_email" required><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
