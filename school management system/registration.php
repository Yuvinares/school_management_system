<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_role = $_POST['user_role'];

    if ($user_password != $confirm_password) {
        echo "Passwords do not match.";
    } else {
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (user_name, email, user_password, user_role) VALUES ('$user_name', '$email', '$hashed_password', '$user_role')";

        if ($conn->query($sql) === TRUE) {
            header('Location: login.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <script>
        function validateForm() {
            var password = document.getElementById("user_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h2>User Registration</h2>
    <form method="POST" action="registration.php" onsubmit="return validateForm();">
        <label for="user_name">Username:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <label for="user_role">Role:</label><br>
        <select id="user_role" name="user_role" required>
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>