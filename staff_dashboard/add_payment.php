<?php
    session_start();
    include 'staff_header.php';
    include './staff_crud/db_connection.php';

    // Utility function to generate payment ID
    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Insert logic on form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usr_ID       = $_POST['usr_ID'] ?? '';
        $usr_name     = '';
        $bil_ID       = $_POST['bil_ID'] ?? '';
        $tot_amount   = $_POST['tot_amount'] ?? 0;
        $pd_amount    = $_POST['pd_amount'] ?? 0;
        $pyt_option   = $_POST['pyt_method'] ?? '';
        $plt_name     = $_POST['plt_name'] ?? '';
        $POP_img_name = $_POST['POP_img_name'] ?? '';
        $pyt_date     = $_POST['pyt_date'] ?? '';
        $pyt_status   = $_POST['pyt_status'] ?? '';

        // Fetch usr_name from user_account_t
        if (!empty($usr_ID)) {
            $stmt = $connection->prepare("SELECT usr_name FROM user_account_t WHERE usr_ID = ?");
            $stmt->bind_param("s", $usr_ID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $usr_name = $row['usr_name'];
            }
        }

        if ($usr_ID && $usr_name && $bil_ID && $tot_amount && $pd_amount && $pyt_option && $plt_name && $POP_img_name && $pyt_date && $pyt_status) {
            $pyt_ID = 'PYT_' . generateID(10);

            $stmt = $connection->prepare("INSERT INTO payment_rec_t 
                (pyt_ID, bil_ID, usr_ID, usr_name, tot_amount, pd_amount, pyt_option, plt_name, POP_img_name, pyt_date, pyt_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssddsssss",
                $pyt_ID, $bil_ID, $usr_ID, $usr_name, $tot_amount, $pd_amount,
                $pyt_option, $plt_name, $POP_img_name, $pyt_date, $pyt_status
            );

            if ($stmt->execute()) {
                echo "<script>alert('Payment added successfully.'); window.location.href='manageBillPaymentReceipt.php';</script>";
            } else {
                echo "<script>alert('Failed to add payment.');</script>";
            }
        } else {
            echo "<script>alert('All fields are required.');</script>";
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
    <h1>Add Payment</h1>
    <form action="" method="POST">
        <div class="form-box">
            <label for="bil_ID">Billing ID:</label>
            <input type="text" id="bil_ID" name="bil_ID" required>

            <label for="usr_ID">Payer ID:</label>
            <input type="text" id="usr_ID" name="usr_ID" required>

            <label for="tot_amount">Total Amount:</label>
            <input type="number" id="tot_amount" name="tot_amount" step="0.01" value="0.00" min="0.01" required>

            <label for="pd_amount">Paid Amount:</label>
            <input type="number" id="pd_amount" name="pd_amount" step="0.01" value="0.00" min="0.01" required>

            <label for="pyt_method">Payment Method:</label>
            <input type="text" id="pyt_method" name="pyt_method" required>

            <label for="plt_name">Platform Name:</label>
            <input type="text" id="plt_name" name="plt_name" required>

            <label for="POP_img_name">POP Image Name:</label>
            <input type="text" id="POP_img_name" name="POP_img_name" required>

            <label for="pyt_date">Payment Date:</label>
            <input type="date" id="pyt_date" name="pyt_date" required>

            <label for="pyt_status">Payment Status:</label>
            <select id="pyt_status" name="pyt_status" required>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
                <option value="Incomplete">Incomplete</option>
            </select>

            <div class="button-group">
                <button type="reset">Cancel</button>
                <button type="submit">Add Payment</button>
            </div>
        </div>
    </form>
</div>
<?php include 'staff_footer.php'; ?>
</body>
</html>




