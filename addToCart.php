<?php
//This file 'listens' for items added to the cart
include("functions.php");

//Listen for POST of listing_id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listing_id'])) {
    $listingId = (int)$_POST['listing_id'];

    //addToCart() function called when item_id recieved
    if (addToCart($itemId)) {
        header('Location: checkoutNick.php'); // Redirect back to listings after adding
    } else {
        echo "Failed to add item to the cart.";
    }
}
?>