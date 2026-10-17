<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_billItemRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit bill item record. Only office staffs and admins can edit bill item records.-->
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
        $billItemIDRef = $_GET['bilItemID'];
        $queryA = "SELECT * FROM bill_item_list_t WHERE bil_item_ID = '$billItemIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $billIDRef = $dataA['bil_ID'];
        $itemNameRef = $dataA['item_name'];
        $itemDescRef = $dataA['item_desc'];
        $itemQtyRef = $dataA['item_qty'];
        $itemPriceRef = $dataA['item_pri'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Bill Item Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit bill item details after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li><b>Bill Item ID</b> cannot be changed.</li>
                <li>If there are no charges, please enter <b>0.00</b> as the amount. This is used for calculation when updating data.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="billItemID">Bill Item ID:</label>
            <input type="text" id="billItemID" name="billItemID" value="<?php echo $billItemIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="billID">Bill ID:</label>
            <input type="text" id="billID" name="billID" value="<?php echo $billIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="itemName"><span>*</span> Item Name:</label>
            <input type="text" id="itemName" name="itemName" placeholder="E.g. 5D4N KL Package" value="<?php echo $itemNameRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="itemDesc">Item Description:</label>
            <textarea name="itemDesc" id="itemDesc" placeholder="E.g. This is my item description for the item above" rows="5"><?php echo $itemDescRef;?></textarea>
        </div>
        <div class="label-field-div">
            <label for="itemQty"><span>*</span> Item Quantity:</label>
            <input type="number" id="itemQty" name="itemQuantity" placeholder="E.g. 4" value="<?php echo $itemQtyRef;?>" min="1" required>
        </div>
        <div class="label-field-div">
            <label for="itemPrice"><span>*</span> Item Price:</label>
            <input type="number" id="itemPrice" name="itemPrice" placeholder="E.g. 10.00" value="<?php echo $itemPriceRef;?>" step=".01" min="0.01" required>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateBillItemRec">
                <i class="ri-save-fill"></i>
                Update Bill Item
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
        if (isset($_POST['updateBillItemRec'])) {
            include './staff_crud/updateBillItem.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>