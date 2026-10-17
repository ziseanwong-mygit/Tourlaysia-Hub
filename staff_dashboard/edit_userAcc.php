<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_userAcc.php -->
<!-- Description: To create a form that allows admin to edit the user account details. Only admins can edit accounts-->
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

        // Check if the document is Malaysian IC or passport by checking string
        if(preg_match("/[a-zA-Z]/", $userDocID)) {
            $docType = "Passport";
        } else {
            $docType = "Malaysian IC";
        }

        $countryList = [
            "Malaysia", "Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa",
            "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina",
            "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
            "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda",
            "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic of The Congo", "Cook Islands", "Costa Rica" , "Cote D’ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-bissau", "Guyana", "Haiti", "Heard Island and Mcdonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran, Islamic Republic of Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of Korea", "Korea, Republic of Korea", "Kuwait", "Kyrgyzstan", "Laos, People's Democratic Republic Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia, The Former Yugoslav Republic of Macedonia", "Madagascar", "Malawi", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of Micronesia", "Moldova, Republic of Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and The Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and The South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of Tanzania", "Thailand", "Timor-leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"
        ];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit User Account Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides admins to edit a user account after the record selection. Only admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li>Both <b>user ID and role</b> cannot be changed. If the role is wrong, please create a new account with the correct details.</li>
                <li>Malaysia phone number only (+60).</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form" enctype="multipart/form-data">
        <div class="label-field-div">
            <label for="accID">Account ID:</label>
            <input type="text" id="accID" name="usrID" value="<?php echo $userIDRef;?>" readonly>
        </div>
        <div class="label-field-div radio-div">
            <label><span>*</span> Document Type:</label>
            <div class="radio-label-div">
                <input type="radio" id="IC" name="userDocType" value="Malaysian IC" <?php if ($docType == "Malaysian IC") echo "checked"; ?> required>
                <label for="IC" id="radioLabel">Malaysian IC</label>
            </div>
            <div class="radio-label-div">
                <input type="radio" id="passport" name="userDocType" value="Passport" <?php if ($docType == "Passport") echo "checked"; ?> required>
                <label for="passport" id="radioLabel">Passport</label>
            </div>
        </div>
        <div class="label-field-div">
            <label for="name"><span>*</span> Document ID/Num:</label>
            <input type="text" id="name" name="userDocID" placeholder="E.g. 000000000000 / A0000000000" value="<?php echo $userDocID;?>" required>
        </div>
        <div class="label-field-div">
            <label for="name"><span>*</span> Full Name:</label>
            <input type="text" id="name" name="userName" placeholder="E.g. Ali bin Ahmad" value="<?php echo $userName;?>" required>
        </div>
        <div class="label-field-div">
            <label for="email"><span>*</span> Email Address:</label>
            <input type="email" id="email" name="userEmail" placeholder="E.g. aliahmad@email.com" value="<?php echo $userEmail;?>" required>
        </div>
        <div class="label-field-div">
            <label for="phoneNum"><span>*</span> Phone Number:</label>
            <input type="tel" id="phoneNum" name="userNoTel" placeholder="E.g. 0123456789" value="<?php echo $userNoTel;?>" minlength="9" maxlength="11" required>
        </div>
        <div class="label-field-div radio-div">
            <label><span>*</span> Gender:</label>
            <div>
                <input type="radio" id="male" name="userGender" value="Male" <?php if ($userGender == "Male") echo "checked"; ?> required>
                <label for="male" id="radioLabel">Male</label>
            </div>
            <div>
                <input type="radio" id="female" name="userGender" value="Female" <?php if ($userGender == "Female") echo "checked"; ?> required>
                <label for="female" id="radioLabel">Female</label>
            </div>
        </div>
        <div class="label-field-div">
            <label for="country"><span>*</span> Country:</label>
            <select id="country" name="userCountry" required>
                <option value="">Select a country</option>
                <?php foreach ($countryList as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>" <?= ($userCountry == $country) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($country) ?>
                    </option>
                <?php endforeach; ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="profpic">Profile Picture:</label>
            <input type="file" id="profpic" name="userProfilePic" accept="image/*">
        </div>
        <?php
            if ($userRole == "Office staff" || $userRole == "Admin" || $userRole == "Tour guide" || $userRole == "Bus driver") {
        ?>
                <div class="label-field-div">
                    <label for="jobPosition"><span>*</span> Job Position:</label>
                    <select id="jobPosition" name="userJobPos" required>
                        <option value="" >Select a job position</option>
                        <option value="Office staff" <?php if ($userJobPosition == "Office staff") echo "selected"; ?>>Office staff</option>
                        <option value="Admin" <?php if ($userJobPosition == "Admin") echo "selected"; ?>>Admin</option>
                        <option value="Tour guide" <?php if ($userJobPosition == "Tour guide") echo "selected"; ?>>Tour guide</option>
                        <option value="Bus driver" <?php if ($userJobPosition == "Bus driver") echo "selected"; ?>>Bus driver</option>
                    </select>          
                </div>
                <div class="label-field-div">
                    <label for="department"><span>*</span> Department:</label>
                    <select id="department" name="userDept" required>
                        <option value="" >Select a department</option>
                        <option value="Tourism management" <?php if ($userDepartment == "Tourism management") echo "selected"; ?>>Tourism management</option>
                        <option value="Finance" <?php if ($userDepartment == "Finance") echo "selected"; ?>>Finance</option>
                        <option value="Customer service" <?php if ($userDepartment == "Customer service") echo "selected"; ?>>Customer service</option>
                        <option value="Web support" <?php if ($userDepartment == "Web support") echo "selected"; ?>>Web support</option>
                    </select>
                </div>
        <?php
            }
        ?> 
        <div class="label-field-div">
            <label for="pswd"><span>*</span> Password:</label>
            <div class="pswd-container">
                <input type="password" id="pswd" name="userPswd" placeholder="E.g. AbCdEAppram4%67!" value="<?php echo $userPassword;?>" required>
                <i class="ri-eye-fill eye1" id="showPswd"></i>
            </div>
        </div>
        <div class="label-field-div">
            <label for="confPswd"><span>*</span> Confirm Password:</label>
            <div class="pswd-container">
                <input type="password" id="confPswd" name="userConfPswd" placeholder="E.g. AbCdEAppram4%67!" value="<?php echo $userPassword;?>" required>
                <i class="ri-eye-fill eye2" id="showConfPswd"></i>
            </div>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateUsrAcc">
                <i class="ri-save-fill"></i>
                Update Account
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Reset to Old Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['updateUsrAcc'])) {
            $checkPswd = $_POST['userPswd'];
            $checkPswd2 = $_POST['userConfPswd'];
            $refDocType = $_POST['userDocType'];
            $checkDocID = $_POST['userDocID'];
            $flagStatus = FALSE;

            // Validate Malaysian IC
            if ($refDocType == "Malaysian IC") {
                // If Malaysian IC contains alphabets and not equal to 12 digits without "-"
                if (preg_match("/[a-zA-Z]/", $checkDocID) && (strlen($checkDocID) != 12)) {
    ?>
                    <script>
                        alert("Sorry! A Malaysian IC can only contain 12 digits only. Please try again.");
                    </script>
    <?php
                } else {
                    $flagStatus = TRUE;
                }
            } else {
                $flagStatus = TRUE;
            }

            // Check if password matches with confirm password
            if ($checkPswd == $checkPswd2) {
                $flagStatus = TRUE;
            } else {
    ?>
                <script>
                    alert("Sorry! The password your entered does not match with the confirm password. Please try again.");
                </script>
    <?php
            }
            
            if ($flagStatus) {
                include './staff_crud/updateUserAcc.php';
            }
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