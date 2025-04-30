<?php
include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    
    $name = $_POST['name'];
    $country = $_POST['country'];
    $description = $_POST['description'];
    
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    
    $query = "INSERT INTO destinations (name, country, description, image) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssss", $name, $country, $description, $image);

        if ($stmt->execute()) {
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
    
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Destination - Travel Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            color: #2196F3;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8em;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }
        
        textarea.form-control {
            height: 150px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        
        .submit-btn:hover {
            background-color: #0b7dda;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2196F3;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-section">
            <h1>Add Destination</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="middle-section">
            <h2>Quick Links</h2>
            <div class="quick-links-container">
                <a href="dashboard.php" class="quick-link-btn">Dashboard</a>
                <a href="view_destinations.php" class="quick-link-btn">View All Destinations</a>
                <a href="profile.php" class="quick-link-btn">My Profile</a>
            </div>
        </div>
        
        <div class="right-section">
            <p class="copyright">&copy; 2025 Travel Dashboard</p>
        </div>
    </div>
    
    <div class="form-container">
        <h2 class="form-title">Add New Destination</h2>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            
            <button type="submit" class="submit-btn">Add Destination</button>
        </form>
        
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
