    <?php
    include("functions.php");
    session_start();
    sessionCheck();
    $conn = getConnection();

    // Check if a single item is set in the cart
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<h1>Your Cart is Empty!</h1>";
        echo '<a href="index.php">Back to Listings</a>';
        exit;
    }

    // Retrieve the single item in the cart
    $item_id = $_SESSION['cart'][0];
    $cartItem_sql = "
        SELECT ID, title AS name, price, description 
        FROM listings 
        WHERE ID = :item_id
    ";
    $cartItem_stmt = $conn->prepare($cartItem_sql);
    $cartItem_stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $cartItem_stmt->execute();
    $cartItem = $cartItem_stmt->fetch(PDO::FETCH_ASSOC);

    // If the item is not found, clear the cart
    if (!$cartItem) {
        unset($_SESSION['cart']);
        echo "<h1>Item not found in listings.</h1>";
        echo '<a href="index.php">Back to Listings</a>';
        exit;
    }

    // Calculate the price for a single item
    $totalPrice = $cartItem['price'];
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
                background-color: #;
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
                <form action="process_checkout.php" method="POST">
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
                <?php foreach ($cartItems as $item): ?>
                    <div class="basket-item">
                        <span><?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                        <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="basket-total">
                    <span>Total</span>
                    <span>$<?php echo number_format($totalPrice, 2); ?></span>
                </div>
            </div>
        </div>
    </body>
    </html>