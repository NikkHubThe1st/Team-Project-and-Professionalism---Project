<?php
include("functions.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

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
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="navbar">
        <div id="menu-toggle" class="menu-icon">
            &#9776; <!-- burger icon -->
        </div>
        <h1 class="dashboard-title">My Profile</h1>
        <nav id="side-nav" class="side-nav">
            <ul>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="listings.html">Listings</a></li>
                <li><a href="profileListings.html">User Search</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="#">Rewards</a></li>
                <li><a href="reportIssue.html">Report Issue</a></li>
                <li><a href="TOS.html">TOS</a></li>
                <li><a href="login.html">Log In</a></li>
                <li><a href="map.html">Map</a></li>
                <li><a href="checkout.html">Checkout</a></li>
            </ul>
        </nav>
    </div>

    <header class="profile-header">
        <div class="user-info">
            <img src="example-picture.jpg" alt="Profile Picture" class="profile-pic">
            <h1 id="username"><?php echo htmlspecialchars($username); ?></h1>
            <form method="POST" action="profile.php">
                <label for="description">Edit your description:</label>
                <textarea id="description" name="description" rows="4" cols="50"><?php echo htmlspecialchars($description); ?></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Update Description</button>
            </form>
        </div>
    </header>

    <section id="user-listings-section">
    <h2 class="listings-heading">My Listings</h2>
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
                    <a href="map.html">
                        <button class="viewMap-button">View Map</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </section>

    <div id="listings-section">
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
                    <P><strong>Ordered On:</strong> <?php echo htmlspecialchars($order['orderedBy']); ?></P> 
                    <a href="map.html">
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