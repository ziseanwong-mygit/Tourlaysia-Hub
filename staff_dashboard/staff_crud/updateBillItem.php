<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateBillItem.php -->
<!-- Description: To update a bill item record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateBillItemRec'])) {
        // Set variables with form values via POST method
        $billItemID = $_POST['billItemID'];
        $billID = $_POST['billID'];
        $itemName = $_POST['itemName'];
        $itemDesc = $_POST['itemDesc'];
        $itemQuantity = $_POST['itemQuantity'];
        $itemPrice = $_POST['itemPrice'];

        // Update record with new details in table
        $query = "UPDATE bill_item_list_t SET item_name = '$itemName', item_desc = '$itemDesc', item_qty = '$itemQuantity', item_pri = '$itemPrice' WHERE bil_item_ID = '$billItemID';";
        $results = mysqli_query($connection, $query);

        // Re-calculate new subtotal and update subtotal and total amount in bill_rec_t
        $query2 = "SELECT sbt_amount, tot_amount FROM bill_rec_t WHERE bil_ID = '$billID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        $old_subtotal = $data2['sbt_amount'];
        $old_total = $data2['tot_amount'];
        $new_subtotal = ($old_subtotal - $itemPriceRef) + $itemPrice;
        $new_total = ($old_total - $itemPriceRef) + $itemPrice;

        $query3 = "UPDATE bill_rec_t SET sbt_amount = '$new_subtotal', tot_amount = '$new_total' WHERE bil_ID = '$billID';";
        $results3 = mysqli_query($connection, $query3);

        // Display message result
        if($results && $results3) {
?>
            <script>
                alert("The bill item record has successfully been updated in the database. Please go to the bill record info and view the latest changes in the bill item record.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The bill item record has failed to be updated. Please try again.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>   
<?php
        }   
    }      
?>