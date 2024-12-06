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
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: rgb(224, 169, 169);">
        <a class="navbar-brand" href="index.html">EGN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="amdminpagesql.html">ADMIN PAGE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="eventBooking.html">EVENT BOOKING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="references.html">REFERENCES</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <?php
                if (!empty($result['errors'])) {
                    echo show_errors($result['errors']);
                } else {
                    set_session('authenticated', true);
                    set_session('username', $result['input']['username']);
                    header("Location: restricted.php");
                    exit();
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer py-1 text-sm-center" data-id="web_footer">
        <div class="text-white"> &copy; 2020 Jayamini Heshani. All Rights Reserved.</div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
        }

        .bg-light {
            background-color: rgb(224, 186, 186) !important;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</body>

</html>
