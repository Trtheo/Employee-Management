<?php
require_once(__DIR__ . '/includes/session.php');
require_once(__DIR__ . '/includes/config.php');

$emp_id = $_SESSION['employee_id'];
$stmt = $conn->prepare("SELECT * FROM employee_salaries WHERE employee_id = ? ORDER BY id DESC");
$stmt->execute([$emp_id]);
$salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once(__DIR__ . '/includes/header.php');
?>

<div class="d-flex">
    <?php require_once(__DIR__ . '/includes/sidebar.php'); ?>

    <div class="main p-4 w-100">
        <div class="container">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="mb-4 text-primary fw-bold text-center">Salary Records</h3>

                <?php if (count($salaries) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Base Salary</th>
                                    <th>Paid Amount</th>
                                    <th>Status</th>
                                    <th>Paid On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($salaries as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($row['month']) ?></td>
                                        <td><?= htmlspecialchars($row['year']) ?></td>
                                        <td>RWF <?= number_format($row['base_salary'], 2) ?></td>
                                        <td>RWF <?= number_format($row['paid_amount'], 2) ?></td>
                                        <td>
                                            <?php if (strtolower($row['status']) === 'paid'): ?>
                                                <span class="badge bg-success">Paid</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d M Y', strtotime($row['paid_on'])) ?></td>
                                        <td>
                                            <a href="print_salary.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                Print
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center mb-0">No salary records found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>
