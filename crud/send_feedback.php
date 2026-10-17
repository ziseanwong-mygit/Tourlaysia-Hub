<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: send_feedback.php -->
<!-- Description: To allow users to submit feedback and store it in database for staff comment.-->
<!-- Date first written: 8/7/2025 -->
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

    if (isset($_POST['feedbackSend'])) {
        $feedbackContent = $_POST['feedbackContent'];

        // Generate feedback ID
        $fbkID = "FBK_" . generateID();
        $fbkDate = date("Y-m-d");

        $query = "INSERT INTO user_feedback_t (fbk_ID, fbk_date, usr_ID, usr_name, usr_email, fbk_sel, fbk_content) VALUES ('$fbkID', '$fbkDate', '$refUserID', '$name', '$email', 'Quick feedback', '$feedbackContent');";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("Your feedback has been submitted. Please wait for a few days for the staff to comment if needed. Thank youf for your response");
                window.location = "./home_page.php";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! Your feedback could not be submitted. Please try again.");
                window.location = "./home_page.php";
            </script>   
<?php
        }   
    }      
?>