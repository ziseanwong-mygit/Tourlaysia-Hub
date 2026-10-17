<!-- Programmer Name: Seath Tan Ziren
Project Name: accountDashboard.php
Description: To create dashboard page to allow tourist view their dashboard.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/accountDashboard.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include './crud/info_user.php';?>

    <div class="main">
        <div class="avatar">
        <?php
            if ($profPic != NULL) {
        ?>
                <img width="120" height="150" src="./img/profile/<?php echo $profPic;?>" alt="Profile picture" class="sidebar-img loginpic" onerror="this.onerror=null; this.src='./img/anonymous.png'">
        <?php
            } else {
        ?>

                <img width="150" height="150" src="./img/anonymous.png" alt="Anonymous picture" class="sidebar-img">

        <?php
            }
        ?>
        </div>
        <div class="username"><?php echo $refName; ?></div>
        <div class="option-grid">
            <a href="myProfilePage.php" class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/1144/1144760.png" alt="">My Profile</a>
            <a href="changePasswordPage.php" class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/2889/2889676.png" alt="">Change Password</a>
            <a href="bookingHistory.php" class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/66/66163.png" alt="">Booking History</a>
            <a href="editMyProfilePage.php" class="option-button"><img src="https://cdn-icons-png.flaticon.com/512/9308/9308015.png" alt="">Edit Account</a>
            <a href="#" onclick="document.getElementById('delPopup2').style.display='block'" class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/11546/11546337.png" alt="">Delete Account</a>
            <a href="#" onclick="document.getElementById('delPopup').style.display='block'" class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/992/992680.png" alt="">Log Out</a>
        </div>
    </div>

    <div id="delPopup" class="popupBox">
        <i onclick="document.getElementById('delPopup').style.display='none'" class="ri-close-large-fill closeIcon"></i>
        <form action="" method="POST" class="popup-form" >
            <div class="popup-form-div">
                <h1>Log Out Account</h1>
                <p>Are you sure you want to log out your user account? <span>Your session will be terminated.</span></p>
            
                <div class="clearfix">
                    <input type="button" onclick="document.getElementById('delPopup').style.display='none'" class="cancelbtn" value="Cancel">
                    <input type="submit" name="logOutAccount" onclick="document.getElementById('delPopup').style.display='none'" class="deletebtn" value="Log Out">
                </div>
            </div>
        </form>
    </div>

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

    <!-- JavaScript for popup box-->
    <script src="./js/popupBox.js"></script>

    <!-- If user confirms log out -->
    <!-- If user deletes account -->
    <?php
        if(isset($_POST['logOutAccount'])) {
            include './crud/logout_account.php';
        }

        if(isset($_POST['deleteAccount'])) {
            include './crud/delete_account.php';
        }
    ?>

    <?php include 'footer.php';?>
</body>
</html>
