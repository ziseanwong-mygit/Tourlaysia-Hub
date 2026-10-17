<?php
    session_start(); // Start session
?>

<?php
    include 'db_connection.php'; // Include the database connection

    if (isset($_POST['loginAcc']) || isset($_POST['loginStaffAcc'])) {
        $email = $_POST['email'];
        $pswd = $_POST['password'];

        $query = "SELECT usr_ID, usr_status FROM user_account_t WHERE usr_email = '$email' AND usr_pswd = '$pswd';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        //acc doesnt exist
        if(empty($data)) {
?>
            <script>
                alert("Sorry! You have failed to log in the account because the account cannot be found in the database.");
                if(confirm("Do you want to register a new account?") == true) {
                    window.location = "./registerTouristPage.php";
                } else {
                    window.location = "./touristLoginPage.php";
                }
            </script>
<?php
        //acc exist
        } else {
            // If account is approved
            if ($data['usr_status'] == "Approved") {
                $_SESSION['SES_UserID'] = $data['usr_ID']; // create session variable
            } else { // otherwise show message
?>
                <script>
                    alert("Sorry! Your account has not been approved by the admin. This means you cannot access fully to our system. This message is normally displayed to staff members, whereas tourist accounts are automatically approved. Please wait for the admin's approval. Thank you.");
                    window.location="./index.php";
                </script>
<?php
            }
        }
    }

    if (isset($_SESSION['SES_UserID'])) {

        // Example: assuming user ID is already stored in session
        $userID = $_SESSION['SES_UserID']; // e.g. TOR_0000000000

        // Extract the prefix from the user ID (first 3 characters)
        $prefix = substr($userID, 0, 3);

        // Route user based on their prefix
        if ($prefix === 'TOR') {
    ?> 
            <script>            
                alert("You have successfully logged in your tourist account. You will now be redirected to home page.");
                window.location = "./home_page.php";
            </script>
    <?php               
        } elseif (in_array($prefix, ['ADM', 'DRV', 'STF', 'GUD'])) {
    ?> 
            <script>            
                alert("You have successfully logged in your staff account. You will now be redirected to your staff dashboard.");
                window.location = "./staff_dashboard/Staff_Dashboard.php"; // Staff dashboard
            </script>
    <?php               
        }
    }


   


