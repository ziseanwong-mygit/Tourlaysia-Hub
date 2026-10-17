<!-- Programmer Name: Seath Tan Ziren
Project Name: chnagePasswordPage.php
Description: To create change passoword page to allow users to change their account password.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/edit_profile_change_pswd.css">
</head>
<body>
    <?php include 'header.php';?>
    
    <div class="change-password-form">
        <h3>Change Password</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div>
                    <label for="password"><span>* </span> Current Password</label>
                    <input type="password" id="" name="currentPassword" minlength="8" maxlength="15" required>
                </div>
                <div>
                    <label for="password"><span>* </span> New Password</label>
                    <input type="password" id="" name="newPassword" minlength="8" maxlength="15" required>
                </div>
                <div>
                    <label for="confirm password"><span>* </span> Confirm New Password</label>
                    <input type="password" id="" name="confirmNewPassword" minlength="8" maxlength="15" required>
                </div>
                <div class="form-btn">
                    <button type="button" class="form-btn-back" onclick="location.href='accountDashboard.php';">Back</button>
                    <button type="submit" class="form-btn-save" name="changePassword">Save</button>
                </div>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST['changePassword'])) {
            include './crud/change_password.php';
        }
    ?>
    <?php include 'footer.php';?>
</body>
</html>