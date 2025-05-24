<?php
require_once 'includes/session.php';
require_once 'includes/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$leave_id = (int)$_GET['id'];
$emp_id = $_SESSION['employee_id'];

// Ensure the leave belongs to the logged-in employee
$stmt = $conn->prepare("SELECT * FROM employee_leaves WHERE id = ? AND employee_id = ?");
$stmt->execute([$leave_id, $emp_id]);
$leave = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$leave) {
    die("Unauthorized access or leave record not found.");
}

// Delete the leave record
$del = $conn->prepare("DELETE FROM employee_leaves WHERE id = ? AND employee_id = ?");
$del->execute([$leave_id, $emp_id]);

// Redirect back to view_leaves.php with a success flag
header("Location: view_leaves.php?deleted=1");
exit;
