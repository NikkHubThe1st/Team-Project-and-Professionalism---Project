<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        p {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 5px;
        }

        a {
            color: #004085;
            text-decoration: underline;
        }
    </style>

    <title>Login Result</title>
</head>

<body>
    <?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=Login, initial-scale=1.0">
        <title>Login process script</title>
    </head>

    <body>

        <?php
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $username = trim($username);
        $password = trim($password);

        if (empty($username) || empty($password)) {
            echo "<p>You need to provide a username and password. Please try <a href='login.html'>again</a>.</p>\n";
        } else {
            try {
                unset($_SESSION['username']);
                unset($_SESSION['logged-in']);

                require_once("../functions.php");
                $dbConn = getConnection();

                $querySQL = "SELECT passwordHash FROM EGN_users WHERE username = :username";
                $stmt = $dbConn->prepare($querySQL);
                $stmt->execute(array(':username' => $username));
                $user = $stmt->fetchObject();

                if ($user) {
                    if (password_verify($password, $user->passwordHash)) {
                        echo "<p>Login success!</p>\n";
                        echo "<a href='restricted.php'>Restricted page</a>\n";
                        $_SESSION['logged-in'] = true;
                        $_SESSION['username'] = $username;
                    } else {
                        echo "<p>Username or password incorrect. Please try <a href='login.html'>again</a>.</p>\n";
                    }
                } else {
                    echo "<p>Username or password incorrect. Please try <a href='login.html'>again</a>.</p>\n";
                }
            } catch (Exception $e) {
                echo "Database error: " . $e->getMessage();
            }
        }
        ?>
    </body>
    </html>

    <footer class="footer py-1 text-sm-center" data-id="web_footer">
        <!-- ... (your existing footer code) ... -->
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
