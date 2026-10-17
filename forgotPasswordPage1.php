<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: forgotPasswordPage1.php -->
<!-- Description: This page provides a form for users to reset their password -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
include('./crud/db_connection.php');
include ('header.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verifyIdentity'])) {
    $doc_ID = trim($_POST['doc_ID']);
    $email = trim($_POST['email']);

    // Validate inputs from DB
    $query = "SELECT * FROM user_account_t WHERE usr_doc_ID = ? AND usr_email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $doc_ID, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        // Use temporary form to POST data to page 2
        echo '
        <form id="redirectForm" action="forgotPasswordPage2.php" method="POST">
            <input type="hidden" name="doc_ID" value="' . htmlspecialchars($doc_ID) . '">
            <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
        </form>
        <script>document.getElementById("redirectForm").submit();</script>';
        exit;
    } else {
        $error = "User not found. Please re-enter your document ID and email.";
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
    <?php if (!empty($error)): ?>
        <p style="color:red; text-align:center;"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-grid">
            <div>
                <h5>Please enter your Malaysian IC/Passport ID to confirm your identity.</h5>
                <label for="doc_ID"><span>* </span>Document ID</label>
                <input type="text" name="doc_ID" id="doc_ID" required pattern="[A-Za-z0-9\-]{6,20}">
            </div>
            <div>
                <label for="email"><span>* </span>Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-btn">
                <button type="button" class="form-btn-back" onclick="location.href='loginPage.php';">Back</button>
                <button type="submit" class="form-btn-save" name="verifyIdentity">Next</button>
            </div>
        </div>
    </form>
</div>

<?php include ('footer.php'); ?>
</body>
</html>
