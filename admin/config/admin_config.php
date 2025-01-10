<?php
    $databaseHost = 'localhost';
    $databaseUsername = 'root';
    $databasePassword = '';
    $databaseName = 'sugarrush';

    // define BASE_URL if it hasn't been defined yet
    if (!defined('BASE_URL')) {
        define('BASE_URL', 'http://localhost/sugarrush');
    }

    // define ADMIN_BASE_URL if it hasn't been defined yet
    if (!defined('ADMIN_BASE_URL')) {
        define('ADMIN_BASE_URL', 'http://localhost/sugarrush/admin');
    }

    // define ADMIN_BASE_PATH if it hasn't been defined yet
    if (!defined('ADMIN_BASE_PATH')) {
        define('ADMIN_BASE_PATH', '/admin');
    }

    // create a connection to the database
    $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    // check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    // echo "DB Connection Successful." . "<br>";
?>