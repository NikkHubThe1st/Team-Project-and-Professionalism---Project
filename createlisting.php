<?php
include("functions.php");
session_start();
sessionCheck();


$user_id = $_SESSION["user_id"];

$conn = getConnection();

$error = "";
$success = "";

try {
    $stmt = $conn->prepare("SELECT ID FROM users WHERE ID = :user_id");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        $error = "User not found. Please log in again.";
        session_destroy();
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {
    $error = "Error fetching user data: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $weight = trim($_POST['weight']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($price) || empty($weight) || empty($description)) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO listings (userID, price, weight, description, title, orderedBy) 
                                    VALUES (:userID, :price, :weight, :description, :title, NULL)");

            $stmt->bindParam(":userID", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":weight", $weight, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);

            $stmt->execute();

            $success = "Listing created successfully!";
        } catch (PDOException $e) {
            $error = "Error creating listing: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Listing</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php createNavbar(); ?>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Create a Listing</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form class="p-4 bg-white rounded shadow" method="post" action="createlisting.php">
            <div class="form-group">
                <label for="title">Listing Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter listing title" required>
            </div>

            <div class="form-group">
                <label for="price">Price (in USD):</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" required>
            </div>

            <div class="form-group">
                <label for="weight">Weight (in kg):</label>
                <input type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="Enter weight" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Upload Listing</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>