<?php
session_start();

// Empty the session array
$_SESSION = array();

// Destroy the session
session_destroy();

// Display a message saying the user has been logged out
echo "<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Logout</title>
    <link rel='stylesheet' type='text/css' href='styles.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .logout-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
        }
        p {
            color: #495057;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav class='navbar navbar-expand-sm navbar-dark' style='background-color: rgb(224, 169, 169);'>
    <a class='navbar-brand' href='index.html'>EGN</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
            aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
        <ul class='navbar-nav ml-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='index.html'>HOME</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='amdminpagesql.html'>ADMIN PAGE</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='bookEventsForm.php'>EVENT BOOKING</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='references.html'>REFERENCES</a>
            </li>
            <div class='ml-2'>
                <a href='login.html' class='btn btn-sm' data-id='nav_btn_login'>Login</a>
            </div>
            </li>
        </ul>
    </div>
</nav>
<div class='container mt-4'>
    <div class='logout-container'>
        <h1>Logout Successful</h1>
        <p>You have been successfully logged out.</p>
        <p><a href='login.html'>Login</a></p>
    </div>
    <footer class='footer py-1 text-sm-center' data-id='web_footer'>
        <div class='text-white'> &copy; 2020 Jayamini Heshani. All Rights Reserved.</div>
    </footer>
    <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
</body>
</html>";
?>
