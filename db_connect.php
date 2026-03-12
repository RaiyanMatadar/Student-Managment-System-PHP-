<?php

$dsn = "mysql:host=localhost;dbname=college_db";
$dbUsername = "root";
$dbPassword = "";

try {
    $pdo = new PDO($dsn,$dbUsername,$dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $error) {
    echo "connection failed";
}