<!-- Programmer Name: Seath Tan Ziren
Project Name: loginPage.php
Description: To create login page to allow users login to their account.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   --> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/x-icon" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/loginPage.css">
</head>
<body>
    <?php include 'header.php';?>

    <div class="banner">
        <img src="./img/Tourlaysia_Banner.png" alt="Tourlaysia_banner">
        <div class="banner-slogan">
            <h1>Welcome to Tourlaysia - Gateway to My Journey</h1>
        </div>
    </div>

    <div class="main">
        <div class="image-placeholder">
            <img src="./img/logo/Tourlaysia_Alt_Logo.png" alt="Tourlaysia_Logo">
        </div>
        <div class="login-form">
            <h2>Welcome to Tourlaysia</h2>
            <small>Log in with Email and Pswd</small>

            <div class="instruction-box">
                <h4>Instructions:</h4>
                <ol>
                    <li style="color: red;">* Required field</li>
                    <li>This is a page for tourists to log in the <b>tourist</b> account by entering the email and password of account.</li>
                </ol>
            </div>

            <form action="" method="POST">
                <div class="form-grid">
                    <div>
                        <label for="email"><span>* </span>Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password"><span>* </span>Password</label>
                        <input type="password" id="password" name="password" minlength="8" maxlength="20" required>
                    </div>
                </div>
                <div class="forgot">
                    <a href="forgotPasswordPage1.php">Forgot Password</a>
                    <a href="staffLoginPage.php">Login as Staff</a>
                </div>
                <button type="submit" class="login-btn" name="loginAcc">Login</button>
                <button type="reset" class="login-btn erase" name="eraseInput">Erase Fields</button>
                <button type="button" onclick="history.back();" class="login-btn backBtn" name="backPage">Back</button>
            </form>
        </div>
    </div>

    <?php
        if (isset($_POST['loginAcc'])) {
            include './crud/login.php';
        }
    ?>

    <?php include 'footer.php';?>
</body>
</html>