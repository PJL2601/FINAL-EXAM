<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $created_at);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 60px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    .profile-info {
      margin-top: 20px;
    }
    .profile-info label {
      font-weight: bold;
      color: #555;
      margin-top: 15px;
      display: block;
    }
    .profile-info span {
      display: block;
      color: #333;
      margin-top: 5px;
    }
    .back-link {
      display: inline-block;
      margin-top: 30px;
      text-decoration: none;
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
    }
    .back-link:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>My Profile</h2>
    <div class="profile-info">
      <label>Username:</label>
      <span><?php echo htmlspecialchars($username); ?></span>

      <label>Email:</label>
      <span><?php echo htmlspecialchars($email); ?></span>

      <label>Member Since:</label>
      <span><?php echo date("F j, Y", strtotime($created_at)); ?></span>
    </div>
    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
  </div>
</body>
</html>
