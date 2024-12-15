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
  require_once("functions.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    $errors = array();

    if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters long.";
    }

    if ($password !== $confirmPassword) {
      $errors[] = "Passwords do not match.";
    }

    if (strlen($username) < 6 || strlen($username) > 50) {
      $errors[] = "Username must be between 6 and 50 characters.";
    }

    $connection = getConnection();
    $stmt = $connection->prepare("SELECT COUNT(*) FROM EGN_users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count !== false) {
      if ($count > 0) {
        $errors[] = "Username is already in use. Please choose another username.";
      }
    } else {
      $errors[] = "Error checking username availability. Please try again.";
    }

    if (empty($errors)) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      try {
        $connection = new PDO("mysql:host=nuwebspace_db; dbname=w21009785", "w21009785", "Incorrect@123");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $connection->prepare("INSERT INTO EGN_users (firstname, surname, username, passwordHash) VALUES (:firstname, :surname, :username, :password)");
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        echo "<html>
                  <head>
                      <title>Registration Success</title>
                      <style>
                          body {
                              margin: 0;
                          }
                          .bg-light {
                              background-color: rgb(224, 186, 186) !important;
                          }
                      </style>
                  </head>
                  <body class='bg-light'> 
                      <h1 style='text-align: center; margin-top: 5%;'>Registration Successful</h1>
                      <p style='text-align: center;'>Thank you, $firstname, for registering!</p>
                      <p style='text-align: center;'><a href='login.html'>Login</a></p>
                  </body>
                </html>";
        exit();
      } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
      }
    } else {
      echo "<html>
              <head>
                  <title>Registration Error</title>
                  <style>
                      body {
                          margin: 0;
                      }
                      .bg-light {
                          background-color: rgb(224, 186, 186) !important;
                      }
                  </style>
              </head>
              <body class='bg-light'>
                  <h1 style='text-align: center; margin-top: 5%;'>Registration Error</h1>
                  <p style='text-align: center;'>Please fix the following errors:</p>
                  <ul style='text-align: center; list-style-type: none; padding: 0;'>
                  ";
      foreach ($errors as $error) {
        echo "<li style='color: red;'>$error</li>";
      }
      echo "</ul>
                  <p style='text-align: center;'><a href='login.html'>Back to Registration Form</a></p>
              </body>
            </html>";
    }
  } else {
    header("Location: registrationForm.html");
    exit();
  }
  ?>



</body>
<script src ="script.js"> </script>
</html>