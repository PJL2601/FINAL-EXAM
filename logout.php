<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="logout-box">
    <h2>logged out successfully</h2>
    <a href="login.php" class="btn">Go to Login</a>
</div>

</body>
</html>
