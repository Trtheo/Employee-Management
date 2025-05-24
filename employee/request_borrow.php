<?php
require_once 'includes/session.php';
require_once 'includes/config.php';

// Handle submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = trim($_POST['amount']);
    $reason = trim($_POST['reason']);
    $purpose = trim($_POST['purpose']);
    $duration = trim($_POST['duration']);
    $employee_id = $_SESSION['employee_id'];
    $document = '';

    // Upload file
    if (!empty($_FILES['document']['name'])) {
        $uploadDir = 'uploads/';
        $document = basename($_FILES['document']['name']);
        $uploadPath = $uploadDir . $document;
        move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath);
    }

    $stmt = $conn->prepare("INSERT INTO borrow_requests (employee_id, amount, reason, purpose, duration, document) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$employee_id, $amount, $reason, $purpose, $duration, $document]);
    $success = "✅ Borrow request submitted successfully.";
}

// Filter + Pagination
$status = $_GET['status'] ?? '';
$keyword = $_GET['keyword'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM borrow_requests WHERE employee_id = ?";
$params = [$_SESSION['employee_id']];

if (!empty($status)) {
    $query .= " AND status = ?";
    $params[] = $status;
}
if (!empty($keyword)) {
    $query .= " AND reason LIKE ?";
    $params[] = "%$keyword%";
}

$totalQuery = str_replace('SELECT *', 'SELECT COUNT(*) as total', $query);
$query .= " ORDER BY requested_on DESC LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalStmt = $conn->prepare($totalQuery);
$totalStmt->execute(array_slice($params, 0, count($params)));
$total_rows = $totalStmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);

require_once 'includes/header.php';
?>

<div class="d-flex flex-column flex-md-row">
    <?php include 'includes/sidebar.php'; ?>

    <div class="main p-4 w-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 bg-white p-4 shadow rounded">
                    <h3 class="mb-4 text-primary fw-bold text-center">Submit a Borrow Request</h3>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-success text-center"> <?= $success; ?> </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" min="1000" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Reason</label>
                                <textarea name="reason" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Purpose</label>
                                <input type="text" name="purpose" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <select name="duration" class="form-select" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="1 Month">1 Month</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="1 Year">1 Year</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Supporting Document</label>
                                <input type="file" name="document" class="form-control">
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-primary px-5">Submit Request</button>
                        </div>
                    </form>

                    <hr class="my-5">
                    <h4 class="mb-3">My Borrow History</h4>

                    <form class="row g-3 mb-3" method="GET">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control" placeholder="Search by reason..." value="<?= htmlspecialchars($keyword) ?>">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Approved" <?= $status == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Rejected" <?= $status == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        </div>
                    </form>

                    <?php if ($results): ?>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td>RWF <?= number_format($row['amount']) ?></td>
                                        <td><?= htmlspecialchars($row['reason']) ?></td>
                                        <td><?= htmlspecialchars($row['duration']) ?></td>
                                        <td><span class="badge bg-<?= $row['status'] == 'Approved' ? 'success' : ($row['status'] == 'Rejected' ? 'danger' : 'warning text-dark') ?>"><?= $row['status'] ?></span></td>
                                        <td><?= date('d M Y', strtotime($row['requested_on'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>&keyword=<?= $keyword ?>&status=<?= $status ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <div class="alert alert-info">No borrow requests found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
