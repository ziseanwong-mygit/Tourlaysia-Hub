<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: payment1.php -->
<!-- Description: Provide a payment gateway for tourist to finish their booking -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 2/7/2025 -->
 
<?php
    require './crud/db_connection.php';

    $bil_ID = $_GET['billID'];

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="styles/styles_payment.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php'?>
    <header>
        <!-- Back Icon -->
        <a href="Staff_Dashboard.php">
        <i class="ri-arrow-left-line back-icon"></i>
        </a>
    </header>
    <main class="payment-container">
        <section class="payment-wrapper">
            <div class="payment-left"> 
                <h1>Make Payment Part 1</h1>       
                <h3>Choose Payment Method</h3>
                <form action="./crud/process_payment.php?billID=<?php echo $bil_ID;?>" method="POST">
                    <div class="payment-methods" id="method-section">
                        <!-- Payment method options -->
                        <label class="method-option">
                            <input type="radio" name="method" value="Debit Card" required>
                            <div class="method-content"><span>Debit Card</span></div>
                        </label><hr>

                        <label class="method-option">
                            <input type="radio" name="method" value="Credit Card">
                            <div class="method-content"><span>Credit Card</span></div>
                        </label><hr>

                        <label class="method-option">
                            <input type="radio" name="method" value="E-wallet">
                            <div class="method-content"><span>E-wallet</span></div>
                        </label><hr>

                        <label class="method-option">
                            <input type="radio" name="method" value="Online Banking">
                            <div class="method-content"><span>Online Banking</span></div>
                        </label>
                    </div>

                    <button type="submit" id="proceed-btn" class="proceed-btn">Proceed</button>
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
  
    <?php
        include 'footer.php';
    ?>

  <script>
        function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = 'PYT_';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
        }
  </script>
</body>
</html>
