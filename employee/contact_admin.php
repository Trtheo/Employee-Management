<?php
require_once(__DIR__ . '/includes/session.php');
require_once(__DIR__ . '/includes/config.php');

$upload_dir = 'uploads/';
$attachment_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $message_type = $_POST['message_type'];
    $emp_id = $_SESSION['employee_id'];

    // Handle file upload
    if (!empty($_FILES['attachment']['name'])) {
        $file_tmp = $_FILES['attachment']['tmp_name'];
        $file_name = basename($_FILES['attachment']['name']);
        $target_path = $upload_dir . time() . '_' . $file_name;

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $target_path)) {
            $attachment_name = $target_path;
        }
    }

    $stmt = $conn->prepare("INSERT INTO support_messages (employee_id, subject, message, message_type, attachment) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$emp_id, $subject, $message, $message_type, $attachment_name]);
    $info = "✅ Your message has been sent successfully.";
}

require_once(__DIR__ . '/includes/header.php');
?>

<div class="d-flex flex-column flex-md-row">
    <?php require_once(__DIR__ . '/includes/sidebar.php'); ?>

    <div class="main p-4 w-100">
        <div class="container-fluid">
            <div class="bg-white shadow p-4 p-md-5 rounded">
                <h3 class="mb-4 text-center text-primary fw-bold">Contact Admin</h3>

                <?php if (isset($info)) : ?>
                    <div class="alert alert-success text-center"><?= $info; ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject..." required>
                            <div class="invalid-feedback">Subject is required.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="message_type" class="form-label">Message Type</label>
                            <select name="message_type" id="message_type" class="form-select" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="Bug">Bug</option>
                                <option value="Feature">Feature</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select message type.</div>
                        </div>

                        <div class="col-md-12">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            <div class="invalid-feedback">Message is required.</div>
                        </div>

                        <div class="col-md-12">
                            <label for="attachment" class="form-label">Attachment <span class="text-muted">(Optional)</span></label>
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">Send Message</button>
                    </div>
                </form>
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

<?php require_once(__DIR__ . '/includes/footer.php'); ?>
