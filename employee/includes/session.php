<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>

