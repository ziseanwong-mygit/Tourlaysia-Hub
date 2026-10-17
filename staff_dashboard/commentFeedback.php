<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: commentFeedback.php -->
<!-- Description: To create a form that allows staffs and admins to comment tourists feedback.-->
<!-- Date first written: 11/7/2025 -->
<!-- Date last modified: 11/7/2025 -->

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
        $fbkIDRef = $_GET['fbkID'];

        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $queryA = "SELECT fbk_sel, fbk_content FROM user_feedback_t WHERE fbk_ID = '$fbkIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $fbkSelRef = $dataA['fbk_sel'];
        $fbkContRef = $dataA['fbk_content'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Comment Feedback Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to comment on <b>tourist's feedback</b> after the record selection.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>Please comment on the feedback you wish to express.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="fbkID">Feedback ID:</label>
            <input type="text" id="fbkID" name="feedbackID" value="<?php echo $fbkIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="fbkSel">Feedback Selection:</label>
            <input type="text" id="fbkSel" name="feedbackSel" value="<?php echo $fbkSelRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="fbkCont">User Feedback:</label>
            <textarea name="feedbackContent" id="fbkCont" rows="5" readonly><?php echo $fbkContRef;?></textarea>
        </div> 
        <div class="label-field-div">
            <label for="stfComt"><span>*</span> Your Comment:</label>
            <textarea name="staffComment" id="stfComt" placeholder="E.g. Thank you for contacting us..." rows="5"></textarea>
        </div>         
        <div class="form-buttons-div">
            <button type="submit" name="addCommentFbk">
                <i class="ri-save-fill"></i>
                Add Comment
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Erase Input
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['addCommentFbk'])) {
            include './staff_crud/addCommentFeedback.php';
        }
    ?>
    
    <?php include 'staff_footer.php';?>
</body>
</html>