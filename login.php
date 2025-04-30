<?php
session_start(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    
    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        header('Location: dashboard.php');
        exit; 
    } else {
        echo 'Invalid login';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
