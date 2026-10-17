<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: addCommentFeedback.php -->
<!-- Description: To add comment into the selected feedback in the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['addCommentFbk'])) {
        $staffComment = $_POST['staffComment'];

        $query = "UPDATE user_feedback_t SET stf_comt = '$staffComment' WHERE fbk_ID = '$fbkIDRef';";
        $results = mysqli_query($connection, $query);   
        
        // Display message result
        if($results) {
?>
            <script>
                alert("Your comment on the tourist feedback has been successfully saved. Please go to the feedback record and view the latest comment. Thank you.");
                window.location = "manageFeedback.php";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! Your comment on the tourist feedback has been failed to save. Please try again.");
                window.location = "manageFeedback.php";
            </script>   
<?php
        }   
    }      
?>
