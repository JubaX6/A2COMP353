<?php
 // $server = 'udc353.encs.concordia.ca';
 // $username = 'udc353_1';
 // $password = 'dboats11';
 // $database = 'udc353_1';

$server = 'udc353.encs.concordia.ca';
$username = 'udc353_1';
$password = 'dboats11';
$database = 'udc353_1';
//Connection to the database
try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('connection failed: ' . $e->getMessage());
}

?>