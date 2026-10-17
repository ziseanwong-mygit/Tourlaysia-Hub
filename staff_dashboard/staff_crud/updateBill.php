<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateBill.php -->
<!-- Description: To update a bill record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateBillRec'])) {
        // Set variables with form values via POST method
        $billID = $_POST['billID'];
        $usrID = $_POST['usrID'];
        $serviceCharge = $_POST['serviceCharge'];
        $additionalCharge = $_POST['additionalCharge'];
        $stfID = $_POST['stfID'];

        // Retrieve payer name and email based on account ID
        $query = "SELECT usr_name, usr_email FROM user_account_t WHERE usr_ID = '$usrID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        // Set variables for the payer name and email
        $usrName = $data['usr_name'];
        $usrEmail = $data['usr_email'];

        // Retrieve staff name based on staff ID
        $query3 = "SELECT usr_name FROM user_account_t WHERE usr_ID = '$stfID';";
        $results3 = mysqli_query($connection, $query3);
        $data3 = mysqli_fetch_assoc($results3);
        $stfName = $data3['usr_name'];

        // Re-calculate the total amount for the bill
        $query2 = "SELECT svc_charge, add_charge, tot_amount FROM bill_rec_t WHERE bil_ID = '$billID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);  
        
        $oldSvcCharge = $data2['svc_charge'];
        $oldAddCharge = $data2['add_charge'];
        $old_total = $data2['tot_amount'];
        $new_total = ($old_total - $oldSvcCharge - $oldAddCharge) + $serviceCharge + $additionalCharge;

        // Update record with new details in table
        $query4 = "UPDATE bill_rec_t SET usr_ID = '$usrID', usr_name = '$usrName', usr_email = '$usrEmail', svc_charge = '$serviceCharge', add_charge = '$additionalCharge', tot_amount = '$new_total', stf_ID = '$stfID', stf_name = '$stfName' WHERE bil_ID = '$billID';";
        $results4 = mysqli_query($connection, $query4);
        
        // Display message result
        if($results4) {
?>
            <script>
                alert("The bill record has successfully been updated in the database. Please go to the bill record info and view the latest changes.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The bill record has failed to be updated. Please try again.");
                window.location = "mng_billInfo.php?billID=<?php echo $billID?>";
            </script>   
<?php
        }   
    }      
?>