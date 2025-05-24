<?php
require_once 'includes/session.php';
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $type = $_POST['leave_type'];
    $reason = $_POST['reason'];
    $emp_id = $_SESSION['employee_id'];

    $stmt = $conn->prepare("INSERT INTO employee_leaves (employee_id, leave_type, reason, from_date, to_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$emp_id, $type, $reason, $from, $to]);
    $message = "✅ Your leave request has been submitted!";
}

require_once 'includes/header.php';
?>

<div class="d-flex flex-column flex-md-row">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="main p-3 p-md-4 w-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 bg-white p-4 p-md-5 shadow rounded">
                    <h3 class="mb-4 text-primary fw-bold text-center">Apply for Leave</h3>

                    <?php if (isset($message)): ?>
                        <div class="alert alert-success text-center"><?= $message; ?></div>
                    <?php endif; ?>

                    <form method="post" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="leave_type" class="form-label">Leave Type <span class="text-danger">*</span></label>
                                <select id="leave_type" name="leave_type" class="form-select" required>
                                    <option value="" disabled selected>Select leave type</option>
                                    <option value="Annual Leave">Annual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Paternity Leave">Paternity Leave</option>
                                    <option value="Emergency Leave">Emergency Leave</option>
                                </select>
                                <div class="invalid-feedback">Please select a leave type.</div>
                            </div>

                            <div class="col-md-3">
                                <label for="from_date" class="form-label">From Date <span class="text-danger">*</span></label>
                                <input type="date" id="from_date" name="from_date" class="form-control" required>
                                <div class="invalid-feedback">Start date is required.</div>
                            </div>

                            <div class="col-md-3">
                                <label for="to_date" class="form-label">To Date <span class="text-danger">*</span></label>
                                <input type="date" id="to_date" name="to_date" class="form-control" required>
                                <div class="invalid-feedback">End date is required.</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Explain your reason..." required></textarea>
                            <div class="invalid-feedback">Please enter the reason for your leave.</div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2">Submit Leave Request</button>
                        </div>
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
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

<?php require_once 'includes/footer.php'; ?>
