<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM employees WHERE email = ?");
    $checkStmt->execute([$email]);
    $emailExists = $checkStmt->fetch();

    // Validations
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($emailExists) {
        $error = "This email is already registered. Try another.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Handle optional profile image
        $image = '';
        if (!empty($_FILES['profile_image']['name'])) {
            $targetDir = '../uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $image = uniqid() . '_' . basename($_FILES['profile_image']['name']);
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetDir . $image);
        }

        // Insert user
        $stmt = $conn->prepare("INSERT INTO employees (fname, lname, email, password, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $email, $hashedPassword, $image]);

        // Auto-login
        $lastId = $conn->lastInsertId();
        $_SESSION['employee_id'] = $lastId;
        $_SESSION['employee_name'] = $fname . ' ' . $lname;

        $_SESSION['success'] = "🎉 Registration successful! Welcome, $fname!";
        header("Location: ../dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .register-box {
            max-width: 600px;
            margin: auto;
            margin-top: 5%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
        }
        .form-control-feedback {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .position-relative {
            position: relative;
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
    <div class="register-box">
        <h2 class="text-center text-primary fw-bold mb-4">Employee Registration</h2>

        <?php if (!empty($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Profile Image <span class="text-muted">(Optional)</span></label>
                <input type="file" name="profile_image" class="form-control">
            </div>
            <div class="mb-3 position-relative">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="form-control-feedback" onclick="togglePassword('password', 'eyeIcon1')">
                    <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-slash-fill">
                        <path d="M10.478 10.84a3.5 3.5 0 0 1-4.318-4.318l4.318 4.318z"/>
                        <path d="M13.359 11.238a8.962 8.962 0 0 0 2.358-3.238C13.942 3.655 9.387 1 8 1c-.937 0-2.407.378-3.905 1.2L1.354.646a.5.5 0 0 0-.708.708l14 14a.5.5 0 0 0 .708-.708l-1.995-1.995z"/>
                    </svg>
                </span>
            </div>
            <div class="mb-3 position-relative">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                <span class="form-control-feedback" onclick="togglePassword('confirm_password', 'eyeIcon2')">
                    <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-slash-fill">
                        <path d="M10.478 10.84a3.5 3.5 0 0 1-4.318-4.318l4.318 4.318z"/>
                        <path d="M13.359 11.238a8.962 8.962 0 0 0 2.358-3.238C13.942 3.655 9.387 1 8 1c-.937 0-2.407.378-3.905 1.2L1.354.646a.5.5 0 0 0-.708.708l14 14a.5.5 0 0 0 .708-.708l-1.995-1.995z"/>
                    </svg>
                </span>
            </div>
            <button type="submit" class="btn btn-success w-100 mt-3">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none">Already have an account? Login</a>
        </div>
    </div>
</div>

<footer class="text-center mt-4">
    <small>&copy; <?= date("Y"); ?> Employee Management System. All rights reserved.</small>
</footer>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    }
}
</script>

</body>
</html>
