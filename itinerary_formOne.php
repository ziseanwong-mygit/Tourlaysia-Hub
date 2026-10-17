<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: itinerary_formOne.php -->
<!-- Description: To create a form that allows tourists to write details of the itinerary for customization. This page is part 1 of itinerary form. -->
<!-- Date first written: 8/7/2025 -->
<!-- Date last modified: 9/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/itinerary_formOne.css">
</head>
<body>
    <!--Retrieve values-->
    <?php
        $bookIDRef = $_GET["bknID"];
        $pkgDestRef = $_GET["pkgDest"];
    ?>
    <?php include 'header.php';?>
        <div class="itin-title-desc">
            <h2 class="itin-title">Itinerary Customization Form - Section 1</h2>
            <div class="itin-desc-div">
                <p class="itin-desc">If you have your own plans or ideas on your trip, then no need to worry about fixed itineraries anymore. You can customize your finalized itinerary here for us to review and plan. <span>Flexibility is #1 priority in planning a trip.</span></p>
            </div>
            <div class="itin-inst-div">
                <h4 style="padding-bottom:10px;">Instructions:</h4>
                <ol class="inst-list">
                    <li>* Required Fields</li>
                    <li>Click the "Skip this step" button to skip the itinerary customization process if you want your tour guide to plan your itinerary.</li>
                </ol>
            </div>
        </div>
        <form action="" method="POST" class="itin-form">
            <div class="label-field-div">
                <label for="title"><span>*</span> Itinerary Title:</label>
                <input type="text" id="title" name="itinTitle" placeholder="E.g. My 5D4N Penang Trip Itinerary" required>
            </div>

            <div class="label-field-div">
                <label for="desc"><span>*</span> Itinerary Description:</label>
                <textarea name="itinDesc" id="desc" placeholder="E.g. This is my itinerary description for 5D4N Penang Trip Itinerary" rows="5" required></textarea>
            </div>
                  
            <div class="one-row-div">
                <div class="label-field-div">
                    <label for="startdate"><span>*</span> Start Date:</label>
                    <input type="date" id="startdate" name="itinStartDate" required>
                </div>
                <div class="label-field-div">
                    <label for="enddate"><span>*</span> End Date:</label>
                    <input type="date" id="enddate" name="itinEndDate" required>  
                </div>
            </div>
            
            <div class="label-field-div">
                <label for="destination"><span>*</span> Destination:</label>
                <input type="text" id="destination" name="itinDest" value="<?php echo $pkgDestRef;?>" readonly>
            </div>
            
            <div class="label-field-div">
                <label for="remarks">Itinerary Remarks:</label>
                <input type="text" id="remarks" name="itinRemark" placeholder="E.g. Itinerary may have some changes after submitting it.">
            </div>

            <div class="form-buttons-div">
                <button type="submit" name="saveItinInput">
                    <i class="ri-save-fill"></i>
                    Save Itinerary Details
                </button>
                <button type="submit" name="skipItinStep" formnovalidate>
                    <i class="ri-skip-forward-fill"></i>
                    Skip This Step
                </button>
                <button type="reset" name="eraseData">
                    <i class="ri-eraser-fill"></i>
                    Erase Inputs
                </button>
             </div>
        </form>

    <!-- PHP code to trigger whether the form has been submitted or not; to store values in the URL with parameters-->
    <?php
        if(isset($_POST['saveItinInput'])) {
            // Set session variables to save itinerary details
            $_SESSION['itinTitle'] = $_POST['itinTitle'];
            $_SESSION['itinDesc'] = $_POST['itinDesc'];
            $_SESSION['itinStartDate'] = $_POST['itinStartDate'];
            $_SESSION['itinEndDate'] = $_POST['itinEndDate'];
            $_SESSION['itinDest'] = $_POST['itinDest'];
            $_SESSION['itinRemark'] = $_POST['itinRemark'];
            $_SESSION['bookingID'] = $bookIDRef;
    ?>
            <script>
                // Redirect user to itinerary form part 2     
                window.location.href="itinerary_formTwo.php";
            </script>
    <?php
        } else if(isset($_POST['skipItinStep'])) {
    ?>
            <script>
                alert("You have skipped the itinerary customization process. If you wish to customize your itinerary, you can go to your booking record and customize your itinerary. Thank you for booking from us. Your booking is currently under review by our staff.");
                window.location.href="home_page.php";
            </script>
    <?php
        } else {

        }
    ?>

    <?php include 'footer.php';?>
</body>
</html>