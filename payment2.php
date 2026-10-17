<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: payment2.php -->
<!-- Description: Provide a payment gateway for tourist to finish their booking -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 2/7/2025 -->


<?php
    require './crud/db_connection.php';

    $bil_ID = $_GET['billID'];

    // Get selected payment method
    $method = $_GET['method'] ?? 'Unknown';
    $pyt_ID = $_SESSION['pyt_ID'] ?? 'N/A';

    // Fetch bill record
    $query = "SELECT * FROM bill_rec_t WHERE bil_ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $bil_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($bill = mysqli_fetch_assoc($result)) {
        // Successfully found bill
    } else {
        die("No bill found for this user.");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="styles/styles_payment2.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php';?>
    <header>
        <!-- Back Icon -->
        <a href="payment1.php?billID=<?php echo $bil_ID;?>">
        <i class="ri-arrow-left-line back-icon"></i>
        </a>
    </header>
    <main class="payment-container">
        <section class="payment-wrapper">
        <div class="payment-left">
            <h2>Upload Proof of Payment</h2>
            <p><strong>Selected Method:</strong> <?= $method ?></p>

            <form action="./crud/upload_proof.php?billID=<?php echo $bil_ID?>" method="POST" enctype="multipart/form-data">
                <!-- Dropdown for platform -->
                <label for="platform">Select Payment Platform:</label>
                <select name="platform" id="platform" required>
                    <?php
                    // Define platforms dynamically
                    switch ($method) {
                        case 'Debit Card':
                            $options = ['Maybank Debit', 'Public Bank Debit', 'CIMB Bank Debit'];
                            break;
                        case 'Credit Card':
                            $options = ['Visa', 'MasterCard', 'American Express'];
                            break;
                        case 'E-wallet':
                            $options = ['Touch n Go', 'GrabPay', 'ShopeePay', 'PayPal', 'Wise'];
                            break;
                        case 'Online Banking':
                            $options = ['Maybank Online', 'CIMB Clicks', 'Public Bank Internet Banking'];
                            break;
                        default:
                            $options = [];
                    }

                    foreach ($options as $option) {
                        echo "<option value=\"$option\">$option</option>";
                    }
                    ?>
                </select>
                <br>
                <!-- Image upload -->
                <label for="receipt">Upload Proof of Payment:</label>
                <input type="file" name="receipt" accept="image/*" required>

                <button type="submit" class="pay-btn">Submit Proof</button>
            </form>
        </div>

        <!-- RIGHT SIDE: Summary -->
        <aside class="summary-box">
            <h2>Summary</h2>
            <ul>
            <li><span>Subtotal</span><span>MYR <?= number_format($bill['sbt_amount'], 2) ?></span></li>
            <li><span>Service Charge</span><span>MYR <?= number_format($bill['svc_charge'], 2) ?></span></li>
            <li><span>Additional Charges</span><span>MYR <?= number_format($bill['add_charge'], 2) ?></span></li>
            </ul>
            <div class="total"><strong>Total Amount</strong> <span>MYR <?= number_format($bill['tot_amount'], 2) ?></span></div>
        </aside>
        </section>
    </main>
    <?php include 'footer.php';?>
</body>
</html>
