<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "dscloudswift";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $err) {
    echo "Error, couldn't establish a connection: " . $err->getMessage();
}
