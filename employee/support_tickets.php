<?php
require_once(__DIR__ . '/includes/session.php');
require_once(__DIR__ . '/includes/config.php');
require_once(__DIR__ . '/includes/header.php');
?>

<div class="d-flex">
    <?php require_once(__DIR__ . '/includes/sidebar.php'); ?>

    <div class="main p-4 w-100">
        <div class="container">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="mb-4 text-primary fw-bold text-center">My Support Tickets</h3>

                <?php
                $employee_id = $_SESSION['employee_id'];
                $stmt = $conn->prepare("SELECT * FROM support_messages WHERE employee_id = ? ORDER BY sent_on DESC");
                $stmt->execute([$employee_id]);
                $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php if (count($tickets) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Reply</th>
                                    <th>Status</th>
                                    <th>Sent On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets as $index => $ticket): ?>
                                    <tr>
                                        <td class="text-center"><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($ticket['subject']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($ticket['message'])) ?></td>
                                        <td>
                                            <?= $ticket['reply'] 
                                                ? '<span class="text-success">' . nl2br(htmlspecialchars($ticket['reply'])) . '</span>' 
                                                : '<span class="text-muted">No reply yet</span>'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                $status = $ticket['status'];
                                                echo match ($status) {
                                                    'Open' => '<span class="badge bg-warning text-dark">Open</span>',
                                                    'Replied' => '<span class="badge bg-info text-white">Replied</span>',
                                                    'Closed' => '<span class="badge bg-secondary">Closed</span>',
                                                    default => '<span class="badge bg-light text-dark">Unknown</span>'
                                                };
                                            ?>
                                        </td>
                                        <td class="text-center"><?= date('d M Y, h:i A', strtotime($ticket['sent_on'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center mb-0">
                        You have not submitted any support tickets yet.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>
