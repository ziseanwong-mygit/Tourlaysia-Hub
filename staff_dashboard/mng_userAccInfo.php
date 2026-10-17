<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: mng_userAccInfo.php -->
<!-- Description: To create a manage user account info panel that shows user account details and edit/delete buttons. Only admins can view, edit and delete user accounts.-->
<!-- Date first written: 9/7/2025 -->
<!-- Date last modified: 11/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/mng_recInfo.css">
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

        $usrRole = $dataA['usr_role'];
        $usrDocID = $dataA['usr_doc_ID'];
        $usrName = $dataA['usr_name'];
        $usrEmail = $dataA['usr_email'];
        $usrNoTel = $dataA['usr_no_tel'];
        $usrGender = $dataA['usr_gender'];
        $usrCountry = $dataA['usr_country'];
        $usrProfPic = $dataA['usr_prof_pic'];
        $usrJobPos = $dataA['usr_job_pos'];
        $usrDepartment = $dataA['usr_dep'];
        $usrPswd = $dataA['usr_pswd'];
        $usrStatus = $dataA['usr_status'];
        
    ?>
        <div class="mng-rec-title-div">
            <h2 class="mng-rec-title">Manage User Account - View, Edit / Delete Record</h2>
        </div>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">User Profile Info</h3>
            </div>
            <div class="rec-info-img-div">
                <?php
                    if ($usrProfPic != NULL) {
                ?>
                        <img width="150" height="150" src="../img/profile/<?php echo $usrProfPic;?>" alt="Profile Picture">
                <?php
                    } else {
                ?>
                        <img width="150" height="150" src="../img/anonymous.png" alt="Profile Picture">
                <?php
                    }
                ?>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Account ID: </b><?php echo $userIDRef;?></p>
                    <p><b>User role: </b><?php echo $usrRole;?></p>
                    <p><b>Document ID: </b><?php echo $usrDocID;?></p>
                    <p><b>Full Name: </b><?php echo $usrName;?></p>
                    <p><b>Email: </b><?php echo $usrEmail;?></p>
                    <p><b>No. Tel: </b><?php echo $usrNoTel;?></p>
                    <p><b>Gender: </b><?php echo $usrGender;?></p>
                    <p><b>Country: </b><?php echo $usrCountry;?></p>
                    <p>
                        <b>Status: </b>
                        <span
                            <?php 
                            if ($usrStatus == "Approved"){
                                echo "style='color:green;'";
                            }   
                            else if ($usrStatus == "Pending") {
                                echo "style='color:blue;'";
                            }
                            else {
                                echo "style='color:red;'";
                            }
                        ?>
                        >
                            <?php echo $usrStatus;?>
                        </span>
                    </p>
                    <?php
                        if ($usrRole != "Tourist") {
                    ?>
                            <p><b>Job Position: </b><?php echo $usrJobPos;?></p>
                            <p><b>Department: </b><?php echo $usrDepartment;?></p>
                    <?php
                        }
                    ?>
                </div>
                <div class="pswd-div">
                    <b>Password:</b>
                    <div class="pswd-container">
                        <input type="password" value="<?php echo $usrPswd;?>" id="pswdField" readonly>
                        <i class="ri-eye-fill" id="showPswd"></i>
                    </div>
                </div>
            </div>
            <div class="mng-rec-btn-div">
                <button class="otherBtn" onclick="document.location='reviewAccount.php?userID=<?php echo $userIDRef?>';">
                    <i class="ri-search-eye-line"></i>
                    Review
                </button>
                <button class="editBtn" onclick="document.location='edit_userAcc.php?userID=<?php echo $userIDRef?>';">
                    <i class="ri-edit-2-fill"></i>
                    Edit
                </button>
                <!-- The button will trigger a popup box to alert for deletion -->
                <button class="delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                    <i class="ri-delete-bin-2-fill"></i>
                    Delete
                </button>
                <button class="otherBtn" onclick="document.location='manageUser.php';">
                    <i class="ri-arrow-left-line"></i>
                    Back
                </button>
            </div>
        </main>

        <div id="delPopup2" class="popupBox">
            <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete User Account</h1>
                    <p>Are you sure you want to delete this user account? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteUserAccRec" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>

    <?php include 'staff_footer.php';?>

    <?php
        if (isset($_POST['deleteUserAccRec'])) {
            include './staff_crud/deleteUserAcc.php';
        }
    ?>

    <!-- JavaScript for delete popup box -->
    <script src="./staff_js/deletePopUp.js"></script> 

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