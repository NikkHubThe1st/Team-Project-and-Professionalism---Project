<?php
    /* This script is used to create a connection to the NewNuMySpace DB using variables to keep things clear*/
    $host = 'localhost';
    $user = 'unn_w21029182'; /*using my details - Nick */
    $pass = '231ScranSaved'; /*Need to reset password on NewNuMySpace */
    $dbname = 'unn_w21029182';
    $connection new PDO("mysql:host=$host:dbname=$dbname:$user,$pass");
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $connection

    /*Return connection error message on failure */
    catch(Exception $e)[
        throw new Exception("Connection error: " . $e->getMessage(),0,$e);
    ]
?>