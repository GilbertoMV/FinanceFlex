<?php

$servername ='localhost';
$dbname = 'appfinance';
$username = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  error_log("Connected successfully");
} catch(PDOException $e) {
  error_log("Connection failed: " . $e);
}

?>