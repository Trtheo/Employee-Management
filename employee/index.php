<?php
// File: employee/index.php
require_once('includes/session.php');
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/sidebar.php');
?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Employee Dashboard</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Leaves Applied</h5>
                        <div class="metric-value d-inline-block">
                            <?php
                            $employee_id = $_SESSION['employee_id'];
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM employee_leaves WHERE employee_id=?");
                            $stmt->execute([$employee_id]);
                            echo '<h1 class="mb-1">' . $stmt->fetchColumn() . '</h1>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top-success">
                    <div class="card-body">
                        <h5 class="text-muted">Borrow Requests</h5>
                        <div class="metric-value d-inline-block">
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM borrow_requests WHERE employee_id=?");
                            $stmt->execute([$employee_id]);
                            echo '<h1 class="mb-1">' . $stmt->fetchColumn() . '</h1>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top-warning">
                    <div class="card-body">
                        <h5 class="text-muted">Salaries Paid</h5>
                        <div class="metric-value d-inline-block">
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM employee_salaries WHERE employee_id=? AND status='Paid'");
                            $stmt->execute([$employee_id]);
                            echo '<h1 class="mb-1">' . $stmt->fetchColumn() . '</h1>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top-danger">
                    <div class="card-body">
                        <h5 class="text-muted">Support Tickets</h5>
                        <div class="metric-value d-inline-block">
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM support_messages WHERE employee_id=?");
                            $stmt->execute([$employee_id]);
                            echo '<h1 class="mb-1">' . $stmt->fetchColumn() . '</h1>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
