<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateBookMember.php -->
<!-- Description: To update a booking member record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateTourMember'])) {
        // Set variables with form values via POST method
        $memberListID = $_POST['memberListID'];
        $bookingID = $_POST['bookingID'];
        $memberDocID = $_POST['memberDocID'];
        $memberName = $_POST['memberName'];

        // Update record with new details in table
        $query = "UPDATE book_mbr_list_t SET mbr_doc_ID = '$memberDocID', mbr_name = '$memberName' WHERE mbr_ls_ID = '$memberListID';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The booking tour member record has successfully been updated in the database. Please go to the booking record info and view the latest changes in the booking member list.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The booking tour member record has failed to be updated. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>   
<?php
        }   
    }      
?>