<?php
    session_start();
?>

<?php
    include 'db_connection.php'; // Include the database connection

    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    function isValidMalaysianIC($ic) {
        // Remove dashes for uniformity
        $ic = str_replace('-', '', $ic);

        // Must be exactly 12 digits
        if (!preg_match('/^\d{12}$/', $ic)) {
            return false;
        }

        // Extract birth date
        $yy = substr($ic, 0, 2);
        $mm = substr($ic, 2, 2);
        $dd = substr($ic, 4, 2);

        //get current year (4 digits)
        $currentYear = (int)date('Y');

        //get the last two digit of year
        if ($yy >= 0 && $yy <= ($currentYear % 100)) {
            $fullYear = 2000 + (int)$yy;
        } else {
            $fullYear = 1900 + (int)$yy;
        }

        //check if date is valid
        if (!checkdate((int)$mm, (int)$dd, $fullYear)) {
            return false;
        }
        return true;
    }

    function isValidPassport($passport) {
        // Remove spaces and convert to uppercase
        $passport = strtoupper(str_replace(' ', '', $passport));

        // General rule: 6 to 9 alphanumeric characters
        if (preg_match('/^[A-Z0-9]{6,9}$/', $passport)) {
            return true;
        }
        return false;
}
?>

<?php
    $role = $_POST['role'];
    $docID = $_POST['ic_passport'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $telNo = $_POST['contactNumber'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $filename = $_FILES["profImg"]["name"];
    $pswd = $_POST['password'];
    $confPswd = $_POST['confirmPassword'];
    $approved = "Approved";
    $flagRegister = FALSE;
    $flagRegister2 = FALSE;
    if ($_POST['role'] == 'Tourist') {
        $docType = $_POST['userDocument'];
        if ($docType == "Malaysian IC"){
            $valid = isValidMalaysianIC($docID);
        } else if ($docType == "Passport") {
            $valid = isValidPassport($docID);
        } else {
            $valid = TRUE; 
        }
    }else if ($_POST['role'] == 'Office staff' || $_POST['role'] == 'Bus driver' || $_POST['role'] == 'Tour guide') {
        $department = $_POST['department'];
        $jobPosition = $_POST['jobPosition'];
        $valid = isValidMalaysianIC($docID);
    } else {
        echo "<script>alert('Please select a valid role.');</script>";
        exit;
    }


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
        //different password and confirm password
        } else if ($pswd != $confPswd) {
?>      
            <script>
                alert("Your password does not match with confirm password. Please re-enter your password again!");
            </script> 
<?php  
        } else if (!$valid) {
?>      
            <script>
                alert("Your IC Number is invalid. Please re-enter your IC Number again!");
            </script> 
<?php  
        } else {
            $flagRegister = TRUE;
        }

        // acc doesnt exist and matching password and confirm password 
        if ($flagRegister && $flagRegister2) {
            if ($_POST['role'] == 'Tourist') {
                $newID = "TOR_" . generateID();
            }       
            if ($_POST['role'] == 'Bus driver') {
                $newID = "DRV_" . generateID();
            }       
            if ($_POST['role'] == 'Office staff') {
                $newID = "STF_" . generateID();
            }       
            if ($_POST['role'] == 'Tour guide') {
                $newID = "GUD_" . generateID();
            }       

            // If user uploaded an image
            if($filename != NULL) {
                // Upload image to folder
                $tempname = $_FILES["profImg"]["tmp_name"];
                $folder = "img/user/" . $filename;
                move_uploaded_file($tempname, $folder);
            } else {
                $filename = NULL;
            }

            if ($_POST['role'] == 'Tourist') {
                $query = "INSERT INTO user_account_t (usr_ID, usr_role, usr_doc_ID, usr_name, usr_email, usr_no_tel, usr_gender, usr_country, usr_prof_pic, usr_pswd, usr_job_pos, usr_dep, usr_status) VALUES ('$newID', '$role', '$docID', '$fullName', '$email', 
                '$telNo', '$gender', '$country', '$filename', '$pswd', Null, Null, '$approved');";
                $results = mysqli_query($connection, $query);            
            } else if ($_POST['role'] == 'Bus driver' || $_POST['role'] == 'Office staff' || $_POST['role'] == 'Tour guide') {
                $query = "INSERT INTO user_account_t (usr_ID, usr_role, usr_doc_ID, usr_name, usr_email, usr_no_tel, usr_gender, usr_country, usr_prof_pic, usr_job_pos, usr_dep, usr_pswd, usr_status) 
                VALUES ('$newID', '$role', '$docID', '$fullName', '$email', '$telNo', '$gender', '$country', '$filename', '$jobPosition', '$department', '$pswd', '$approved');";
                $results = mysqli_query($connection, $query);    
            }

            if ($results) {
                // If the query was successful, redirect or show a success message
?>
                <script>
                    alert("You have added a account. The account details are saved in the database.");
                        window.location = "../manageUser.php";
                </script>
<?php
            } else {
?>                
                <script>
                    alert("Sorry! Your account registration has failed; not saving any data in database. Please try again!");
                </script>
<?php            
            }
        }
?>