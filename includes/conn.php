<?php

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "root";
    $dbName = "sita";

    $conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
    $conn->set_charset("utf8");

    if (!$conn) {
        die ("Database connection failed!");
    }

    return $conn;

?>