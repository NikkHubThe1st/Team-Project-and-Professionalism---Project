<?php
include("functions.php");
session_start();
sessionCheck();

$user_id = $_SESSION["user_id"];
$conn = getConnection();

$error = "";

if (isset($_GET['ID'])) {
    $ID = intval(value: $_GET['ID']); // Get the listing ID from the URL

    try {
        // Check if the user is an admin
        $stmt = $conn->prepare("SELECT admin FROM users WHERE ID = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['admin'] != 1) {
            header("Location: index.php"); // Redirect if not an admin
            exit();
        }

        // Delete the listing
        $stmt = $conn->prepare("DELETE FROM listings WHERE ID = :ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the listings page
        header("Location: listings.php?success=Listing removed successfully");
        exit();
    } catch (PDOException $e) {
        $error = "Error removing listing: " . $e->getMessage();
    }
} else {
    header("Location: listings.php?error=No listing ID provided");
    exit();
}
?>
