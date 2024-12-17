<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Login Page</title>
</head>

<body>

<?php
    include("functions.php");
    createNavbar();
    ?>
    
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
          <h1>Register To Join CompostConnect</h1>
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
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
  
 
</body>
<script src ="script.js"> </script>

</html>
