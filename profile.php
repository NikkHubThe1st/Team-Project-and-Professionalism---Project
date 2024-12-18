<?php
include("functions.php");
session_start();
sessionCheck();


$user_id = $_SESSION["user_id"];

$conn = getConnection();

$sql = "SELECT username, description FROM users WHERE ID = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $username = $user['username'];
    $description = $user['description'];
} else {
    echo "User not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["description"])) {
    $new_description = htmlspecialchars($_POST["description"]);

    $update_sql = "UPDATE users SET description = :description WHERE ID = :user_id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(':description', $new_description, PDO::PARAM_STR);
    $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($update_stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating description.";
    }
}

$listings_sql = "
    SELECT listings.*, users.username 
    FROM listings 
    INNER JOIN users ON listings.userID = users.ID 
    WHERE listings.userID = :user_id
";
$listings_stmt = $conn->prepare($listings_sql);
$listings_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$listings_stmt->execute();

$listings = $listings_stmt->fetchAll(PDO::FETCH_ASSOC);

$orders_sql = "
    SELECT listings.*, users.username 
    FROM listings 
    INNER JOIN users ON listings.userID = users.ID 
    WHERE listings.orderedBy = :user_id
";
$orders_stmt = $conn->prepare($orders_sql);
$orders_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$orders_stmt->execute();

$orders = $orders_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {
    echo "logout button working";
    logout();
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<?php
createNavbar();
?>

    <header class="profile-header">
        <div class="user-info">
            <img src="example-picture.jpg" alt="Profile Picture" class="profile-pic">
            <h1 id="username"><?php echo htmlspecialchars($username); ?></h1>
            <form method="POST" action="profile.php">
                <label for="description">Edit your description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" cols="50"><?php echo htmlspecialchars($description); ?></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Update Description</button>
            </form>
            <form method="POST">
                <button type="submit" name="logout" class="logout-button">Logout</button>
            </form>
        </div>
    </header>
    
            <!-- 
                <div class="form-group">
                <label for="description">Issue Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Describe your issue in detail" required></textarea>
                </div>
            -->

    <h2 class="listings-heading">My Listings</h2>
    <a href="createlisting.php">
    <button type="submit" class="btn btn-block btn-primary">Create Listing</button>
            </a>
    <?php if (empty($listings)): ?>
        <p>No current listings</p>
    <?php else: ?>
        <div id="listings-container" class="listings-container">
            <?php foreach ($listings as $listing): ?>
                <div class="listing">
                    <h2><?php echo htmlspecialchars($listing['description']); ?></h2>
                    <img src="CompostBin.jpg" alt="Compost Bin" style="width:150px;height:auto;">
                    <p><strong>User:</strong> <?php echo htmlspecialchars($listing['username']); ?></p>
                    <p><strong>Price:</strong> <?php echo htmlspecialchars($listing['price']); ?></p>
                    <p><strong>Weight:</strong> <?php echo htmlspecialchars($listing['weight']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($listing['description']); ?></p>
                    <a href="map.php">
                        <button class="viewMap-button">View Map</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </section>

    <div>
    <h2 class="listings-heading">My Orders</h2>
    <?php if (empty($orders)): ?>
        <p>No current orders</p>
    <?php else: ?>
        <div id="listings-container" class="listings-container">
            <?php foreach ($orders as $order): ?>
                <div class="listing">
                    <h2><?php echo htmlspecialchars($order['description']); ?></h2>
                    <img src="CompostBin.jpg" alt="Compost Bin" style="width:150px;height:auto;">
                    <p><strong>User:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
                    <p><strong>Price:</strong> <?php echo htmlspecialchars($order['price']); ?></p>
                    <p><strong>Weight:</strong> <?php echo htmlspecialchars($order['weight']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($order['description']); ?></p>
                    <a href="map.php">
                        <button class="viewMap-button">View Map</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>

</html>