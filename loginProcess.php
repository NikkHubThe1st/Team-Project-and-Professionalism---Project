<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("functions.php");

// Validate login and get the result array
$result = validate_login();
?>

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
        <h1 class="dashboard-title">Dashboard</h1>
        <nav id="side-nav" class="side-nav">
            <ul>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="#">Rewards</a></li>
                <li><a href="#">Report Issue</a></li>
                <li><a href="TOS.html">TOS</a></li>
				<li><a href="#">Profile</a></li>
                <li><a href="login.html">Log In</a></li>
				<li><a href="map.html">Map</a></li>
            </ul>
        </nav>
    </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form class="p-4 bg-white rounded shadow" method="post" action="loginProcess.php">
          <h1>User Login</h1>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>
          <button type="submit" class="btn btn-block btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form class="p-4 bg-white rounded shadow" method="post" action="register.php">
          <h1>Register To Join ScranSavers</h1>
          <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" name="firstname" required>
          </div>
          <div class="form-group">
            <label for="surname">Surname:</label>
            <input type="text" class="form-control" name="surname" required>
          </div>
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm_password" required>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>


</body>
<script src ="script.js"> </script>

</html>