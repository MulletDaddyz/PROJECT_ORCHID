<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> to buy a vehicle.");
}


$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<img src='images/{$row['image']}' alt='{$row['name']}'>";
    echo "<h2>{$row['name']}</h2>";
    echo "<p>Price: {$row['price']}</p>";
    echo "<p>{$row['description']}</p>";
    echo "<a href='cart.php?add={$row['id']}'>Add to Cart</a>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

</body>
</html>

