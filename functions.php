<?php

function getConnection() {
    try {
        $conn = new PDO("mysql:host=nuwebspace_db; dbname=w2110937", "w2110937", "/Poppy2003");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
#$conn = new PDO("mysql:host=nuwebspace_db; dbname=w21009785", "w21009785", "Incorrect@123");

function validate_login() {
    $input = array();
    $errors = array();

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $input['username'] = $username;
    $input['password'] = $password;

    if (empty($username) || empty($password)) {
        $errors[] = "Username and password are required.";
    } else {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                set_session('authenticated', true);
                set_session('username', $username);
                echo "works";
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Username does not exist.";
        }
    }

    $conn = null;

    return array('input' => $input, 'errors' => $errors);
}


function show_errors($errors) {
    $errorMessage = implode("<br>", $errors);
    $errorMessage .= '<form action="loginProcess.php" method="post">';
    $errorMessage .= '<label for="username">Username:</label>';
    $errorMessage .= '<input type="text" name="username" value="' . htmlspecialchars($errors['input']['username'] ?? '') . '"><br>';
    $errorMessage .= '<label for="password">Password:</label>';
    $errorMessage .= '<input type="password" name="password"><br>';
    $errorMessage .= '<input type="submit" value="Login">';
    $errorMessage .= '</form>';

    return $errorMessage;
}

function set_session($key, $value) {
    $_SESSION[$key] = $value;
    return true;
}

function get_session($key, $default = null) {
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }

    return $default;
}

function check_login() {
    $loggedIn = get_session('authenticated', false);
    return $loggedIn === true;
}
?>