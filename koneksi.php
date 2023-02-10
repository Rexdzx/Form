<?php
$host = "localhost";
$dbusername = "phoenix";
$dbpassword = "Awqe1234%";
$dbname   = "Rafly";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>