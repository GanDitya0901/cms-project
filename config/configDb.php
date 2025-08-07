<?php
$host = "localhost";
$dbname = "cmsproject";
$dbusername = "root";
$dbpass = "";

try {
    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $dbusername, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Failed to connect to the DB: " . $e->getMessage());
}

?>