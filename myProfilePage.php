<!-- Programmer Name: Seath Tan Ziren
Project Name: bookingFormPage1.php
Description: To create booking form page to allow users to look at thier profile.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/myProfilePage.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include './crud/info_user.php';?>

    <div class="main">
        <div class="main-header">
            <div clas="main-title">
                <h3>Account Details</h3>
            </div>
            <div class="main-button">
                <a href="editMyProfilePage.php" class="edit-btn">Edit Profile</a>
                <a href="#" class="edit-btn delete" onclick="document.getElementById('delPopup2').style.display='block'">Delete Account</a>
            </div>
        </div>
        <div class="main-content">
            <p>
                <strong>Profile Picture:</strong><br><br>
                <?php
                    if ($profPic != NULL) {
                ?>
                        <div class="sidebar-img-div">
                            <img width="150" height="150" src="./img/profile/<?php echo $profPic;?>" alt="Profile picture" class="sidebar-img loginpic">
                        </div>
                <?php
                    } else {
                ?>
                        <div class="sidebar-img-div">
                            <img width="150" height="150" src="./img/anonymous.png" alt="Anonymous picture" class="sidebar-img">
                        </div>
                <?php
                    }
                ?>
            </p>
            <p><b>Full Name: </b> <?php echo $refName; ?> </p>
            <p><b>Email: </b> <?php echo $refEmail; ?> </p>
            <p><b>ID/IC Number: </b> <?php echo $refDocID; ?> </p>
            <p><b>Contact Number: </b> <?php echo $refTelNo; ?> </p>
            <p><b>Gender: </b> <?php echo $refGender; ?> </p>
            <p><b>Country: </b> <?php echo $refCountry; ?> </p>
            <div class="pswd-div">
                <p><b>Password:</b></p>
                <div class="pswd-container">
                    <input type="password" value="<?php echo $refpassword;?>" id="pswdField" readonly>
                    <i class="ri-eye-fill" id="showPswd"></i>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>

    <div id="delPopup2" class="popupBox">
        <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
        <form action="" method="POST" class="popup-form" >
            <div class="popup-form-div">
                <h1>Delete Account</h1>
                <p>Are you sure you want to delete your user account? <span>You will be logged out after deleting account.</span></p>
            
                <div class="clearfix">
                    <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                    <input type="submit" name="deleteAccount" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                </div>
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST['deleteAccount'])) {
            include './crud/delete_account.php';
        }
    ?>

    <script>
        // JavaScript for toggling password visibility
        const togglePassword = document.querySelector('#showPswd');

        const password = document.querySelector('#pswdField');

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
    </script>
</body>
</html>