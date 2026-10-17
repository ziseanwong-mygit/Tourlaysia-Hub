<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateReceipt.php -->
<!-- Description: To update a receipt record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateRcptRec'])) {
        $receiptID = $_POST['receiptID'];
        $receiptRemark = $_POST['receiptRemark'];

        $query = "UPDATE receipt_rec_t SET rcp_remark = '$receiptRemark' WHERE rcp_ID = '$receiptID';";
        $results = mysqli_query($connection, $query);   
        
        // Display message result
        if($results) {
?>
            <script>
                alert("The receipt record has successfully been updated in the database. Please go to the receipt record info and view the latest changes.");
                window.location = "mng_receiptInfo.php?rcpID=<?php echo $receiptID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The receipt record has failed to be updated. Please try again.");
                window.location = "mng_receiptInfo.php?rcpID=<?php echo $receiptID?>";
            </script>   
<?php
        }   
    }      
?>
