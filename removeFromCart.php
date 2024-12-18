<?php
//This file handles removing items from cart using removeFromCart() function
include('functions.php');

// Listen for item via POST
if (isset($_POST['listing_id'])) {
    $listingId = $_POST['listing_id'];

    if (removeFromCart($listingId)) {
        header('Location: checkoutNick.php'); // Redirect back to checkout after removal
        exit();
    } else {
        echo 'Failed to remove item'; // Error handling
    }
} else {
    echo 'No item ID provided';
}
?>