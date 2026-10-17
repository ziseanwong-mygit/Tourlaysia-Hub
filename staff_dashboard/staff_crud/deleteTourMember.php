<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteTourMember.php -->
<!-- Description: To delete a tour member record of the selected booking from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteTourMember'])) {
        // Set variable
        $mbrListIDRef = $_POST['mbrListID'];

        $query2 = "DELETE FROM book_mbr_list_t WHERE mbr_ls_ID = '$mbrListIDRef';";
        $results2 = mysqli_query($connection, $query2);

        // Display message result
        if($results2) {
?>
            <script>
                alert("The tour member record has successfully been deleted from the database. Please go to the booking record info and view the latest changes.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingIDRef?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The tour member record has failed to be deleted. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingIDRef?>";
            </script>   
<?php
        }   
    }      
?>