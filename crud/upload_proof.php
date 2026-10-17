<?php
    session_start();
    require 'db_connection.php';

    $bil_ID = $_GET['billID'];

    $pyt_ID = $_SESSION['pyt_ID'];
    $usr_ID = $_SESSION['SES_UserID'];

    // Get platform from form
    $plt_name = $_POST['platform'] ?? '';

    // Handle File Upload
    $uploadDir = "../img/payment/";
    $fileName = basename($_FILES["receipt"]["name"]);
    $fileTmpName = $_FILES["receipt"]["tmp_name"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate unique filename
    $newFileName = "receipt_" . $pyt_ID . "." . $fileExtension;
    $uploadFilePath = $uploadDir . $newFileName;

    // Validate file type
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileExtension, $allowedTypes)) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Move uploaded file
    if (!move_uploaded_file($fileTmpName, $uploadFilePath)) {
        die("Failed to move uploaded file. Check folder permissions.");
    }

    // Fetch bill info to get required fields
    $bill_query = "SELECT * FROM bill_rec_t WHERE bil_ID = ?";
    $bill_stmt = mysqli_prepare($connection, $bill_query);
    mysqli_stmt_bind_param($bill_stmt, "s", $bil_ID);
    mysqli_stmt_execute($bill_stmt);
    $bill_result = mysqli_stmt_get_result($bill_stmt);

    if (!$bill = mysqli_fetch_assoc($bill_result)) {
        die("No bill found for this user.");
    }

    // Extract bill details
    $bil_ID = $bill['bil_ID'];
    $usr_name = $bill['usr_name'];
    $usr_email = $bill['usr_email'];
    $sbt_amount = $bill['sbt_amount'];
    $svc_charge = $bill['svc_charge'];
    $add_charge = $bill['add_charge'] ?? 0.00;
    $tot_amount = $bill['tot_amount'];
    $pd_amount = $tot_amount; // Assuming full payment
    $pyt_date = date('Y-m-d');
    $rcp_remark = ''; // Optional — can be set later

    // Get pyt_option from payment_rec_t
    $getPaymentQuery = "SELECT pyt_option FROM payment_rec_t WHERE pyt_ID = ?";
    $stmt = mysqli_prepare($connection, $getPaymentQuery);
    mysqli_stmt_bind_param($stmt, "s", $pyt_ID);
    mysqli_stmt_execute($stmt);
    $paymentResult = mysqli_stmt_get_result($stmt);
    $paymentData = mysqli_fetch_assoc($paymentResult);
    $pyt_option = $paymentData['pyt_option'] ?? 'Unknown';

    // Update payment_rec_t with plt_name and POP_img_name
    $updatePaymentQuery = "
        UPDATE payment_rec_t 
        SET plt_name = ?, POP_img_name = ?, pyt_status = 'Complete' 
        WHERE pyt_ID = ?";

    $stmt = mysqli_prepare($connection, $updatePaymentQuery);
    mysqli_stmt_bind_param($stmt, "sss", $plt_name, $newFileName, $pyt_ID);

    if (mysqli_stmt_execute($stmt)) {
        // Generate rcp_ID
        $rcp_ID = 'RCP_' . substr(md5(uniqid()), 0, 10);

        // Insert into receipt_rec_t
        $insertReceiptQuery = "
            INSERT INTO receipt_rec_t (
                rcp_ID, bil_ID, pyt_ID, rcp_date, usr_ID,
                usr_name, usr_email, sbt_amount, svc_charge, add_charge,
                tot_amount, pd_amount, pyt_option, plt_name, pyt_date, rcp_remark
            ) VALUES (
                ?, ?, ?, CURDATE(), ?, 
                ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?
            )";

        $stmt = mysqli_prepare($connection, $insertReceiptQuery);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssdddddssss",
            $rcp_ID,
            $bil_ID,
            $pyt_ID,
            $usr_ID,
            $usr_name,
            $usr_email,
            $sbt_amount,
            $svc_charge,
            $add_charge,
            $tot_amount,
            $pd_amount,
            $pyt_option,
            $plt_name,
            $pyt_date,
            $rcp_remark
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <title>Tourlaysia - Your Malaysia Travel Hub</title>
                <link rel='icon' type='image/png' href='../img/logo/Tourlaysia_Favicon32.png'>
                <style>
                    body { font-family: Arial, sans-serif; padding: 2rem; background-color: #f4f9fc; text-align: center; }
                    .success-box { max-width: 600px; margin: 2rem auto; padding: 2rem; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                    .pay-btn { background-color: #444; color: white; padding: 0.75rem 2rem; border: none; border-radius: 30px; cursor: pointer; font-size: 1rem; transition: all 0.3s ease; }
                    .pay-btn:hover { background-color: white; color: #444; border: 2px solid #444; }
                    img { max-width: 100%; height: auto; margin-top: 1rem; border-radius: 8px; }
                </style>
            </head>
            <body>
                <div class='success-box'>
                    <h2>Upload Successful!</h2>
                    <img src='" . $uploadFilePath . "' alt='Proof of Payment'>
                    <br><br>
                    <a href='../home_page.php'><button class='pay-btn'>Back</button></a>
                </div>
            </body>
            </html>";
        } else {
            die("Failed to insert into receipt_rec_t: " . mysqli_error($connection));
        }

    } else {
        die("Failed to update payment record: " . mysqli_error($connection));
    }
?>