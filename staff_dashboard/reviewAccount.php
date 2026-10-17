<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: reviewAccount.php -->
<!-- Description: To create a form that allows staffs and admins to confirm/reject/cancel bookings made by tourists. Only office staffs and admins can confirm/reject/cancel bookings-->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/add_edit_recInfo.css">
</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $userIDRef = $_GET['userID'];
        $queryA = "SELECT * FROM user_account_t WHERE usr_ID = '$userIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $userRole = $dataA['usr_role'];
        $userDocID = $dataA['usr_doc_ID'];
        $userName = $dataA['usr_name'];
        $userEmail = $dataA['usr_email'];
        $userNoTel = $dataA['usr_no_tel'];
        $userGender = $dataA['usr_gender'];
        $userProfPic = $dataA['usr_prof_pic'];
        $userCountry = $dataA['usr_country'];
        $userJobPosition = $dataA['usr_job_pos'];
        $userDepartment = $dataA['usr_dep'];
        $userPassword = $dataA['usr_pswd'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Review Account Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides admins to approve/reject accounts made by staffs for the selected package. Only admins can review.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>Please select a status to <b>approve / reject</b> the account. You can change the status again after the review.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="accID">Account ID:</label>
            <input type="text" id="accID" name="usrID" value="<?php echo $userIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="accRole">Account Role:</label>
            <input type="text" id="accRole" name="usrRole" value="<?php echo $userRole?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="docID">Document ID:</label>
            <input type="text" id="docID" name="usrDocID" value="<?php echo $userDocID?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="accName">Full Name:</label>
            <input type="text" id="accName" name="usrName" value="<?php echo $userName?>" readonly>
        </div>      
        <div class="label-field-div">
            <label for="accEmail">Email Address:</label>
            <input type="text" id="accEmail" name="usrEmail" value="<?php echo $userEmail?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="accNoTel">Phone Number:</label>
            <input type="text" id="accNoTel" name="usrNoTel" value="<?php echo $userNoTel?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="accGender">Gender:</label>
            <input type="text" id="accGender" name="usrGender" value="<?php echo $userGender?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="accCountry">Country:</label>
            <input type="text" id="accCountry" name="usrCountry" value="<?php echo $userCountry?>" readonly>
        </div>
        <?php
            if($userRole != "Tourist") {
        ?>
            <div class="label-field-div">
                <label for="accJobPos">Job Position:</label>
                <input type="text" id="accJobPos" name="usrJobPos" value="<?php echo $userJobPosition?>" readonly>
            </div> 
            <div class="label-field-div">
                <label for="accDepart">Department:</label>
                <input type="text" id="accDepart" name="usrDepart" value="<?php echo $userDepartment?>" readonly>
            </div>           
        <?php
            }
        ?>
        <div class="label-field-div">
            <label for="pswd">Password:</label>
            <div class="pswd-container">
                <input type="password" id="pswd" name="usrPswd" value="<?php echo $userPassword;?>" readonly>
                <i class="ri-eye-fill eye1" id="showPswd"></i>
            </div>
        </div>
        <div class="label-field-div">
            <label for="status"><span>*</span> Status:</label>
            <select id="status" name="accountStatus" required>
                <option value="" >Select a status</option>
                <option value="Approved">Approved</option>
                <option value="Pending">Pending</option>
                <option value="Rejected">Rejected</option>
            </select>          
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateAccStatus">
                <i class="ri-save-fill"></i>
                Update Account Status
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Erase Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['updateAccStatus'])) {
            include './staff_crud/updateAccStatus.php';
        }
    ?>

    <?php include 'staff_footer.php';?>

    <!-- JavaScript to toggle password visibility -->
    <script>
        const togglePassword = document.querySelector('#showPswd');
        const password = document.querySelector('#pswd');
        const toggleConfPassword = document.querySelector('#showConfPswd');
        const confpassword = document.querySelector('#confPswd');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute 
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye slash icon 
            if (togglePassword.classList.contains('ri-eye-fill')) {
                togglePassword.classList.remove('ri-eye-fill');
                togglePassword.classList.add('ri-eye-off-fill');
            } else {
                togglePassword.classList.remove('ri-eye-off-fill');
                togglePassword.classList.add('ri-eye-fill');
            }
        }); 

        toggleConfPassword.addEventListener('click', function (e) {
            // Toggle the type attribute 
            const type = confpassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confpassword.setAttribute('type', type);

            // Toggle the eye slash icon 
            if (toggleConfPassword.classList.contains('ri-eye-fill')) {
                toggleConfPassword.classList.remove('ri-eye-fill');
                toggleConfPassword.classList.add('ri-eye-off-fill');
            } else {
                toggleConfPassword.classList.remove('ri-eye-off-fill');
                toggleConfPassword.classList.add('ri-eye-fill');
            }
        });
    </script>
</body>
</html>