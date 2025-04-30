<?php 
session_start(); 
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit; 
}
include 'db.php';
$result = $conn->query("SELECT * FROM destinations");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    .header {
      background-color: #3498db;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .main-content {
      padding: 20px;
    }
    .quick-links-container {
      margin-bottom: 30px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    .quick-links-button {
      background-color: #2ecc71;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .quick-links-button:hover {
      background-color: #27ae60;
    }
    .destinations-list {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
    }
    .destination-item {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    .destination-item:last-child {
      border-bottom: none;
    }
    .message {
      color: #888;
    }
    .footer {
      background-color: #333;
      color: white;
      padding: 15px;
      text-align: center;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
    .logout-btn {
      background-color: #e74c3c;
      color: white;
      border: none;
      padding: 8px 16px;
      margin-left: 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    .logout-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <h1>Welcome to Your Dashboard</h1>
  </header>

  <!-- Main content -->
  <main class="main-content">
    <div class="quick-links-container">
      <a href="add_item.php" class="quick-links-button">Add New Items</a>
      <a href="view_destinations.php" class="quick-links-button">View All Destinations</a>
      <a href="profile.php" class="quick-links-button">My Profile</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
      <div class="destinations-list">
        <h2>My Destinations</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="destination-item">
            <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
            <?php echo htmlspecialchars($row['description']); ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="message">No destinations found. Add your first destination!</p>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div>© 2025 Travel Dashboard</div>
    <form action="logout.php" method="post" style="display:inline;">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </footer>
</body>
</html>
