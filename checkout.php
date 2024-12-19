<?php
//start the session and check connection to server
include("functions.php");
session_start();
sessionCheck(); 
$conn = getConnection();

// Check if the user clicked a button to either cancel or place their order
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["cancel_order"])) {
        if (isset($_SESSION['cart'])) {
            $listing_id = $_SESSION['cart'][0];  

            // if the order is cancelled Update the 'orderedBy' column to NULL
            $update_sql = "UPDATE listings SET orderedBy = NULL WHERE ID = :listing_id";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bindParam(":listing_id", $listing_id, PDO::PARAM_INT);
            $update_stmt->execute();

            // Clear the cart 
            unset($_SESSION['cart']);
        }
		//take user back to listings page
        header("Location: listings.php"); 
    } elseif (isset($_POST["place_order"])) {
    // if user confirms order get all personal details
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

   //clear the cart after 'payment'
    unset($_SESSION['cart']);
       header("Location: profile.php"); 
    exit();
    }
}
//check if someone is trying to reserve compost
if (isset($_GET['listing_id'])) {
    $listing_id = $_GET['listing_id'];
    $user_id = $_SESSION["user_id"];

    // Reserve item if someone else hasnt already reserved it
    $update_sql = "UPDATE listings SET orderedBy = :user_id WHERE ID = :listing_id AND orderedBy IS NULL";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $update_stmt->bindParam(":listing_id", $listing_id, PDO::PARAM_INT);
    $update_stmt->execute();

    // Check if the update was successful 
    if ($update_stmt->rowCount() > 0) {
        $_SESSION['cart'] = [$listing_id];
    } else {
        //if compost is reserved throw an error and redirect
        header("Location: listings.php?error=Listing already reserved");
        exit();
    }

    //get details of reserved items
    $sql = "SELECT * FROM listings WHERE ID = :listing_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":listing_id", $listing_id, PDO::PARAM_INT);
    $stmt->execute();
    $listing = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
	//redirect to homepage if no items selected
    header("Location: index.php");
    exit();
}
//calculate cart total
$totalPrice = 0;
if ($listing) {
    $totalPrice += $listing['price'];
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

                <button type="submit" name="place_order">Place Order</button>
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
                <div class="cancel-order-container">
                    <form action="checkout.php" method="POST" class="logout-form">
                        <button type="submit" name="cancel_order">Cancel Order</button>
                    </form>
                </div>
            <?php else: ?>
                <p>No items in your basket</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>