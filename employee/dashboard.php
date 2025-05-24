<?php
require_once(__DIR__ . '/includes/session.php');
require_once(__DIR__ . '/includes/config.php');

require_once(__DIR__ . '/includes/header.php');
require_once(__DIR__ . '/includes/sidebar.php');

$employee_id = $_SESSION['employee_id'];
$employee_name = $_SESSION['employee_name'] ?? 'Employee';

// Fetch dashboard summary
$leave_stmt = $conn->prepare("SELECT COUNT(*) FROM employee_leaves WHERE employee_id = ?");
$leave_stmt->execute([$employee_id]);
$total_leaves = $leave_stmt->fetchColumn();

$borrow_stmt = $conn->prepare("SELECT COUNT(*) FROM borrow_requests WHERE employee_id = ?");
$borrow_stmt->execute([$employee_id]);
$total_borrows = $borrow_stmt->fetchColumn();

$salary_stmt = $conn->prepare("SELECT COUNT(*) FROM employee_salaries WHERE employee_id = ?");
$salary_stmt->execute([$employee_id]);
$total_salaries = $salary_stmt->fetchColumn();

$support_stmt = $conn->prepare("SELECT COUNT(*) FROM support_messages WHERE employee_id = ?");
$support_stmt->execute([$employee_id]);
$total_tickets = $support_stmt->fetchColumn();
?>

<div class="main p-4 w-100">
    <div class="container-fluid">



        <h2 class="mb-4">Welcome, <?= htmlspecialchars(ucwords($employee_name)) ?></h2>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Total Leaves</h5>
                            <h3><?= $total_leaves ?></h3>
                        </div>
                        <a href="apply_leave.php" class="btn btn-light btn-sm mt-3">Apply Leave</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-dark bg-warning h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Borrow Requests</h5>
                            <h3><?= $total_borrows ?></h3>
                        </div>
                        <a href="request_borrow.php" class="btn btn-dark btn-sm mt-3">Request Borrow</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Salary Records</h5>
                            <h3><?= $total_salaries ?></h3>
                        </div>
                        <a href="salary_list.php" class="btn btn-light btn-sm mt-3">View Salary</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Support Tickets</h5>
                            <h3><?= $total_tickets ?></h3>
                        </div>
                        <a href="support_tickets.php" class="btn btn-light btn-sm mt-3">View Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>
