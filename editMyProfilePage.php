<!-- Programmer Name: Seath Tan Ziren
Project Name: editMyProfile.php
Description: To create edit profile page to allow users edit their personal details.
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

    <?php 
        include './crud/info_user.php';
        $getImgName = $refProfPic; // get old image file name for update
        $countries = [
            "Malaysia", "Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa", "Andorra",
            "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba",
            "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus",
            "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana",
            "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria",
            "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands",
            "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands",
            "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic of The", "Cook Islands", "Costa Rica",
            "Cote D'ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
            "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
            "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France",
            "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia",
            "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala",
            "Guernsey", "Guinea", "Guinea-bissau", "Guyana", "Haiti", "Heard Island and Mcdonald Islands",
            "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia",
            "Iran, Islamic Republic of", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan",
            "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of",
            "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon",
            "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao",
            "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Maldives", "Mali", "Malta",
            "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico",
            "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montenegro",
            "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands",
            "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue",
            "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau",
            "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
            "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation",
            "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon",
            "Saint Vincent and The Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
            "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia",
            "Solomon Islands", "Somalia", "South Africa", "South Georgia and The South Sandwich Islands",
            "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Swaziland", "Sweden",
            "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of",
            "Thailand", "Timor-leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey",
            "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
            "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan",
            "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands, British", "Virgin Islands, U.S.",
            "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"
        ]
    ?> 
    
    <div class="edit-form">
        <h3>Edit Profile</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div>
                    <label for="email"><span>* </span> Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $refEmail?>" required>
                </div>
                <div>
                    <label for="fullname"><span>* </span> Full name</label>
                    <input type="text" id="fullname" name="fullName" value="<?php echo $refName?>" required>
                </div>
                <div>
                    <label for="contact_number"><span>* </span> Contact Number</label>
                    <input type="text" id="contact_number" name="contactNumber" value="<?php echo $refTelNo?>" required>
                </div>
                <div>
                    <label for="prof-img">Profile Image:</label>
                    <input type="file" id="myFile" name="profImg" accept="image/*">
                </div>
                <div>
                    <label for="country"><span>* </span> Country</label>
<?php                   
                    echo '<select name="country" id="country" required>';
                    foreach ($countries as $country) {
                        $isSelected = ($country === $refCountry) ? "selected" : "";
                        echo "<option value=\"$country\" $isSelected>$country</option>";
                    }
                    echo '</select>';
?>
                </div>
                <div>
                    <label for="gender"><span>* </span> Gender</label>
                    <select name="gender" id="gender" required>
                    <option value="Male" <?php if ($refGender == "Male") echo "selected";?>>Male</option>
                    <option value="Female" <?php if ($refGender == "Female") echo "selected";?>>Female</option>
                    </select>
                </div>
                
                <div class="form-btn">
                    <button type="button" class="form-btn-back" onclick="location.href='accountDashboard.php';">Back</button>
                    <button type="submit" class="form-btn-save" name="editProfile">Save</button>
                </div>
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST['editProfile'])) {
            include './crud/edit_personal_acc.php';
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

    <?php include 'footer.php';?>
</body>
</html>



        
