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
            <a href="createlisting.php">
                <button type="submit" class="btn btn-block btn-primary">Create Listing</button>
            </a>
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
                            <a href="map.php">
                                <button class="viewMap-button">View Map</button>
                            </a>
                            <form action="checkout.php" method="GET">
                                <input type="hidden" name="listing_id" value="<?php echo $listing['ID']; ?>">
                                <button class="viewMap-button">Buy Now</button>
                            </form>


                            <?php if ($is_admin): ?>
                            <a href="deletelisting.php?id=<?php echo $listing['ID']; ?>" class="btn btn-danger">Delete</a>
                            <?php endif; ?>

                            
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
        
        <script src="script.js"></script>
    </body>
</html>










<!--
    <div id="listings-section">
        <input type="text" id="search-bar" placeholder="Search listings...">
        <a href="createlisting.php">
            <button type="submit" class="btn btn-block btn-primary">Create a Listing</button>
        </a>
        <div id="listings-container" class="listings-container">
            <div class="listing">
                <h2>HUGE COMPOST BIN</h2>
                <img src="CompostBin.jpg" alt="HUGE COMPOST BIN" style="width:150px;height:auto;">
                <p><strong>User:</strong> Joe Bloggs</p>
                <P><strong>Location:</strong>Jakarta</P>
                <p><strong>Price:</strong> $5 and a steak bake</p>
                <p><strong>Weight:</strong> 100kg</p>
                <p><strong>Description:</strong> Holy moly, that's a huge compost bin!</p>
                <a href="checkout.html">
                    <button type="submit" class="btn btn-block btn-primary">Add to Cart</button>
                </a>
            </div>
            <div class="listing">
                <h2>Mid compost bin</h2>
                <img src="MidCompostBin.jpg" alt="it's okay, it's a compost bin" style="width:150px;height:auto;">
                <p><strong>User:</strong> Adams Adams</p>
                <P><strong>Location:</strong>Surabaya</P>
                <p><strong>Price:</strong> $5</p>
                <p><strong>Weight:</strong> 40kg</p>
                <p><strong>Description:</strong> Been collecting compost bins for a while, my wife told me to get rid of
                    some.</p>
                <a href="checkout.html">
                    <button type="submit" class="btn btn-block btn-primary">Add to Cart</button>
                </a>
            </div>
            <div class="listing">
                <h2>Small Clam Compost Bin</h2>
                <img src="SmallCompostBin.jpg" alt="A small compost bin" style="width:150px;height:auto;">
                <p><strong>User:</strong> Sarah Green</p>
                <P><strong>Location:</strong>Bekasi</P>
                <p><strong>Price:</strong> $7</p>
                <p><strong>Weight:</strong> 5kg</p>
                <p><strong>Description:</strong>Fished all these clams by accident, selling as compost as they're taking
                    over my home</p>
                <a href="checkout.html">
                    <button type="submit" class="btn btn-block btn-primary">Add to Cart</button>
                </a>
            </div>

            <div class="listing">
                <h2>Eco-Friendly Bin</h2>
                <img src="EcoBin.jpg" alt="Eco-friendly compost bin" style="width:150px;height:auto;">
                <p><strong>User:</strong> Eco Warriors</p>
                <P><strong>Location:</strong>Bekasi</P>
                <p><strong>Price:</strong> Free</p>
                <p><strong>Weight:</strong> 15kg</p>
                <p><strong>Description:</strong> Save the planet, one compost bin at a time!</p>
                <a href="checkout.html">
                    <button type="submit" class="btn btn-block btn-primary">Add to Cart</button>
                </a>
            </div>

            <div class="listing">
                <h2>Compact Bin</h2>
                <img src="CompactBin.jpg" alt="Compact compost bin" style="width:150px;height:auto;">
                <p><strong>User:</strong> Compact Solutions</p>
                <P><strong>Location:</strong>Bandung</P>
                <p><strong>Price:</strong> $2</p>
                <p><strong>Weight:</strong> 8kg</p>
                <p><strong>Description:</strong> Compact, lightweight, and efficient.</p>
                <a href="checkout.html">
                    <button type="submit" class="btn btn-block btn-primary">Add to Cart</button>
                </a>
            </div>
        </div>
    </div>

    <script src="listings.js"></script>
</body>

</html>
-->