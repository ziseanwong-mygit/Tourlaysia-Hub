<!-- Programmer Name: Seath Tan Ziren & Wong Zi Sean - Group Members of Peaky Blinders, AAPP011-4-2 Capstone Project
Project Name: viewBookingPage.php
Description: To create view itinerary page to allow users to view the itinerary of their trip.
Date first written: 14/6/2025
Date last modified: 13/7/2025 -->

<?php
    session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/viewBook_ItinPage.css">
</head>
<body>
    <?php
        include('./crud/db_connection.php');
        include('header.php');

        $getUserID = $_SESSION['SES_UserID'];
        $getBillID = $_GET["billID"];
        
        $query = "SELECT * FROM bill_rec_t WHERE bil_ID = '$getBillID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        $billID = $data['bil_ID'];
        $subtotal = $data['sbt_amount'];
        $serviceCh = $data['svc_charge'];
        $addCh = $data['add_charge'];
        $total = $data['tot_amount'];
        $staffName = $data['stf_name'];
    ?>
    <div class="page-wrapper">
        <div class="container">
            <h1 class="title"><?php echo $billID;?></h1>

            <h2 class="subheading">General Info</h2>
            <div class="details">
                <p><strong>Subtotal: </strong><?php echo $subtotal;?></p>
                <p><strong>Service Charge: </strong><?php echo $serviceCh;?></p>
                <p><strong>Additional Charge: </strong><?php echo $addCh;?></p>
                <p><strong>Total Amount: </strong><?php echo $total;?></p>
                <p><strong>Staff Name: </strong><?php echo $staffName;?></p>
                <button class="action-btn" onclick="document.location='payment1.php?billID=<?php echo $billID?>';" id="btnBookItin">
                    <i class="ri-bank-card-fill"></i>
                    Make Payment
                </button>
            </div>

            <h2 class="subheading">Booking Info</h2>
            <div class="details">
                <?php
                    $query2 = "SELECT * FROM bill_item_list_t WHERE bil_ID = '$billID';";
                    $results2 = mysqli_query($connection, $query2);

                    if (mysqli_num_rows($results2) == 0) {
            ?>
                    <div class="itinerary-item">
                        <p>No bill items added</p>

                    </div> 
            <?php
                    } else {
                         while ($data2 = mysqli_fetch_assoc($results2)) {
                                $itemName = $data2['item_name'];
                                $itemQty = $data2['item_qty'];
                                $itemPrice = $data2['item_pri'];
            ?>
                            <div class="itinerary-item">
                                <p><strong>Item Name: </strong> <?php echo $itemName;?></p>
                                <p><strong>Item Quantity: </strong> <?php echo $itemQty;?></p>
                                <p><strong>Item Price: </strong> <?php echo $itemPrice;?></p>
                            </div> 
            <?php
                        }
                    }
            ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>



