<?php
include("functions.php");
session_start();
sessionCheck(); // Ensure the user is logged in
$conn = getConnection();

// Fetch the listing ID from the GET request
if (isset($_GET['listing_id'])) {
    $listing_id = $_GET['listing_id'];
    $user_id = $_SESSION["user_id"]; // Get the current user ID from session

    // Reserve the listing by updating the 'orderedBy' column
    $update_sql = "UPDATE listings SET orderedBy = :user_id WHERE ID = :listing_id AND orderedBy IS NULL";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $update_stmt->bindParam(":listing_id", $listing_id, PDO::PARAM_INT);
    $update_stmt->execute();

    // Check if the update was successful (i.e., the listing was not already reserved)
    if ($update_stmt->rowCount() > 0) {
        // Store the listing ID in the session for the cart
        $_SESSION['cart'] = [$listing_id];
    } else {
        // Handle the case where the listing was already reserved (perhaps redirect with an error message)
        header("Location: index.php?error=Listing already reserved");
        exit();
    }

    // Fetch the listing details for display on the checkout page
    $sql = "SELECT * FROM listings WHERE ID = :listing_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":listing_id", $listing_id, PDO::PARAM_INT);
    $stmt->execute();
    $listing = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect to the home page if no listing ID is passed
    header("Location: index.php");
    exit();
}

$totalPrice = 0;
if ($listing) {
    $totalPrice += $listing['price'];
}

// Handle the checkout process (submitted form)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Process the payment or finalize the order here
    // After successful checkout, you can clear the cart
    unset($_SESSION['cart']);
    header("Location: confirmation.php"); // Redirect to confirmation page
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
            <form action="checkout.php" method="POST">
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
            <?php if ($listing): ?>
                <div class="basket-item">
                    <span><?php echo htmlspecialchars($listing['title']); ?></span>
                    <span>$<?php echo number_format($listing['price'], 2); ?></span>
                </div>
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