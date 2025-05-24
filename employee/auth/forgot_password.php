<?php
include('../includes/config.php');
$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $newPassword = trim($_POST['new_password']);

    $stmt = $conn->prepare("SELECT id FROM employees WHERE email = ?");
    $stmt->execute([$email]);
    $employee = $stmt->fetch();

    if ($employee) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE employees SET password = ? WHERE email = ?");
        $update->execute([$hashedPassword, $email]);
        $success = "✅ Password reset successful. Redirecting to login...";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);
        </script>";
    } else {
        $error = "❌ Email not found in our system.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Employee Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .reset-box {
            max-width: 500px;
            margin: auto;
            margin-top: 6%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }
        footer {
            margin-top: auto;
            background: #f1f1f1;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="reset-box">
        <h3 class="text-center text-primary fw-bold mb-4">Reset Your Password</h3>

        <?php if ($success): ?>
            <div class="alert alert-success text-center"><?= $success; ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger text-center"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="you@example.com">
                <div class="invalid-feedback">Please enter your email.</div>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" onclick="togglePassword()" id="showPass">
                    <label class="form-check-label" for="showPass">Show Password</label>
                </div>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="login.php" class="text-decoration-none">🔙 Back to Login</a>
        </div>
    </div>
</div>

<footer class="text-center mt-4">
    <small>&copy; <?= date('Y'); ?> Employee Management System. All rights reserved.</small>
</footer>

<script>
function togglePassword() {
    const passInput = document.getElementById("new_password");
    passInput.type = passInput.type === "password" ? "text" : "password";
}

// Bootstrap validation
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

</body>
</html>
