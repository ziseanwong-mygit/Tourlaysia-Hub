<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: createBookMember.php -->
<!-- Description: To add a booking tour member record into the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

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

    if (isset($_POST['addTourMemberRec'])) {
        // Set variables for details from add_bookMemberRec.php
        $bookingID = $_POST['bookingID'];
        $memberDocID = $_POST['memberDocID'];
        $memberName = $_POST['memberName'];

        // Select and update the sequential number for new tour member record
        $query = "SELECT MAX(mbr_seqNo) AS HighestNo FROM book_mbr_list_t WHERE bkn_ID = '$bookingID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        $highestSeqNo = $data['HighestNo'];
        $newSeqNo = $highestSeqNo + 1;

        // Generate booking tour member list ID
        $mbrLsID = "BMBR_" . generateID();

        $query2 = "INSERT INTO book_mbr_list_t VALUES ('$mbrLsID', '$bookingID', '$memberDocID', '$memberName', '$newSeqNo');";
        $results2 = mysqli_query($connection, $query2);

        // Display message result
        if($results2) {
?>
            <script>
                alert("A booking tour member record has successfully been created and saved into the database. Please go to the booking record info and view the latest member record.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The booking tour member record has failed to be created and saved. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>   
<?php
        }   
    }      
?>