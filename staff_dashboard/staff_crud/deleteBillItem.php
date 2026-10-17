<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteBillItem.php -->
<!-- Description: To delete a bill item record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteBillItemRec'])) {
        // Set variable
        $billItemIDRef = $_POST['billItemIDRef'];
        $billID = $_POST['billID'];

        $query4 = "SELECT item_pri, item_qty FROM bill_item_list_t WHERE bil_item_ID = '$billItemIDRef';";
        $results4 = mysqli_query($connection, $query4);
        $data4 = mysqli_fetch_assoc($results4);
        $itemPrice = $data4['item_pri'];
        $itemQuantity = $data4['item_qty'];

        // Re-calculate new subtotal and update subtotal and total amount in bill_rec_t
        $query2 = "SELECT sbt_amount, tot_amount FROM bill_rec_t WHERE bil_ID = '$billID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        $old_subtotal = $data2['sbt_amount'];
        $old_total = $data2['tot_amount'];
        $newItemPrice = $itemPrice * $itemQuantity;
        $new_subtotal = $old_subtotal - $newItemPrice;
        $new_total = $old_total - $newItemPrice;

        $query3 = "UPDATE bill_rec_t SET sbt_amount = '$new_subtotal', tot_amount = '$new_total' WHERE bil_ID = '$billID';";
        $results3 = mysqli_query($connection, $query3);

        // Delete records from child tables first, then the last one should be parent table
        $query = "DELETE FROM bill_item_list_t WHERE bil_item_ID = '$billItemIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results && $results3) {
?>
            <script>
                alert("The bill item record has successfully been deleted from the database. Please go to the bill record info and view the latest changes.");
                window.location = "mng_billInfo.php?billID=<?php echo $billIDRef?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The bill item record has failed to be deleted. Please try again.");
                window.location = "mng_billInfo.php?billID=<?php echo $billIDRef?>";
            </script>   
<?php
        }   
    }      
?>