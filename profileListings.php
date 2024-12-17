<?php
include("functions.php");
session_start();
sessionCheck(); //ensure user is logged in to access listings to php
$user_id = $_SESSION["user_id"];
$conn = getConnection();
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php createNavbar();?>

<?php
        #Get User info
            $users_sql = "
                SELECT username, description
                FROM users 
                WHERE NOT users.ID = :user_id
                ";

            $users_stmt = $conn->prepare($users_sql);
            $users_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $users_stmt->execute();
            $users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    
            <p>s</p>
            <?php if (empty($users)): ?>
                <p>You're all alone: no users found!</p>
            <?php else: ?>
                <div id="listings-container" class="listings-container">
                    <?php foreach ($users as $user): ?>
                        <div class="listing">
                            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                            <img src="example-picture.jpg" alt="Profile Picture" class="profile-pic">
                            <p><?php echo htmlspecialchars($user['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
<script src="script.js"></script>
</body>
</html>