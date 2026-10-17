<?php
    include 'staff_header.php';
    include './staff_crud/db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Generate bill ID manually (no custom function)
        $bil_ID = 'BIL_' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

        $usr_ID     = $_POST['usr_ID'] ?? '';
        $usr_name   = $_POST['usr_name'] ?? '';
        $usr_email  = $_POST['usr_email'] ?? '';
        $sbt_amount = floatval($_POST['sbt_amount'] ?? 0);
        $svc_charge = floatval($_POST['svc_charge'] ?? 0);
        $add_charge = floatval($_POST['add_charge'] ?? 0);
        $stf_ID     = $_POST['stf_ID'] ?? '';
        $stf_name   = $_POST['stf_name'] ?? '';

        $tot_amount = $sbt_amount + $svc_charge + $add_charge;

        if ($usr_ID && $usr_name && $usr_email && $stf_ID && $stf_name) {
            $query = "INSERT INTO bill_rec_t 
                (bil_ID, usr_ID, usr_name, usr_email, sbt_amount, svc_charge, add_charge, tot_amount, stf_ID, stf_name) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $connection->prepare($query);
            $stmt->bind_param(
                "ssssddddss",
                $bil_ID,
                $usr_ID,
                $usr_name,
                $usr_email,
                $sbt_amount,
                $svc_charge,
                $add_charge,
                $tot_amount,
                $stf_ID,
                $stf_name
            );

            if ($stmt->execute()) {
                echo "<script>alert('Bill record added successfully.'); window.location.href='manageBillPaymentReceipt.php';</script>";
                exit;
            } else {
                echo "<script>alert('Failed to add bill record: " . $stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Please fill in all required fields.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/add_bill_payment_invoice.css">
</head>
<body>

<div class="container">
    <button onclick="window.location.href='manageBillPaymentReceipt.php'" class="back-btn">← Back</button>
    <h1>Add Bill Form</h1>

    <form method="POST" action="">
        <div class="form-box">
            <label for="usr_ID">User ID:</label>
            <input type="text" id="usr_ID" name="usr_ID" required>

            <label for="usr_name">Username:</label>
            <input type="text" id="usr_name" name="usr_name" required>

            <label for="usr_email">User Email Address:</label>
            <input type="text" id="usr_email" name="usr_email" required>

            <label for="sbt_amount">Subtotal Amount:</label>
            <input type="number" id="sbt_amount" name="sbt_amount" step="0.01" value="0" min="0.01" required>

            <label for="svc_charge">Service Charge:</label>
            <input type="number" id="svc_charge" name="svc_charge" step="0.01"  value="0" min="0.01" required>

            <label for="add_charge">Additional Charge:</label>
            <input type="number" id="add_charge" name="add_charge" step="0.01" value="0" min="0.01">

            <label for="stf_ID">Staff ID:</label>
            <input type="text" id="stf_ID" name="stf_ID" required>

            <label for="stf_name">Staff Name:</label>
            <input type="text" id="stf_name" name="stf_name" required>

            <div class="button-group">
                <button type="reset">Cancel</button>
                <button type="submit">Add Bill Record</button>
            </div>
        </div>
    </form>
</div>

<?php include 'staff_footer.php'; ?>
</body>
</html>