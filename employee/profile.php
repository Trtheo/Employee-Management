<?php
require_once('includes/session.php');
require_once('includes/config.php');

$emp_id = $_SESSION['employee_id'];

// Fetch current employee info
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$emp_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $image = $_POST['old_image'];

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'assets/img/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imgName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imgName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $imgName;
        }
    }

    $stmt = $conn->prepare("UPDATE employees SET fname=?, lname=?, contact=?, address=?, image=? WHERE id=?");
    $stmt->execute([$fname, $lname, $contact, $address, $image, $emp_id]);
    $success = "Profile updated successfully!";

    // Refresh data
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->execute([$emp_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once('includes/header.php');
require_once('includes/sidebar.php');
?>

<div class="main p-4 w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-white p-4 shadow rounded">
                <h3 class="mb-4 text-primary fw-bold text-center">My Profile</h3>

                <?php if (!empty($success)) : ?>
                    <div class="alert alert-success text-center"><?= $success; ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($user['image']); ?>">

                    <div class="row align-items-center mb-4">
                        <div class="col-md-3 text-center">
                            <?php if (!empty($user['image']) && file_exists("assets/img/{$user['image']}")): ?>
                                <img src="assets/img/<?= htmlspecialchars($user['image']) ?>" alt="Profile Photo" class="rounded-circle" width="120" height="120">
                            <?php else: ?>
                                <img src="assets/img/default-avatar.png" alt="No Avatar" class="rounded-circle" width="120" height="120">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label">Change Profile Photo</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                   <div class="row">
    <div class="col-md-6 mb-3">
        <label>Email Address</label>
        <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($user['email']); ?>" readonly>
    </div>
    <div class="col-md-6 mb-3">
        <label>First Name</label>
        <input type="text" name="fname" class="form-control" value="<?= htmlspecialchars($user['fname']); ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Last Name</label>
        <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($user['lname']); ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Contact</label>
        <input type="text" name="contact" class="form-control" value="<?= htmlspecialchars($user['contact']); ?>">
    </div>
    <div class="col-md-12 mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control"><?= htmlspecialchars($user['address']); ?></textarea>
    </div>
</div>


                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
