<?php
require_once 'includes/session.php';
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    die("Salary record not found.");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employee_salaries WHERE id = ? AND employee_id = ?");
$stmt->execute([$id, $_SESSION['employee_id']]);
$salary = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$salary) {
    die("Unauthorized access or salary not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Salary Slip</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .salary-slip {
            background: #fff;
            padding: 40px;
            max-width: 720px;
            margin: 60px auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .salary-slip h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        table th {
            width: 35%;
            background-color: #f1f1f1;
        }

        table th, table td {
            padding: 12px;
            vertical-align: middle;
            font-size: 16px;
        }

        .print-btn {
            text-align: center;
            margin-top: 30px;
        }

        @media print {
            .print-btn {
                display: none;
            }

            body {
                background: white;
            }

            .salary-slip {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="salary-slip">
    <h2>Employee Salary Slip</h2>
    <table class="table table-bordered">
        <tr>
            <th>Month</th>
            <td><?= htmlspecialchars($salary['month']) ?></td>
        </tr>
        <tr>
            <th>Year</th>
            <td><?= htmlspecialchars($salary['year']) ?></td>
        </tr>
        <tr>
            <th>Base Salary</th>
            <td>Rs. <?= number_format($salary['base_salary'], 2) ?></td>
        </tr>
        <tr>
            <th>Paid Amount</th>
            <td>Rs. <?= number_format($salary['paid_amount'], 2) ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= htmlspecialchars($salary['status']) ?></td>
        </tr>
        <tr>
            <th>Paid On</th>
            <td><?= date('d M Y', strtotime($salary['paid_on'])) ?></td>
        </tr>
    </table>

    <div class="print-btn">
        <button class="btn btn-primary px-4" onclick="window.print()">🖨️ Print</button>
    </div>
</div>

</body>
</html>
