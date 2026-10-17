<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_billRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit bill record. Only office staffs and admins can edit bills.-->
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
        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $billIDRef = $_GET['billID'];
        $queryA = "SELECT * FROM bill_rec_t WHERE bil_ID = '$billIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $userIDRef = $dataA['usr_ID'];
        $servChargeRef = $dataA['svc_charge'];
        $addChargeRef = $dataA['add_charge'];
        $staffIDRef = $dataA['stf_ID'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Bill Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit bill details after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li><b>Bill ID</b> cannot be changed.</li>
                <li>For changing payer details, please select the correct document ID to update the name and email.</li>
                <li>For changing staff details, please select the correct account ID to update the name.</li>
                <li>If there are no charges, please enter <b>0.00</b> as the amount. This is used for calculation when updating data.</li>
                <li>Total amount is auto-calculated after changing the charges.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="billID">Bill ID:</label>
            <input type="text" id="billID" name="billID" value="<?php echo $billIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="payerID"><span>*</span> Payer Record:</label>
            <select id="payerID" name="usrID" required>
                <option value="">Select a payer record</option>
                <?php
                    $queryC = "SELECT usr_ID, usr_doc_ID, usr_name FROM user_account_t WHERE usr_role = 'Tourist';";
                    $resultsC = mysqli_query($connection, $queryC);
                    while ($dataC = mysqli_fetch_assoc($resultsC)) {
                ?>
                        <option value="<?php echo $dataC['usr_ID'];?>" <?php if ($userIDRef == $dataC['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataC['usr_doc_ID'];?> - <?php echo $dataC['usr_name'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="svcCharge"><span>*</span> Service Charge:</label>
            <input type="number" id="svcCharge" name="serviceCharge" placeholder="E.g. 10.00" value="<?php echo $servChargeRef?>" step=".01" min="0.01" required>
        </div>
        <div class="label-field-div">
            <label for="addCharge"><span>*</span> Additional Charge:</label>
            <input type="number" id="addCharge" name="additionalCharge" placeholder="E.g. 10.00" value="<?php echo $addChargeRef?>" step=".01" min="0.01" required>
        </div>
        <div class="label-field-div">
            <label for="staffID"><span>*</span> Staff ID:</label>
            <select id="staffID" name="stfID" required>
                <option value="">Select a staff ID</option>
                <?php
                    $queryD = "SELECT usr_ID, usr_name FROM user_account_t WHERE usr_role = 'Office staff';";
                    $resultsD = mysqli_query($connection, $queryD);
                    while ($dataD = mysqli_fetch_assoc($resultsD)) {
                ?>
                        <option value="<?php echo $dataD['usr_ID'];?>" <?php if ($staffIDRef == $dataD['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataD['usr_ID'];?> - <?php echo $dataD['usr_name'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateBillRec">
                <i class="ri-save-fill"></i>
                Update Bill
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
        if (isset($_POST['updateBillRec'])) {
            include './staff_crud/updateBill.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>