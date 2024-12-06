<?php
session_start();
require_once 'functions.php';

if (check_login()) {
    ?>
    <!DOCTYPE html>
    <html lang='en'>
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
        </style>
    </head>
    <body>
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
        <body>
            <h1>All Events</h1>
            <?php
            $eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;

            if (empty($eventID)) {
                echo "<p>Please <a href='restrictedAdminPage.php'>choose</a> an event.</p>\n";
            } else {
                try {
                    require_once("functions.php");
                    $dbConn = getConnection();

                    $sqlQuery = "SELECT eventID, eventTitle, eventStartDate, eventEndDate, EGN_events.catID, catDesc, EGN_events.venueID, venueName, eventDescription
                                 FROM EGN_events
                                 INNER JOIN EGN_categories ON EGN_categories.catID = EGN_events.catID
                                 INNER JOIN EGN_venues ON EGN_venues.venueID = EGN_events.venueID
                                 WHERE eventID = $eventID";
                    $queryResult = $dbConn->query($sqlQuery);

                    $rowObj = $queryResult->fetchObject();

                    echo "
                    <h1>Update '{$rowObj->eventTitle}'</h1>
                    <form id='UpdateEvent' action='updateEvent.php' method='post'>
                        <p>Event ID <input type='text' name='eventID' value='$eventID' readonly /></p>
                        <p>Title <input type='text' name='eventTitle' size='50' value='{$rowObj->eventTitle}' /></p>
                        <p>Start Date <input type='date' name='eventStartDate' value='{$rowObj->eventStartDate}' /></p>
                        <p>End Date <input type='date' name='eventEndDate' value='{$rowObj->eventEndDate}' /></p>
                        <p>Category <input type='text' name='catID' value='{$rowObj->catID}' /></p>
                        <p>Venue <input type='text' name='venueID' value='{$rowObj->venueID}' /></p>
                        Description <br />
                        <textarea name='eventDescription'>{$rowObj->eventDescription}</textarea>
                        <p><input type='submit' name='submit' value='Update Event'></p>
                    </form>
                    ";
                } catch (Exception $e) {
                    echo "<p>Event details not found: " . $e->getMessage() . "</p>\n";
                }
            }
            ?>
        </body>
        <footer class='footer py-1 text-sm-center' data-id='web_footer'>
            <div class='text-white'> &copy; 2024 Bicher A. All Rights Reserved.</div>
        </footer>
        <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    </html>
    <?php
} else {
    echo "<html lang='en'>
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
                        color: #dc3545;
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
                <div class='restricted-container'>
                    <h1>Access Denied</h1>
                    <p>You must be logged in to view this page.</p>
                    <a href='login.html'>Login</a>
                </div>
                <footer class='footer py-1 text-sm-center' data-id='web_footer'>
                    <div class='text-white'> &copy; 2024 Bicher A. All Rights Reserved.</div>
                </footer>
                <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
            </body>
          </html>";
}
?>
