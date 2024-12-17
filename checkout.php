<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
    include("functions.php");
    createNavbar();
    ?>

    <!-- Checkout Form -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Checkout</h1>
        <form class="p-4 bg-white rounded shadow" method="post" action=".php">
            <!-- Billing Information -->
            <h3 class="mb-3">Billing Information</h3>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter your ZIP code" required>
            </div>

            <!-- Payment Information -->
            <h3 class="mb-3">Payment Information</h3>
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" class="form-control" id="card-number" name="card_number" placeholder="Enter your card number" required>
            </div>
            <div class="form-group">
                <label for="expiration">Expiration Date</label>
                <input type="month" class="form-control" id="expiration" name="expiration" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter the 3-digit code on the back of your card" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-block btn-primary">Complete Purchase</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>