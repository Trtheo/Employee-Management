<?php


$host = "localhost";
$user = "root";
$pass = "Niyigaba2002@";
$db = "hr_soft1";
$currency = "INR";


try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
