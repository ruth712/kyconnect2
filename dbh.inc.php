<?php

$dsn  = "mysql:host-localhost;dbname=exeat"; //data source name, localhost bcs of xampp
$dbusername = "root";
$dbpassword = "";

// Check connection
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);//php data object - check errors when connecting, more flexible than mysqli
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

