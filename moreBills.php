<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: moreBills.php -->
<!-- Description: To create a webpage for displaying the tour bookings using cards in grid layout-->
<!-- Date first written: 14/7/2025 -->
<!-- Date last modified: 14/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/package_results.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'nav_bar.php';?>

    <?php
        include './crud/db_connection.php'; // Connect database
        $usrID = $_SESSION['SES_UserID'];
    ?>

    <div class="results-title-div">
        <div class="results-title-desc">
            <h1 class="results-title">Your Bills</h1>
            <h4 class="results-desc">Here are all of the bills made by the staff for you to make payment!</h4>
        </div>
    </div>

    <main class="pkg-grid-container">
        <?php
            $query2 = "SELECT * FROM bill_rec_t WHERE usr_ID = '$usrID';";
            $results2 = mysqli_query($connection, $query2);
            while($data2 = mysqli_fetch_assoc($results2)) {
                $billID = $data2['bil_ID'];
                $subtotal = $data2['sbt_amount'];
                $serviceCh = $data2['svc_charge'];
                $addCh = $data2['add_charge'];
                $total = $data2['tot_amount'];
                $staffName = $data2['stf_name'];
        ?>
                <div class="pkg-grid-card"> 
                    <div class="pkg-title-div">   
                        <a href="#" class="pkg-title"><?php echo $billID;?></a>
                    </div>
                    <?php
                        $query5 = "SELECT * FROM bill_item_list_t WHERE bil_ID = '$billID';";
                        $results5 = mysqli_query($connection, $query5);
                        if (mysqli_num_rows($results5) == 0) {
                    ?>
                            <div class="pkg-desc-div">
                                <p class="pkg-desc">No bill items</p>
                            </div>
                    <?php
                        } else {
                             while($data5 = mysqli_fetch_assoc($results5)) {
                                $itemName = $data5['item_name'];
                                $itemQty = $data5['item_qty'];
                                $itemPrice = $data5['item_pri'];
                    ?>
                                <div class="pkg-info-div">
                                    <p class="pkg-info"><b class="pkg-label">Item Name: </b><?php echo $itemName;?></p>
                                    <p class="pkg-info"><b class="pkg-label">Item Qty: </b><?php echo $itemQty;?></p>
                                    <p class="pkg-info"><b class="pkg-label">Item Price: </b><?php echo $itemPrice;?></p>
                                </div>
                    <?php
                             }
                        }
                    ?>    
                    <div class="pkg-info-div">
                        <p class="pkg-info"><b class="pkg-label">Subtotal: </b><?php echo $subtotal;?></p>
                        <p class="pkg-info"><b class="pkg-label">Service: </b><?php echo $serviceCh;?></p>
                        <p class="pkg-info"><b class="pkg-label">Additional: </b><?php echo $addCh;?></p>
                        <p class="pkg-info"><b class="pkg-label">Total: </b><?php echo $total;?></p>
                    </div>
                    <div class="pkg-btn-div">
                        <button class="pkg-act-btn" onclick="document.location='#';" id="btnView">
                            <i class="ri-eye-fill"></i>
                            View info
                        </button>
                        <button class="pkg-act-btn" onclick="document.location='payment1.php?billID=<?php echo $billID?>';" id="btnView">
                            <i class="ri-eye-fill"></i>
                            Make payment
                        </button>                   
                    </div>
                </div>
        <?php
            }
        ?>
    </main>
    <?php include 'footer.php';?>
</body>
</html>