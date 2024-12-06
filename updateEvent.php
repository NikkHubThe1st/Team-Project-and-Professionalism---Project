<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>updateEvent.php - updating an event record to a database using PDO</title>
</head>
<body>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' href='styles.css'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
        <title>Restricted Area</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fa;
            }

            .restricted-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #007bff;
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

            .restricted-container-2 {
                text-align: center;
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .green-text {
                color: green;
            }
        </style>
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class='navbar navbar-expand-sm navbar-dark' style='background-color: rgb(224, 169, 169);'>
            <a class='navbar-brand' href='restrictedHomePage.php'>EGN</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item'>
                        <a class='nav-link' href='restrictedHomePage.php'>HOME</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='restrictedAdminPage.php'>ADMIN PAGE</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='bookEventsForm.php'>EVENT BOOKING</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='restrictedReferences'>REFERENCES</a>
                    </li>
                    <div class='ml-2'>
                        <a href='logout.php' class='btn btn-sm' data-id='nav_btn_logout'>Logout</a>
                    </div>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
        // Retrieve variables
        $eventID = filter_has_var(INPUT_POST, 'eventID') ? $_POST['eventID'] : null;
        $eventTitle = filter_has_var(INPUT_POST, 'eventTitle') ? $_POST['eventTitle'] : null;
        $eventStartDate = filter_has_var(INPUT_POST, 'eventStartDate') ? $_POST['eventStartDate'] : null;
        $eventEndDate = filter_has_var(INPUT_POST, 'eventEndDate') ? $_POST['eventEndDate'] : null;
        $catID = filter_has_var(INPUT_POST, 'catID') ? $_POST['catID'] : null;
        $venueID = filter_has_var(INPUT_POST, 'venueID') ? $_POST['venueID'] : null;
        $eventDescription = filter_has_var(INPUT_POST, 'eventDescription') ? $_POST['eventDescription'] : null;

        $errors = false;

        if (empty($eventID)) {
            echo "<p>You need to have selected an event.</p>\n";
            $errors = true;
        }
        if (empty($eventTitle)) {
            echo "<p>Title cannot be empty.</p>\n";
            $errors = true;
        }
        if (empty($eventStartDate) || empty($eventEndDate)) {
            echo "<p>Dates cannot be empty.</p>\n";
            $errors = true;
        }
        if (empty($catID)) {
            echo "<p>You need to choose a category.</p>\n";
            $errors = true;
        }
        if (empty($venueID)) {
            echo "<p>You need to choose a venue.</p>\n";
            $errors = true;
        }
        if ($errors === true) {
            echo "<p>Please try <a href='restrictedAdminPage.php'>again</a>.</p>\n";
        } else {
            try {
                require_once("functions.php");
                $dbConn = getConnection();
                $eventDescription = $dbConn->quote($eventDescription);

                $updateSQL = "UPDATE EGN_events SET
                              eventTitle = :eventTitle,
                              eventStartDate = :eventStartDate,
                              eventEndDate = :eventEndDate,
                              catID = :catID,
                              venueID = :venueID,
                              eventDescription = :eventDescription
                              WHERE eventID = :eventID";

                $stmt = $dbConn->prepare($updateSQL);

                $stmt->bindParam(':eventTitle', $eventTitle);
                $stmt->bindParam(':eventStartDate', $eventStartDate);
                $stmt->bindParam(':eventEndDate', $eventEndDate);
                $stmt->bindParam(':catID', $catID);
                $stmt->bindParam(':venueID', $venueID);
                $stmt->bindParam(':eventDescription', $eventDescription);
                $stmt->bindParam(':eventID', $eventID);

                $stmt->execute();

                echo "<div class='restricted-container-2'>
                        <p class='green-text'>Event updated</p>
                    </div>\n
                    <div class='restricted-container'>
                        <p>You can return back to Admin Page to edit another event.</p>
                        <a class='nav-link' href='restrictedAdminPage.php' style='text-align: center;'>ADMIN PAGE</a>
                    </div>";

            } catch (Exception $e) {
                echo "<p>Event not updated: " . $e->getMessage() . "</p>\n";
            }
        }
        ?>
        <!-- Footer -->
        <footer class='footer py-1 text-sm-center' data-id='web_footer'>
            <div class='text-white'> &copy; 2024 Bicher A. All Rights Reserved.</div>
        </footer>
        <!-- JS -->
        <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    </body>
</html>
