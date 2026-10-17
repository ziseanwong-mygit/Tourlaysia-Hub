<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteBill.php -->
<!-- Description: To delete a bill record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteBillRec'])) {
        $query4 = "DELETE FROM bill_rec_t WHERE bil_ID = '$billIDRef';";
        $results4 = mysqli_query($connection, $query4);

        // Display message result
        if($results4) {
?>
            <script>
                alert("The bill record has successfully been deleted from the database. Please go to the manage bill record page and view the latest changes.");
                window.location = "manageBillPaymentReceipt.php"; // Back to manage bill page
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The bill record has failed to be deleted. Please try again.");
                window.location = "mng_billInfo.php?billID=<?php echo $billIDRef?>";
            </script>   
<?php
        }   
    }      
?>