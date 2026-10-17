<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: mng_billInfo.php -->
<!-- Description: To create a manage bill record info panel that shows bill details and edit/delete buttons-->
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
        $billIDRef = $_GET['billID'];
        $queryA = "SELECT * FROM bill_rec_t WHERE bil_ID = '$billIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $usrID = $dataA['usr_ID'];
        $usrName = $dataA['usr_name'];
        $usrEmail = $dataA['usr_email'];
        $subtotalAmount = $dataA['sbt_amount'];
        $serviceCharge = $dataA['svc_charge'];
        $additonalCharge = $dataA['add_charge'];
        $totalAmount = $dataA['tot_amount'];
        $staffID = $dataA['stf_ID'];
        $staffName = $dataA['stf_name'];
    ?>
        <div class="mng-rec-title-div">
            <h2 class="mng-rec-title">Manage Bill - View, Edit / Delete Record</h2>
        </div>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">General Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Bill ID: </b><?php echo $billIDRef;?></p>
                    <p><b>Payer ID: </b><?php echo $usrID;?></p>
                    <p><b>Payer Name: </b><?php echo $usrName;?></p>
                    <p><b>Payer Email: </b><?php echo $usrEmail;?></p>
                </div>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Bill Item Info</h3>
            </div>
            <div class="table-info-div">
                <table class="table-info">
                    <tr class="table-info-row">
                        <th class="table-info-header">Item Name</th>
                        <th class="table-info-header">Item Desc</th>
                        <th class="table-info-header">Quantity</th>
                        <th class="table-info-header">Price</th>
                        <th class="table-info-header">Action</th>
                    </tr>
                    <?php
                        $queryB = "SELECT * FROM bill_item_list_t WHERE bil_ID = '$billIDRef';";
                        $resultsB = mysqli_query($connection, $queryB);
                        while($dataB = mysqli_fetch_assoc($resultsB)) {
                            $billItemIDRef = $dataB['bil_item_ID'];
                    ?>
                            <tr class="table-info-row">
                                <td class="table-info-data"><?php echo $dataB['item_name'];?></td>
                                <td class="table-info-data long-content"><?php echo $dataB['item_desc'];?></td>
                                <td class="table-info-data"><?php echo $dataB['item_qty'];?></td>
                                <td class="table-info-data"><?php echo $dataB['item_pri'];?></td>
                                <td class="table-info-data action-btn">
                                    <button class="editBtn" onclick="document.location='./edit_billItemRec.php?bilItemID=<?php echo $billItemIDRef;?>';" style="margin-bottom:15px;">
                                        <i class="ri-edit-2-fill"></i>
                                        Edit
                                    </button>
                                    <!-- The button will trigger a popup box to alert for deletion -->
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this bill item? Action cannot be undone.');">
                                        <input type="hidden" name="billItemIDRef" value="<?php echo $billItemIDRef; ?>">
                                        <input type="hidden" name="billID" value="<?php echo $billIDRef; ?>">                                       
                                        <button class="delBtn" type="submit" name="deleteBillItemRec">
                                            <i class="ri-delete-bin-2-fill"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <div class="mng-rec-btn-div table-rec-btn">
                <button class="editBtn" onclick="document.location='./add_billItemRec.php?billID=<?php echo $billIDRef?>';">
                    <i class="ri-add-box-fill"></i>
                    Add Item
                </button>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Amount and Staff Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Subtotal: </b><?php echo $subtotalAmount;?></p>
                    <p><b>Service charge: </b><?php echo $serviceCharge;?></p>
                    <p><b>Add-on charge: </b><?php echo $additonalCharge;?></p>
                    <p><b>Total: </b><?php echo $totalAmount;?></p>
                    <p><b>Staff ID: </b><?php echo $staffID;?></p>
                    <p><b>Staff Name: </b><?php echo $staffName;?></p>
                </div>
            </div>
            <div class="mng-rec-btn-div">
                <button class="editBtn" onclick="document.location='./edit_billRec.php?billID=<?php echo $billIDRef;?>';">
                    <i class="ri-edit-2-fill"></i>
                    Edit
                </button>
                <!-- The button will trigger a popup box to alert for deletion -->
                <button class="delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                    <i class="ri-delete-bin-2-fill"></i>
                    Delete
                </button>
                <button class="otherBtn" onclick="document.location='manageBillPaymentReceipt.php';">
                    <i class="ri-arrow-left-line"></i>
                    Back
                </button>
            </div>
        </main>

        <!--
        <div id="delPopup" class="popupBox">
            <i onclick="document.getElementById('delPopup').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Bill Item Record</h1>
                    <p>Are you sure you want to delete this bill item? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="hidden" name="billItemIDRef" id="deleteRefRec" value="">
                        <input type="button" onclick="document.getElementById('delPopup').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteBillItemRec" onclick="document.getElementById('delPopup').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>
        -->

        <div id="delPopup2" class="popupBox">
            <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form">
                <div class="popup-form-div">
                    <h1>Delete Bill Record</h1>
                    <p>Are you sure you want to delete this bill? <span>Action cannot be undone.</span></p>
                
                    <div" class="clearfix">
                        <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteBillRec" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>

    <?php include 'staff_footer.php';?>

    <?php
        if (isset($_POST['deleteBillItemRec'])) {
            include './staff_crud/deleteBillItem.php';
        }

        if (isset($_POST['deleteBillRec'])) {
            include './staff_crud/deleteBill.php';
        }
    ?>

    <!-- JavaScript for delete popup box -->
    <script src="./staff_js/deletePopUp.js"></script> 
</body>
</html>