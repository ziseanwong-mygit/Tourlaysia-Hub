<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: mng_paymentInfo.php -->
<!-- Description: To create a manage payment record info panel that shows payment details and delete button. Only admins can view and delete payment records.-->
<!-- Date first written: 11/7/2025 -->
<!-- Date last modified: 11/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/mng_recInfo.css">
</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $paymentIDRef = $_GET['payID'];
        $queryA = "SELECT * FROM payment_rec_t WHERE pyt_ID = '$paymentIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $billID = $dataA['bil_ID'];
        $usrID = $dataA['usr_ID'];
        $usrName = $dataA['usr_name'];
        $totalAmount = $dataA['tot_amount'];
        $paidAmount = $dataA['pd_amount'];
        $paymentOption = $dataA['pyt_option'];
        $platformName = $dataA['plt_name'];
        $paymentDate = $dataA['pyt_date'];
        $paymentStatus = $dataA['pyt_status'];
    ?>
        <div class="mng-rec-title-div">
            <h2 class="mng-rec-title2">Manage Payment - View / Delete Record</h2>
        </div>
        <div class="mng-rec-desc-div">
            <p class="mng-rec-desc">Proof of purchase image is not displayed for security reasons.</p>
        </div>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">General Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Payment ID: </b><?php echo $paymentIDRef;?></p>
                    <p><b>Payment Date: </b><?php echo $paymentDate;?></p>
                    <p><b>Bill ID: </b><?php echo $billID;?></p>
                    <p><b>Payer ID: </b><?php echo $usrID;?></p>
                    <p><b>Payer Name: </b><?php echo $usrName;?></p>
                </div>
            </div>
        </main>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Payment Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Total Amount: </b><?php echo $totalAmount;?></p>
                    <p><b>Paid Amount: </b><?php echo $paidAmount;?></p>
                    <p><b>Payment Option: </b><?php echo $paymentOption;?></p>
                    <p><b>Platform Name: </b><?php echo $platformName;?></p>
                    <p><b>Payment Status: </b><?php echo $paymentStatus;?></p>
                </div>
            </div>
            <div class="mng-rec-btn-div">
                <!-- The button will trigger a popup box to alert for deletion -->
                <button class="delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                    <i class="ri-delete-bin-2-fill"></i>
                    Delete
                </button>
            </div>
        </main>

        <div id="delPopup2" class="popupBox">
            <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Payment Record</h1>
                    <p>Are you sure you want to delete this payment record? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deletePaymentRec" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>
    <?php include 'staff_footer.php';?>

    <?php
        if (isset($_POST['deletePaymentRec'])) {
            include './staff_crud/deletePayment.php';
        }
    ?>

    <!-- JavaScript for delete popup box -->
    <script src="./staff_js/deletePopUp.js"></script> 
</body>
</html>