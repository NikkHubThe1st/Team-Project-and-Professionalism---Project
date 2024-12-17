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
    createNavbar(); //Using php function to make nav bar
    ?>

    <?php

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