<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim(str_replace('\\', '/', $basePath), '/');
$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

<div class="d-flex">
    <!-- Fixed Sidebar -->
    <nav class="sidebar bg-dark text-white position-fixed d-flex flex-column" style="width: 250px; height: 100vh;">
        <h4 class="text-center py-4 border-bottom mb-0">Employee Panel</h4>
        <ul class="nav flex-column px-3">

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'dashboard.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/dashboard.php">Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'profile.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/profile.php">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'apply_leave.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/apply_leave.php">Apply Leave</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'view_leaves.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/view_leaves.php">View Leaves</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'request_borrow.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/request_borrow.php">Borrow Request</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'salary_list.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/salary_list.php">Salary Details</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'contact_admin.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/contact_admin.php">Support</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'support_tickets.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/support_tickets.php">Tickets</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 'change_password.php' ? 'bg-secondary text-white fw-bold' : 'text-white' ?>" href="<?= $basePath ?>/change_password.php">Change Password</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?= $basePath ?>/auth/logout.php">Logout</a>
            </li>

        </ul>
    </nav>

    <!-- Begin Page Content (shifted right) -->
    <div class="flex-grow-1" style="margin-left: 250px;">
