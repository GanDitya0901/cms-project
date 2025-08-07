<?php
$pdo = require __DIR__ . '/config/configDb.php';

if ($pdo instanceof PDO) {
    echo "Connected successfully!";
} else {
    echo "Failed to connect.";
}
