<?php
// //database settings

$servername = "localhost";
$username = "root";
$password = "Niyigaba2002@";
$dbname = "hr_soft1";
$currency = "INR";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: set charset
    $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>