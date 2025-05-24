<?php
require_once 'includes/session.php';
require_once 'includes/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$leave_id = (int)$_GET['id'];
$emp_id = $_SESSION['employee_id'];

// Fetch leave details
$stmt = $conn->prepare("SELECT * FROM employee_leaves WHERE id = ? AND employee_id = ?");
$stmt->execute([$leave_id, $emp_id]);
$leave = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$leave) {
    die("Leave not found or unauthorized.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = trim($_POST['leave_type']);
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $reason = trim($_POST['reason']);

    $update = $conn->prepare("UPDATE employee_leaves SET leave_type = ?, from_date = ?, to_date = ?, reason = ?, status = 'Pending' WHERE id = ? AND employee_id = ?");
    $update->execute([$type, $from, $to, $reason, $leave_id, $emp_id]);

    $success = "✅ Leave request updated successfully and status reset to Pending.";
    // Refresh data
    $leave['leave_type'] = $type;
    $leave['from_date'] = $from;
    $leave['to_date'] = $to;
    $leave['reason'] = $reason;
}

require_once 'includes/header.php';
?>

<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="main p-4 w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 bg-white p-4 shadow rounded">
                    <h3 class="mb-4 text-primary text-center fw-bold">Edit Leave Request</h3>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-success text-center"><?= $success; ?></div>
                    <?php endif; ?>

                    <form method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <input type="text" name="leave_type" id="leave_type" class="form-control" value="<?= htmlspecialchars($leave['leave_type']) ?>" required>
                            <div class="invalid-feedback">Please enter leave type.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_date" class="form-label">From Date</label>
                                <input type="date" name="from_date" id="from_date" class="form-control" value="<?= $leave['from_date'] ?>" required>
                                <div class="invalid-feedback">Please select a from date.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control" value="<?= $leave['to_date'] ?>" required>
                                <div class="invalid-feedback">Please select a to date.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="reason" id="reason" class="form-control" rows="4" required><?= htmlspecialchars($leave['reason']) ?></textarea>
                            <div class="invalid-feedback">Please enter a reason.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        forms.forEach(form => {
            form.addEventListener('submit', e => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<?php require_once 'includes/footer.php'; ?>
