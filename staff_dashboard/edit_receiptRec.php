<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_reciptRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit receipt record. Only office staffs and admins can edit receipts.-->
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
    <link rel="stylesheet" href="./staff_styles/add_edit_recInfo.css">
</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        $rcpIDRef = $_GET['rcpID'];

        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $queryA = "SELECT rcp_remark FROM receipt_rec_t WHERE rcp_ID = '$rcpIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $rcptRemarkRef = $dataA['rcp_remark'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Receipt Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit <b>receipt remark only</b> after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li><b>Receipt ID, Bill ID, Payment ID and User ID</b> cannot be changed.</li>
                <li>Receipt remarks can only be edited by office staffs and admins. If there are wrong details in the receipt, please create a new receipt record.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="rcptID">Receipt ID:</label>
            <input type="text" id="rcptID" name="receiptID" value="<?php echo $rcpIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="rcptRemark">Receipt Remarks:</label>
            <textarea name="receiptRemark" id="rcptRemark" placeholder="E.g. This receipt is generated on 10/7/2025. No signature is required." rows="5"><?php echo $rcptRemarkRef;?></textarea>
        </div>         
        <div class="form-buttons-div">
            <button type="submit" name="updateRcptRec">
                <i class="ri-save-fill"></i>
                Update Receipt
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Reset to Old Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['updateRcptRec'])) {
            include './staff_crud/updateReceipt.php';
        }
    ?>
    
    <?php include 'staff_footer.php';?>
</body>
</html>