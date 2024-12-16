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
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$username =$_POST['username'] ?? '';
$password =$_POST['password'] ?? '';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


  $conn= getConnection();


  $sql = "SELECT ID, passwordHash FROM users WHERE username = :username";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute(array(':username' => $username));

  $user =$stmt->fetch(PDO::FETCH_ASSOC);
  if($user && password_verify($password, $user["passwordHash"])){
      $_SESSION["user_id"] = $user["ID"];
      echo "login successful! <a href='profile.php'>Go to profile</a>";
  }else{
    echo "Invalid username or password. Please try again.";
  }
?>


</body>
<script src ="script.js"> </script>

</html>