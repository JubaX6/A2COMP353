<?php
 // $server = 'udc353.encs.concordia.ca';
 // $username = 'udc353_1';
 // $password = 'dboats11';
 // $database = 'udc353_1';

$server = 'localhost:3306';
$username = 'udc353_1';
$password = 'dboats11';
$database = 'udc353_1';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('connection failed: ' . $e->getMessage());
}

?>