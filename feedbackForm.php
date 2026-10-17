<?php
    session_start();
?> 
<?php
include './crud/db_connection.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/feedbackForm.css">
    <script src="FeedbackForm.js" defer></script> <!-- Include the JavaScript file -->
</head>
<body>

<div class="container">
    <button onclick="document.location='home_page.php';" class="back-btn">← Back</button>
    <h1>Feedback Form</h1>

    <form action="./crud/submit_feedback.php" method="POST">
        <div class="form-box">
            <label for="fbk_type">Feedback Type:</label>
            <select id="fbk_type" name="feedbackType" required>
                <option value="" selected></option>
                <option value="Billing and Payment">Billing and Payment</option>
                <option value="System Functionalities and Design">System Functionalities and Design</option>
                <option value="System Issues and Bugs">System Issues and Bugs</option>
                <option value="Others">Others</option>
            </select>

            <label for="fbk_description">Feedback Description:</label>
            <input type="text" id="fbk_description" name="feedbackContent" required>

            <div class="button-group">
                <button type="reset">Cancel</button>
                <button type="submit">Submit Feedback</button>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>








