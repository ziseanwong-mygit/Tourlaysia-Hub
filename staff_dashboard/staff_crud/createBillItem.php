<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: createBillItem.php -->
<!-- Description: To add a bill item record into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    if (isset($_POST['addBillItemRec'])) {
        // Set variables for details from add_billItemRec.php
        $billID = $_POST['billID'];
        $itemName = $_POST['itemName'];
        $itemDesc = $_POST['itemDesc'];
        $itemQuantity = $_POST['itemQuantity'];
        $itemPrice = $_POST['itemPrice'];

        // Generate bill item record ID
        $billItemID = "BITM_" . generateID();

        // Insert new record into table
        $query = "INSERT INTO bill_item_list_t VALUES ('$billItemID', '$billID', '$itemName', '$itemDesc', '$itemQuantity', '$itemPrice');";
        $results = mysqli_query($connection, $query);

        // Re-calculate new subtotal and update subtotal and total amount in bill_rec_t
        $query2 = "SELECT sbt_amount, tot_amount FROM bill_rec_t WHERE bil_ID = '$billID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        $old_subtotal = $data2['sbt_amount'];
        $old_total = $data2['tot_amount'];
        $newItemPrice = $itemPrice * $itemQuantity;
        $new_subtotal = $old_subtotal + $newItemPrice;
        $new_total = $old_total + $newItemPrice;

        $query3 = "UPDATE bill_rec_t SET sbt_amount = '$new_subtotal', tot_amount = '$new_total' WHERE bil_ID = '$billID';";
        $results3 = mysqli_query($connection, $query3);

        // Display message result
        if($results && $results3) {
?>
            <script>
                alert("A bill item record has successfully been created and saved into the database. Please go to the bill record info and view the latest bill item record.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The bill item record has failed to be created and saved. Please try again.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>   
<?php
        }   
    }      
?>