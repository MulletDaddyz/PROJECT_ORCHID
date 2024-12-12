<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> to access the cart.");
}

$user_id = $_SESSION['user_id'];

// Add vehicle to cart
if (isset($_GET['add'])) {
    $vehicle_id = $_GET['add'];
    $check = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND vehicle_id = $vehicle_id");

    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO cart (user_id, vehicle_id) VALUES ($user_id, $vehicle_id)");
    }
    header("Location: cart.php");
    exit;
}

// Remove vehicle from cart
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE id = $cart_id");
    header("Location: cart.php");
    exit;
}

// Display cart items
$sql = "SELECT c.id as cart_id, v.name, v.type, v.price, v.image 
        FROM cart c 
        JOIN vehicles v ON c.vehicle_id = v.id 
        WHERE c.user_id = $user_id";
$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <a href="home.php" class="logo">
            <img src="logo.png" alt="Logo"> Recondition House
        </a>
        <nav>
            <a href="buy.php">Buy</a>
            <a href="sell.php">Sell</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h1>Your Cart</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo ucfirst($row['type']); ?></td>
                        <td>Npr<?php echo $row['price']; ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $row['cart_id']; ?>">Remove</a>
                        </td>
                    </tr>
                    <?php $total += $row['price']; ?>
                <?php endwhile; ?>
            </table>
            <h3>Total: Rs<?php echo $total; ?></h3>
            <button onclick="location.href='payment.php'">Proceed to Payment</button>
        <?php else: ?>
            <p>Your cart is empty. <a href="buy.php">Start shopping</a></p>
        <?php endif; ?>
    </div>
    <link rel="stylesheet" href="css/style.css">

</body>
</html>
