<?php

// if we are in the local environment
$host = "localhost";
$dbname = "tai";
$user = "root";
$pwd = "";

// if we are on the server
if (file_exists("/var/www/")) {
    $host = "localhost";
    $dbname = "tai_app_2023_2024_shark";
    $user = "tai_app_2023_2024_shark";
    $pwd = "5E8YETH6JZ";
}

?>