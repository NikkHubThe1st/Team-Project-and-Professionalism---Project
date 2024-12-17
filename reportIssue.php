<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body >

    <!-- Navigation Menu -->
    <div id="navbar">
        <div id="menu-toggle" class="menu-icon">
            &#9776; <!-- Hamburger Icon -->
        </div>
        <h1 class="dashboard-title">Dashboard</h1>
        <nav id="side-nav" class="side-nav">
            <ul>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="#">Rewards</a></li>
                <li><a href="reportIssue.html">Report Issue</a></li>
                <li><a href="TOS.html">TOS</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="login.html">Log In</a></li>
                <li><a href="map.html">Map</a></li>
                <li><a href="checkout.html">Checkout</a></li>
            </ul>
        </nav>
    </div>

    <!-- Report Issue Form -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Report an Issue</h1>
        <form class="p-4 bg-white rounded shadow" method="post" action="#.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
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