<?php
    session_start();
    require 'db_connection.php';

    $bil_ID = $_GET['billID'];

    // Fetch bill record
    $bill_query = "SELECT * FROM bill_rec_t WHERE bil_ID = ?";
    $bill_stmt = mysqli_prepare($connection, $bill_query);    
    mysqli_stmt_bind_param($bill_stmt, "s", $bil_ID);
    mysqli_stmt_execute($bill_stmt);
    $bill_result = mysqli_stmt_get_result($bill_stmt);

    if ($bill = mysqli_fetch_assoc($bill_result)) {
        // Successfully found bill
    } else {
        die("No bill found for this user.");
    }

    // Get selected payment method from form
    if (empty($_POST['method'])) {
        die("Please select a payment method.");
    }
    $pyt_option = $_POST['method']; // e.g., Debit Card, E-wallet

    // Function to generate random payment ID
    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = 'PYT_';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    // Generate unique payment ID
    $pyt_ID = generateID(10); // PYT_ABCDEFGHIJ
    $bil_ID = $bill['bil_ID'];
    $usr_ID = $_SESSION['SES_UserID'];
    $usr_name = $bill['usr_name'];
    $tot_amount = $bill['tot_amount'];
    $pd_amount = $bill['tot_amount']; // Assume full payment
    $pyt_date = date('Y-m-d');
    $pyt_status = 'Pending';
    $plt_name = '';       // Will be set in payment2.php
    $POP_img_name = '';   // Will be updated after upload

    // Map method to plt_name (optional – used later in payment2.php)
    switch ($pyt_option) {
        case 'Debit Card':
            $plt_name = 'Maybank Debit'; // Default value
            break;
        case 'Credit Card':
            $plt_name = 'Visa/MasterCard';
            break;
        case 'E-wallet':
            $plt_name = 'Touch n Go';
            break;
        case 'Online Banking':
            $plt_name = 'Maybank Online';
            break;
        default:
            $plt_name = 'Other';
    }

    // Insert into payment_rec_t
    $insert_query = "
        INSERT INTO payment_rec_t (
            pyt_ID, bil_ID, usr_ID, usr_name, tot_amount, pd_amount,
            pyt_option, plt_name, POP_img_name, pyt_date, pyt_status
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, '', ?, ?
        )
    ";

    $stmt = mysqli_prepare($connection, $insert_query);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssddssss",
        $pyt_ID,
        $bil_ID,
        $usr_ID,
        $usr_name,
        $tot_amount,
        $pd_amount,
        $pyt_option,
        $plt_name,
        $pyt_date,
        $pyt_status
    );

    if (mysqli_stmt_execute($stmt)) {
        // Save payment ID in session for next step
        $_SESSION['pyt_ID'] = $pyt_ID;

        // Redirect to payment2.php with selected method
        header("Location: ../payment2.php?billID=$bil_ID&method=" . urlencode($pyt_option));
        exit();
    } else {
        die("Failed to save payment record: " . mysqli_error($connection));
    }
?>