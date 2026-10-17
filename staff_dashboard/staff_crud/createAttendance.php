<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: createAttendance.php -->
<!-- Description: To add an attendance record into the database "tourlaysiadb". -->
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

    if (isset($_POST['addAttendanceRec'])) {

        $bookingID = $_POST['bookingID'];
        $attendanceDate = $_POST['attendanceDate'];
        $attendanceTitle = $_POST['attendanceTitle'];
        $attendanceDesc = $_POST['attendanceDesc'];
        $flagAdd = TRUE;

        $attdID = "ATD_" . generateID();

        $query = "INSERT INTO atd_rec_t VALUES ('$attdID', '$attendanceDate', '$bookingID', '$attendanceTitle', '$attendanceDesc');";
        $results = mysqli_query($connection, $query);

        $query2 = "SELECT * FROM book_mbr_list_t WHERE bkn_ID = '$bookingID';";
        $results2 = mysqli_query($connection, $query2);
        while ($data2 = mysqli_fetch_assoc($results2)) {
            $mbrLsID = $data2['mbr_ls_ID'];
            $mbrDocID = $data2['mbr_doc_ID'];
            $mbrName = $data2['mbr_name'];

            $attdRecID = "ATRC_" . generateID();  

            $query3 = "INSERT INTO atd_mbr_rec_t VALUES ('$attdRecID', '$attdID', '$mbrLsID', '$mbrDocID', '$mbrName', NULL, NULL);";
            $results3 = mysqli_query($connection, $query3);
            if (!$results3) {
                $flagAdd = FALSE;
            }
        }

        // Display message result
        if($results && $flagAdd) {
?>
            <script>
                alert("An attendance record has successfully been created and saved into the database. You can now mark your tour member's attendance for easy couting. Thank you for your service.");
                window.location = "Mark_attendance1.php";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The attendance record has failed to be created and saved. Please try again.");
                window.location = "Mark_attendance1.php";
            </script>   
<?php
        }   
    }      
?>