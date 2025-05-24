<?php
// Get the base path dynamically from the current script
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim(str_replace('\\', '/', $basePath), '/');
$assetPath = $basePath . '/assets';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="<?= $assetPath ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $assetPath ?>/css/style.css">
</head>
<body>
