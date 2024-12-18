<?php
include("functions.php");
session_start();
sessionCheck(); // Ensure the user is logged in
$conn = getConnection();

// Check if there are items in the cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Redirect to listings if the cart is empty
    header("Location: listings.php?error=Cart is empty");
    exit();
}

$cartItems = $_SESSION['cart']; // Get items from the cart session
$totalPrice = 0; //Making total price 0 so can calculate later (line27)
$listingDetails = [];

if (!empty($cartItems)) {
    $placeholders = implode(',', array_fill(0, count($cartItems), '?'));
    $sql = "SELECT * FROM listings WHERE ID IN ($placeholders) AND orderedBy IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->execute($cartItems);
    $listingDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Sum total price
    foreach ($listingDetails as $listing) {
        $totalPrice += $listing['price'];
    }
}

// Handle the checkout process (submitted form)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Reserve listings for the user
    $updateSql = "UPDATE listings SET orderedBy = :user_id WHERE ID = :listing_id AND orderedBy IS NULL";
    $updateStmt = $conn->prepare($updateSql);
    foreach ($cartItems as $listingId) {
        $updateStmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':listing_id' => $listingId
        ]);
    }

    // Clear the cart after successful checkout
    unset($_SESSION['cart']);
    header("Location: profile.php"); // Redirect to profile page, where orders can be found
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .checkout-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
        }
        .checkout-form {
            flex: 2;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 20px;
        }
        .basket {
            flex: 1;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .basket h3 {
            margin-top: 0;
        }
        .basket-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .basket-total {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .checkout-form input, .checkout-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .checkout-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .checkout-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <h2>Checkout Form</h2>
            <form action="checkoutNick.php" method="POST">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>

                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Place Order</button>
            </form>
        </div>

        <!-- Basket -->
        <div class="basket">
            <h3>Your Basket</h3>
            <?php if (!empty($listingDetails)): ?>
                <?php foreach ($listingDetails as $listing): ?>
                    <div class="basket-item">
                        <span><?php echo htmlspecialchars($listing['title']); ?></span>
                        <span>$<?php echo number_format($listing['price'], 2); ?></span>

                        <!--Button to remove from cart, using POST to removeFromCart.php, which calls removeFromCart() func-->
                        <form action="removeFromCart.php" method="POST">
                        <input type="hidden" name="listingId" value="<?php echo $listing['ID']; ?>">
                        <button type="submit">Remove from cart</button>
                        </form>

                    </div>
                <?php endforeach; ?>
                <div class="basket-total">
                    <span>Total</span>
                    <span>$<?php echo number_format($totalPrice, 2); ?></span>
                </div>
            <?php else: ?>
                <p>No items in your basket</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>