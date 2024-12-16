<?php
require_once 'functions.php';


$conn = getConnection();

if ($conn) {
    echo "Connection successful!<br>";

    $sql = "SELECT * FROM users";
    $stmt = $conn->query($sql);

    echo "<h2>Users in the Database:</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
            </tr>";
    foreach ($stmt as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['password']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                </tr>";
    }
    echo "</table>";
    
    // Close the connection
    $conn = null;
}

?>