<?php
include("functions.php");
session_start();
sessionCheck(); //ensure user is logged in to access listings to php
$user_id = $_SESSION["user_id"];
$conn = getConnection();

try {
    // Fetch the admin status of the logged-in user
    $stmt = $conn->prepare("SELECT admin FROM users WHERE ID = :user_id");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: login.php"); // Redirect if user not found
        exit();
    }

    $is_admin = $user['admin'] == 1; // Check if the user is an admin
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <link rel="stylesheet" href="styles.css">
</head>

    <body>

        <?php 
        createNavbar();
        ?>

        <div>
        <input type="text" id="search-bar" placeholder="Search listings...">

        <?php
        #Populate listings variable with listings
            $listings_sql = "
                SELECT listings.*, users.username 
                FROM listings 
                INNER JOIN users ON listings.userID = users.ID 
                WHERE NOT users.ID = :user_id
				AND listings.orderedBy IS NULL;
                ";

            $listings_stmt = $conn->prepare($listings_sql);
            $listings_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $listings_stmt->execute();
            $listings = $listings_stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
    
            <p>s</p>
            <div style="text-align: center;">
                <a href="createlisting.php">
                    <button type="submit" class="btn btn-primary"style="width: auto;">Create Listing</button>
                </a>
            </div>
            <?php if (empty($listings)): ?>
                <p>No current listings</p>
            <?php else: ?>
                <div id="listings-container" class="listings-container">
                    <?php foreach ($listings as $listing): ?>
                        <div class="listing">
                            <h2><?php echo htmlspecialchars($listing['title']); ?></h2>
                            <img src="CompostBin.jpg" alt="Compost Bin" style="width:150px;height:auto;">
                            <p><strong>User:</strong> <?php echo htmlspecialchars($listing['username']); ?></p>
                            <p><strong>Price:</strong> <?php echo htmlspecialchars($listing['price']); ?></p>
                            <p><strong>Weight:</strong> <?php echo htmlspecialchars($listing['weight']); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($listing['description']); ?></p>
                            <div>
                                <a href="map.php">
                                    <button type="submit" class="btn btn-primary" style="width: auto;">View Map</button>
                                </a>
                                <form action="checkout.php" method="GET" class="logout-form">
                                    <input type="hidden" name="listing_id" value="<?php echo $listing['ID']; ?>">
                                    <button type="submit" class="btn btn-primary" style="width: auto;">Buy Now</button>
                                </form>
                            </div>

                            <?php if ($is_admin): ?>
                            <a href="deletelisting.php?ID=<?php echo $listing['ID'];?>"> 
                            <button type = "submit" class="btn btn-primary"style = "width: auto;"> Delete Button </button>
                            </a>
                            <?php endif; ?>

                            
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
        
        <script src="script.js"></script>
    </body>
</html>