<?php
    function generateID($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
?>


<?php
    include 'db_connection.php'; // Include the database connection

    if (isset($_POST['registerAcc'])) {
        $role = 'Tourist';
        $status = 'Approved';
        $docType = $_POST['userDocument'];
        $docID = $_POST['touristDocID'];
        $fullName = $_POST['touristFullname'];
        $email = $_POST['touristEmail'];
        $telNo = $_POST['touristContactNumber'];
        $gender = $_POST['touristGender'];
        $country = $_POST['touristCountry'];
        $filename = $_FILES["touristProfImg"]["name"];
        $pswd = $_POST['touristPassword'];
        $confPswd = $_POST['touristConfirmPassword'];
        $flagRegister = FALSE;
        $flagRegister2 = FALSE;

        // Check if account exists or not
        $query2 = "SELECT * FROM user_account_t WHERE usr_email = '$email';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        //acc doesnt exist
        if (empty($data2)) {
            $flagRegister2 = TRUE;   
        
        //acc exist
        } else {
            $flagRegister2 = FALSE; 
        }

        // Validation
        if (!$flagRegister2) {
?>
            <script>
                alert("This account has already been registered. Please use another email.");
            </script>
<?php
        } else if (!(str_contains($email, "@")) || !(str_ends_with($email, ".com"))) {
?>
            <script>
                alert("Your email address must contain both '@' and '.com' characters. Please fill in the correct details again!");
            </script>
<?php
        } else if ((preg_match("/[a-z]/i", $telNo)) || (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $telNo))) {
            
?>
            <script>
                alert("Your phone number must contain numbers only. Please fill in the correct details again!");
            </script>           
<?php
        } else if (!((preg_match('~[0-9]+~', $pswd))) || !((preg_match('/[\'^£!.$%&*()}{@#~?><>,|=_+¬-]/', $pswd))) || 
        !((preg_match('/[A-Z]/i', $pswd))) || !((preg_match('/[a-z]/i', $pswd)))) {
                    
?>
            <script>
                alert("Your password does not meet the requirements. Please re-enter a new password!");
            </script>                        
<?php
        //matching password and confirm password
        } else if ($pswd != $confPswd) {
?>
                        
            <script>
                alert("Your password does not match with confirm password. Please re-enter your password again!");
            </script> 
<?php
        //different password and confirm password
        } else {
            $flagRegister = TRUE;
        }

        // acc doesnt exist and matching password and confirm password 
        if ($flagRegister && $flagRegister2) {
            $newID = "TOR_" . generateID();

            // If user uploaded an image
            if($filename != NULL) {
                // Upload image to folder
                $tempname = $_FILES["touristProfImg"]["tmp_name"];
                $folder = "../img/profile/" . $filename;
                move_uploaded_file($tempname, $folder);
            } else {
                $filename = NULL;
            }

            $query = "INSERT INTO user_account_t (usr_ID, usr_role, usr_doc_ID, usr_name, usr_email, usr_no_tel, usr_gender, usr_country, usr_prof_pic, usr_pswd, usr_status) VALUES ('$newID', '$role', '$docID', '$fullName', '$email', '$telNo', '$gender', '$country', '$filename', '$pswd', '$status');";
            $results = mysqli_query($connection, $query);

            if ($results) {
?>
                <script>
                    alert("You have successfully registered a tourist account. Your details are saved in the database.");
                    if(confirm("Do you wish to log in your account?") == true) {
                        window.location = "touristLoginPage.php";
                    } else {
                        window.location = "../index.php";
                    }
                </script>
<?php
            } else {
?>                
                <script>
                    alert("Sorry! Your account registration has failed, which your account data is not saved in the database. Please try again!");
                    window.location="registerTouristPage.php";
                </script>
<?php            
            }
        }
    }