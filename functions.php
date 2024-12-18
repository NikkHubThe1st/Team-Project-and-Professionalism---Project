<?php

function getConnection() {
    try {
       #$conn = new PDO("mysql:host=localhost; dbname=kv6013db", "root", "");

		$conn= new PDO("mysql:host=numyspace_db; dbname=w21011937", "w21011937", "/Poppy2003");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
#$conn= new PDO("mysql:host=numyspace_db; dbname=w21011937", "w21011937", "/Poppy2003");
#"mysql:host=localhost; dbname=kv6013db", "root", ""
/*check user session by user_id*/
function sessionCheck() {
    if (!isset($_SESSION["user_id"])) {
        ?>
        <script>
            alert("Please login");
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 50);
        </script>
        <?php
        exit();
    }
}


#$conn = new PDO("mysql:host=nuwebspace_db; dbname=w21009785", "w21009785", "Incorrect@123");
# link to website -> https://w21011937.nuwebspace.co.uk/Database/listings.html
function validate_login() {
    $input = array();
    $errors = array();

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $input['username'] = $username;
    $input['password'] = $password;

    if (empty($username) || empty($password)) {
        $errors[] = "Username and password are required.";
    } else {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                set_session('authenticated', true);
                set_session('username', $username);
                echo "works";
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Username does not exist.";
        }
    }

    $conn = null;

    return array('input' => $input, 'errors' => $errors);
}

function logout() {
    session_start();
    session_unset();
    session_destroy();

    header("Location: login.php"); //redirects user after removing their session - Nick
    exit();
}

function show_errors($errors) {
    $errorMessage = implode("<br>", $errors);
    $errorMessage .= '<form action="loginProcess.php" method="post">';
    $errorMessage .= '<label for="username">Username:</label>';
    $errorMessage .= '<input type="text" name="username" value="' . htmlspecialchars($errors['input']['username'] ?? '') . '"><br>';
    $errorMessage .= '<label for="password">Password:</label>';
    $errorMessage .= '<input type="password" name="password"><br>';
    $errorMessage .= '<input type="submit" value="Login">';
    $errorMessage .= '</form>';

    return $errorMessage;
}

function set_session($key, $value) {
    $_SESSION[$key] = $value;
    return true;
}

function get_session($key, $default = null) {
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }

    return $default;
}

function check_login() {
    $loggedIn = get_session('authenticated', false);
    return $loggedIn === true;
}

function createNavbar() {
    /* use php_self to find the current name of the file and rename accordingly*/
    $currentPage = basename($_SERVER['PHP_SELF']);
    $pageTitles = [
        "index.php" => "Dashboard",
        "listings.php" => "Listings",
        "profileListings.php" => "User Search",
        "profile.php" => "Profile",
        "reportIssue.php" => "Report an Issue",
        "TOS.php" => "Terms of Service",
        "login.php" => "Log In",
        "logout.php" => "Log Out", 
        "map.php" => "Map",
        "checkoutNick.php" => "Checkout"
    ];

    /* Default to "Dashboard" if the page not found */
    $pageTitle = $pageTitles[$currentPage] ?? "Dashboard";

    /*end php for a little to include nav bar*/
    ?>
    <div id="navbar">
        <div id="menu-toggle" class="menu-icon">
            &#9776; <!-- burger icon, yum! -->
        </div>
        <h1 class="dashboard-title"><?php echo htmlspecialchars($pageTitle); ?></h1>
        <nav id="side-nav" class="side-nav">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="listings.php">Listings</a></li>
                <li><a href="profileListings.php">User Search</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Rewards</a></li>
                <li><a href="reportIssue.php">Report Issue</a></li>
                <li><a href="TOS.php">TOS</a></li>
                <li><a href="<?php echo check_login() ? 'logout.php' : 'login.php'; ?>"><?php echo check_login() ? "Log Out" : "Log In"; ?></a></li> <!--Using check_login() to check if user is logged in-->
                <li><a href="map.php">Map</a></li>
                <li><a href="checkoutNick.php">Checkout</a></li>
            </ul>
        </nav>
    </div>
    <?php
}

/* Generate a section with listings */
function getListings(){
    ?>
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
    <?php
            }
?>