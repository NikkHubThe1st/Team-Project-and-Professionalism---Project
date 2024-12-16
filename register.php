<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Login Page</title>
</head>


<body>

</nav>
  <div id="navbar">
        <div id="menu-toggle" class="menu-icon">
            &#9776; <!-- Hamburger Icon -->
        </div>
        <h1 class="dashboard-title">Register</h1>
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

    <?php
    include("functions.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $email = $_POST['email'] ?? '';
    
        if ($password !== $confirmPassword) {
            echo "Passwords do not match. Please try again.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $conn = getConnection();
    
            $sql = "INSERT INTO users (username, passwordHash, email) VALUES (:username, :passwordHash, :email)";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':passwordHash', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                echo "User registered successfully! <a href='login.html'>Login</a>";
            } else {
                echo "Error registering user. Please try again.";
            }
        }
    }
?>

</body>
<script src ="script.js"> </script>
</html>