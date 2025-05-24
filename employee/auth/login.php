<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM employees WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['employee_id'] = $user['id'];
        $_SESSION['employee_name'] = $user['fname'] . ' ' . $user['lname'];
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-box {
            max-width: 500px;
            margin: auto;
            margin-top: 5%;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        footer {
            margin-top: auto;
            background: #f1f1f1;
            padding: 15px 0;
        }

        .form-control-feedback {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }

        .position-relative {
            position: relative;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-box">
        <h2 class="text-center mb-4 text-primary fw-bold">Employee Login</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
            </div>
            <div class="mb-3 position-relative">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                <span class="form-control-feedback" onclick="togglePassword()">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                        <path d="M10.478 10.84a3.5 3.5 0 0 1-4.318-4.318l4.318 4.318z"/>
                        <path d="M13.359 11.238a8.962 8.962 0 0 0 2.358-3.238C13.942 3.655 9.387 1 8 1c-.937 0-2.407.378-3.905 1.2L1.354.646a.5.5 0 1 0-.708.708l14 14a.5.5 0 0 0 .708-.708l-1.995-1.995zM3.098 4.463A7.011 7.011 0 0 0 .64 8c1.195 2.757 4.5 5 7.36 5 1.167 0 2.693-.513 4.098-1.537L3.098 4.463z"/>
                    </svg>
                </span>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="register.php" class="text-decoration-none">Don't have an account? Register</a><br>
            <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
        </div>
    </div>
</div>

<footer class="text-center mt-5">
    <small>&copy; <?= date("Y"); ?> Employee Management System. All rights reserved.</small>
</footer>

<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    }
}
</script>

</body>
</html>
