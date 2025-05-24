<?php
require_once 'includes/session.php';
require_once 'includes/config.php';
require_once 'includes/header.php';
?>

<div class="d-flex">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="main p-4 w-100">
        <div class="container">
            <div class="bg-white shadow p-4 rounded">
                <h3 class="mb-4 text-primary fw-bold text-center">My Borrow Request History</h3>

                <?php
                $employee_id = $_SESSION['employee_id'] ?? 0;
                $stmt = $conn->prepare("SELECT * FROM borrow_requests WHERE employee_id = ? ORDER BY requested_on DESC");
                $stmt->execute([$employee_id]);
                $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Requested On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($requests) > 0): ?>
                                <?php foreach ($requests as $index => $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $index + 1 ?></td>
                                        <td>Rs. <?= number_format($row['amount'], 2) ?></td>
                                        <td><?= htmlspecialchars($row['reason']) ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['status'] === 'Pending') {
                                                echo "<span class='badge bg-warning text-dark'>Pending</span>";
                                            } elseif ($row['status'] === 'Approved') {
                                                echo "<span class='badge bg-success'>Approved</span>";
                                            } else {
                                                echo "<span class='badge bg-danger'>Rejected</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><?= date('d M Y, h:i A', strtotime($row['requested_on'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No borrow requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
