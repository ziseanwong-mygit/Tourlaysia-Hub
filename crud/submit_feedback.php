<?php
    session_start();
?> 

<?php
include 'db_connection.php';

// Set the user ID for testing purposes
$getUserID = $_SESSION['SES_UserID'];

// Function to generate a random ID
function generateID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString; // Return the random string without prefix
}

// Function to generate Feedback ID
function generateFeedbackID() {
    return "FBK_" . generateID(); // Generates unique FBK ID
}

$feedbackID = generateFeedbackID();
$feedbackType = $_POST['feedbackType'];
$feedbackDescription = $_POST['feedbackContent'];
$feedbackDate = date("Y-m-d");

include 'info_user.php';


$query = "INSERT INTO user_feedback_t (fbk_ID, fbk_date, usr_ID, usr_name, usr_email, fbk_sel, fbk_content, stf_comt) VALUES ('$feedbackID', '$feedbackDate', '$getUserID', '$refName', '$refEmail', '$feedbackType', '$feedbackDescription', Null);";
$results = mysqli_query($connection, $query);

if ($results) {
?>
    <script>
        alert("You have successfully added your feedback. Your feedback details are saved in the database.");
        window.location = "../home_page.php";
    </script>
<?php
} else {
?>                
    <script>
        alert("Sorry! Your attempt to give feedback has failed; not saving any data in database. Please try again!");
    </script>
<?php            
}

