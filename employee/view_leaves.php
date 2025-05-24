<?php
require_once 'includes/session.php';
require_once 'includes/config.php';
require_once 'includes/header.php';

// Initialize filters
$employee_id = $_SESSION['employee_id'];
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';
$status = $_GET['status'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Build query dynamically
$query = "SELECT * FROM employee_leaves WHERE employee_id = ?";
$params = [$employee_id];

if (!empty($from_date)) {
    $query .= " AND from_date >= ?";
    $params[] = $from_date;
}
if (!empty($to_date)) {
    $query .= " AND to_date <= ?";
    $params[] = $to_date;
}
if (!empty($status)) {
    $query .= " AND status = ?";
    $params[] = $status;
}

$query .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$leaves = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total for pagination
$countStmt = $conn->prepare(str_replace('SELECT *', 'SELECT COUNT(*) as total', $query));
$countStmt->execute($params);
$total_rows = $countStmt->fetch()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<div class="d-flex">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="main p-4 w-100">
        <div class="container">
            <h3 class="mb-4">My Leave Applications</h3>

            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label>From Date</label>
                    <input type="date" name="from_date" value="<?= htmlspecialchars($from_date) ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>To Date</label>
                    <input type="date" name="to_date" value="<?= htmlspecialchars($to_date) ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Approved" <?= $status == 'Approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="Rejected" <?= $status == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <?php if (count($leaves) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leaves as $leave): ?>
                                <tr>
                                    <td><?= htmlspecialchars($leave['leave_type']) ?></td>
                                    <td><?= htmlspecialchars($leave['from_date']) ?></td>
                                    <td><?= htmlspecialchars($leave['to_date']) ?></td>
                                    <td><?= htmlspecialchars($leave['reason']) ?></td>
                                    <td>
                                        <?php
                                            $s = $leave['status'];
                                            if ($s == 'Approved') echo '<span class="badge bg-success">Approved</span>';
                                            elseif ($s == 'Rejected') echo '<span class="badge bg-danger">Rejected</span>';
                                            else echo '<span class="badge bg-warning text-dark">Pending</span>';
                                        ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($leave['applied_on'])) ?></td>
                                    <td>
                                        <a href="edit_leave.php?id=<?= $leave['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="delete_leave.php?id=<?= $leave['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="mt-3">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&from_date=<?= $from_date ?>&to_date=<?= $to_date ?>&status=<?= $status ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <div class="alert alert-info text-center">No leave applications found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
