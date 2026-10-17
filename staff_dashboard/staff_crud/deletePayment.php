<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deletePayment.php -->
<!-- Description: To delete a payment record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deletePaymentRec'])) {
        // Delete records from child tables first, then the last one should be parent table
        $query2 = "DELETE FROM payment_rec_t WHERE pyt_ID = '$paymentIDRef';";
        $results2 = mysqli_query($connection, $query2);

        // Display message result
        if($results2) {
?>
            <script>
                alert("The payment record has successfully been deleted from the database. Please go to the manage payment record page and view the latest changes.");
                window.location = "manageBillPaymentReceipt.php"; // Back to manage payment page
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The payment record has failed to be deleted. Please try again.");
                window.location = "mng_paymentInfo.php?payID=<?php echo $paymentIDRef?>";
            </script>   
<?php
        }   
    }      
?>