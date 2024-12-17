<?php include("functions.php")?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php createNavbar();?>

    <script src="script.js"></script>

    <!--The page header will include the search bar-->
    <header class="header">
        <h1>Search Users</h1>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search users by name, location, or role..." />
            <button id="search-button">Search</button>
        </div>
    </header>

    <main class="results">
        <h2>Results</h2>
        <div id="user-container">
            <!-- Found User cards will be populated in the main using JS-->
        </div>
        <p id="no-results" style="display: none;">No users found. Try a different search.</p>
    </main>

    <script src="script.js"></script>
</body>

</html>