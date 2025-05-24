<?php
include('includes/session.php');
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_id = $_SESSION['emp_id'];
    $current = $_POST['current_password'];
    $new = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT password FROM employees WHERE id = ?");
    $stmt->execute([$emp_id]);
    $user = $stmt->fetch();

    if ($user && password_verify($current, $user['password'])) {
        $stmt = $conn->prepare("UPDATE employees SET password = ? WHERE id = ?");
        $stmt->execute([$new, $emp_id]);
        $success = "✅ Password changed successfully.";
    } else {
        $error = "❌ Incorrect current password.";
    }
}

include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 shadow rounded">
            <h3 class="text-center mb-4 text-primary fw-bold">Change Password</h3>

            <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form method="post" class="needs-validation" novalidate>
                <div class="mb-3 position-relative">
                    <label>Current Password:</label>
                    <div class="input-group">
                        <input type="password" name="current_password" id="currentPassword" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('currentPassword')">👁</button>
                    </div>
                </div>

                <div class="mb-3 position-relative">
                    <label>New Password:</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="newPassword" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('newPassword')">👁</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Change Password</button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

<?php include('includes/footer.php'); ?>
