<!-- SQL to add to database
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Foreign key linking to the users table
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    attachment_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(ID)
);
-->

<?php
include("functions.php");
session_start();
sessionCheck();
$conn = getConnection();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation Menu -->
    <?php createNavbar(); ?>

    <!-- Report Issue Form -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Report an Issue</h1>
        <form class="p-4 bg-white rounded shadow" method="post" action="reportProcess.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="technical">Technical Issue</option>
                    <option value="account">Account Issue</option>
                    <option value="billing">Billing Issue</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Issue Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Describe your issue in detail" required></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Attach File (Optional)</label>
                <input type="file" class="form-control-file" id="attachment" name="attachment" accept=".jpg,.png,.pdf,.docx">
            </div>
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>