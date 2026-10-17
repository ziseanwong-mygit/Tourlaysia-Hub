<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteReceipt.php -->
<!-- Description: To delete a receipt record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteReceiptRec'])) {
        // Delete records from child tables first, then the last one should be parent table
        $query = "DELETE FROM receipt_rec_t WHERE rcp_ID = '$receiptIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The receipt record has successfully been deleted from the database. Please go to the manage receipt record page and view the latest changes.");
                window.location = "manageBillPaymentReceipt.php"; // Back to manage receipt page
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The receipt record has failed to be deleted. Please try again.");
                window.location = "mng_receiptInfo.php?rcpID=<?php echo $receiptIDRef?>";
            </script>   
<?php
        }   
    }      
?>