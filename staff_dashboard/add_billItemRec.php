<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: add_billItemRec.php -->
<!-- Description: To create a form that allows staffs and admins to add a bill item record in the selected bill. Only office staffs and admins can add bill items.-->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

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
        $billIDRef = $_GET['billID'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Add Bill Item Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to add a bill item record in the selected bill. Only office staffs and admins can add.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li><b>Bill Item ID</b> is auto-generared after form submission.</li>
                <li><b>Bill ID</b> cannot be changed.</li>
                <li>Item descripton can be <b>optionally</b> added.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="billID">Bill ID:</label>
            <input type="text" id="billID" name="billID" value="<?php echo $billIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="itemName"><span>*</span> Item Name:</label>
            <input type="text" id="itemName" name="itemName" placeholder="E.g. 5D4N KL Package" required>
        </div>
        <div class="label-field-div">
            <label for="itemDesc">Item Description:</label>
            <textarea name="itemDesc" id="itemDesc" placeholder="E.g. This is my item description for the item above" rows="5"></textarea>
        </div>
        <div class="label-field-div">
            <label for="itemQty"><span>*</span> Item Quantity:</label>
            <input type="number" id="itemQty" name="itemQuantity" placeholder="E.g. 4" min="1" required>
        </div>
        <div class="label-field-div">
            <label for="itemPrice"><span>*</span> Item Price:</label>
            <input type="number" id="itemPrice" name="itemPrice" placeholder="E.g. 10.00" step=".01" min="0.01" required>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="addBillItemRec">
                <i class="ri-add-fill"></i>
                Add Bill Item
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Erase Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['addBillItemRec'])) {
            include './staff_crud/createBillItem.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>