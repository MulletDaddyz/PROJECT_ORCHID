<?php
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> to sell a vehicle.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $type = $conn->real_escape_string($_POST['type']);
    $price = (float) $_POST['price'];
    $description = $conn->real_escape_string($_POST['description']);
    $image = $_FILES['image'];

    // Handle image upload
    $target_dir = "images/";
    $image_name = basename($image['name']);
    $target_file = $target_dir . $image_name;

    // Validate and move the uploaded file
    if ($image['error'] === UPLOAD_ERR_OK) {
        // Ensure directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO vehicles (name, type, price, description, image) 
                    VALUES ('$name', '$type', $price, '$description', '$image_name')";
            if ($conn->query($sql)) {
                echo "<p>Vehicle added successfully! <a href='buy.php'>View Listings</a></p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error moving uploaded file. Please check permissions for the 'images' folder.</p>";
        }
    } else {
        echo "<p>Error uploading image. Error code: " . $image['error'] . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Vehicle</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
    <header>
        
        <a href="home.php" class="logo">
            <img src="logo.png" alt="Recondition House Logo" style="height: 80px; width: 80px;"> Recondition House
        </a>
        <nav>
            <a href="buy.php">Buy</a>
            <a href="sell.php">Sell</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h1>Sell Your Vehicle</h1>
        <form action="sell.php" method="POST" enctype="multipart/form-data">
            <label for="name">Vehicle Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="type">Vehicle Type:</label>
            <select id="type" name="type" required>
                <option value="car">Car</option>
                <option value="bike">Bike</option>
                <option value="scooter">Scooter</option>
            </select>

            <label for="price">Price (in Npr):</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Add Vehicle</button>
        </form>
    </div>
</body>
</html>
