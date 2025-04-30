<?php
session_start();
include 'db.php'; // Connect to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Travel Destinations</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Page specific styles */
        .page-container {
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header-section {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .header-section h1 {
            color: #333;
            font-size: 2em;
        }
        
        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            min-height: 200px;
        }
        
        .empty-message {
            text-align: center;
            padding: 30px;
            color: #666;
        }
        
        .links-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .links-section h2 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .links-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .link-item {
            color: #2196F3;
            text-decoration: none;
            padding: 8px 0;
            transition: color 0.3s ease;
        }
        
        .link-item:hover {
            color: #0b7dda;
            text-decoration: underline;
        }
        
        .footer-section {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
            text-align: right;
            color: #666;
        }
        
        /* Card styles for destinations */
        .destination-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }
        
        .destination-card {
            background-color: white;
            width: calc(33.33% - 20px);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .destination-card:hover {
            transform: translateY(-5px);
        }
        
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .card-content {
            padding: 15px;
        }
        
        .card-title {
            color: #2196F3;
            font-size: 1.4em;
            margin-bottom: 8px;
        }
        
        .card-country {
            color: #666;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .card-description {
            color: #555;
            line-height: 1.5;
        }
        
        @media (max-width: 768px) {
            .destination-card {
                width: calc(50% - 20px);
            }
        }
        
        @media (max-width: 480px) {
            .destination-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1>All Travel Destinations</h1>
        </div>
        
        <!-- Content Section -->
        <div class="content-section">
            <?php
            $result = $conn->query("SELECT * FROM destinations");
            if ($result->num_rows > 0) {
                echo '<div class="destination-cards">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="destination-card">';
                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" class="card-image">';
                    echo '<div class="card-content">';
                    echo '<h3 class="card-title">' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p class="card-country">' . htmlspecialchars($row['country']) . '</p>';
                    echo '<p class="card-description">' . htmlspecialchars(substr($row['description'], 0, 100)) . '...</p>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<div class="empty-message">No destinations found.</div>';
            }
            ?>
        </div>
        
        <!-- Links Section -->
        <div class="links-section">
            <h2>Quick Links</h2>
            <div class="links-container">
                <a href="add_item.php" class="link-item">Add New Destination</a>
                <a href="dashboard.php" class="link-item">Back to Dashboard</a>
                <a href="logout.php" class="link-item">Logout</a>
            </div>
        </div>
        
        <!-- Footer Section -->
        <div class="footer-section">
            <p>&copy; 2025 Travel Destinations. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>