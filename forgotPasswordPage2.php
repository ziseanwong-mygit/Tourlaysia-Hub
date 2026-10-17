<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: forgotPasswordPage2.php -->
<!-- Description: This page provides a form for users to reset their password -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
include('./crud/db_connection.php');
include('header.php');

$error = '';
$status = '';
$doc_ID = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['doc_ID'], $_POST['email'])) {
    $doc_ID = $_POST['doc_ID'];
    $email = $_POST['email'];
} else {
    header("Location: forgotPasswordPage1.php");
    exit;
}

if (isset($_POST['resetPassword'])) {
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmNewPassword']);

    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (strlen($newPassword) < 8 || strlen($newPassword) > 15) {
        $error = "Password must be 8–15 characters.";
    } else {
        $updateQuery = "UPDATE user_account_t SET usr_pswd = ? WHERE usr_doc_ID = ? AND usr_email = ?";
        $stmt = mysqli_prepare($connection, $updateQuery);
        mysqli_stmt_bind_param($stmt, "sss", $newPassword, $doc_ID, $email);
        mysqli_stmt_execute($stmt);

        $status = "Success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/forgotPasswordPage.css">
</head>
<body>

<div class="change-password-form">
    <h3>Reset Your Password Form</h3>
    <?php if (!empty($error)){ ?>
        <p style="color:red; text-align:center;"><?= $error ?></p>
    <?php 
        } elseif (!empty($status)) {
            if ($status == "Success") {
            ?>
                    <script>
                        alert("You have successfully changed your password for your account. You can now log in to your account with your new password.");
                        window.location="touristLoginPage.php";
                    </script>
        <?php
            } else {
        ?>
                    <script>
                        alert("You have failed to change your password for your account. Please try again.");
                        window.location="forgotPasswordPage1.php";
                    </script>
    <?php
            }
        }
    ?>

    <form action="" method="POST">
        <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($doc_ID) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

        <div class="form-grid">
            <div>
                <h5>Please enter your new password and confirm password to match. <i>Length of pswd = 8-20</i>.</h5>
                <label for="newPassword"><span>* </span>New Password</label>
                <input type="password" name="newPassword" id="newPassword" minlength="8" maxlength="20" required>
            </div>
            <div>
                <label for="confirmNewPassword"><span>* </span>Confirm Password</label>
                <input type="password" name="confirmNewPassword" id="confirmNewPassword" minlength="8" maxlength="20" required>
            </div>
            <div class="form-btn">
                <button type="button" class="form-btn-back" onclick="location.href='forgotPasswordPage1.php';">Back</button>
                <button type="submit" class="form-btn-save" name="resetPassword">Reset</button>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

