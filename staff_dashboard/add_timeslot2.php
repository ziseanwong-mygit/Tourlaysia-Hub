<?php
    // Start session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/itinerary_formTwo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/itineraryForm2.js"></script>
</head>
<body>
    <?php include 'header.php';?>

    <div class="itin-title-desc">
        <h2 class="itin-title">Add Trip Schedule - Section 2</h2>
        <div class="itin-desc-div">
            <p class="itin-desc">Now it's time to add your timeslot for your trip schedule !</p>
        </div>
        <div class="itin-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="inst-list">
                <li>* Required Fields</li>
                <li>You can add rows to insert the date, time and activity of the trip schedule. You can also delete rows to remove the record.</li>
                <li>For day field, please enter the day number.</li>
                <li>Once finished, click the "Submit Timeslot form" button to save your timeslot.</li>
                <li>You can also erase inputs in all existing fields, and delete all added rows to restart.</li>
            </ol>
        </div>
    </div>
    <div class="itin-form">
        <form action="" method="POST">
            <div class="label-row-div design-1">
                <div class="label-field-div">
                    <label for="dateField"><span>*</span> Date:</label>
                </div>
                <div class="label-field-div day">
                    <label for="dayField"><span>*</span> Day:</label>
                </div>
                <div class="label-field-div">
                    <label for="timeField"><span>*</span> Time:</label>
                </div>
                <div class="label-field-div activity">
                    <label for="actField"><span>*</span> Activity:</label>
                </div>
                <div class="label-field-div">
                    <label><span>*</span> Action:</label>
                </div>
            </div>        

            <div class="input-row-div design-1">
                <div class="input-field-div">
                    <input type="date" id="dateField" name="itinActDate[]" required>
                </div>
                <div class="input-field-div day">
                    <input type="number" id="dayField" name="itinActDay[]" placeholder="E.g. 1" min="1" required>
                </div>
                <div class="input-field-div">
                    <input type="time" id="timeField" name="itinActTime[]" required>
                </div>
                <div class="input-field-div activity">
                    <input type="text" id="actField" name="itinActivity[]" placeholder="E.g. Reach airport on time" required>
                </div>
                <div class="input-field-div">
                    <button type="button" class="add-field-btn">
                        <i class="ri-add-fill"></i>
                        Add Slot
                    </button>
                </div>
            </div>

            <div class="form-buttons-div design-1">
                <button type="submit" name="subItinForm">
                    <i class="ri-save-fill"></i>
                    Submit Timeslot Form
                </button>
                <button type="reset" name="eraseData">
                    <i class="ri-eraser-fill"></i>
                    Erase All Inputs
                </button>
                <button type="button" class="delete-all-btn" name="delAllRows">
                    <i class="ri-eraser-fill"></i>
                    Delete All Fields
                </button>
                <button type="button" onclick="history.back();" name="backToSec">
                    <i class="ri-arrow-left-long-fill"></i>
                    Back to Add Schedule
                </button>
            </div>
        </form>
        <form action="" method="POST">
            <!-- For smaller screens less than 985px-->
            <div class="combine-row-div design-2">
                <div class="combine-field-div">
                    <label><span>*</span> Date:</label>
                    <input type="date" name="itinActDate[]" required>   
                </div>
                <div class="combine-field-div">
                    <label><span>*</span> Day:</label>
                    <input type="number" name="itinActDay[]" placeholder="E.g. 1" min="1" required>
                </div>
                <div class="combine-field-div">
                    <label><span>*</span> Time:</label>
                    <input type="time" name="itinActTime[]" placeholder="E.g. 10:00am" required>
                </div>
                <div class="combine-field-div">
                    <label><span>*</span> Activity:</label>
                    <input type="text" name="itinActivity[]" placeholder="E.g. Arrive at the airport" required>
                </div>
                <div class="combine-field-div">
                    <label><span>*</span> Action:</label>
                    <button type="button" class="add-field-btn">
                        <i class="ri-add-fill"></i>
                        Add Slot
                    </button>
                </div>
            </div> 

            <div class="combine-FormButtons-div design-2">
                <button type="submit" name="subItinForm2">
                    <i class="ri-save-fill"></i>
                    Submit Timeslot Form
                </button>
                <button type="reset" name="eraseData">
                    <i class="ri-eraser-fill"></i>
                    Erase All Inputs
                </button>
                <button type="button" class="delete-all-btn" name="delAllRows">
                    <i class="ri-eraser-fill"></i>
                    Delete All Fields
                </button>
                <button type="button" onclick="history.back();" name="backToSec">
                    <i class="ri-arrow-left-long-fill"></i>
                    Back to Add Schedule
                </button>
            </div>
        </form>
    </div>

    <?php
        // If form is submitted, the itinerary record will be created and saved into database.
        if (isset($_POST['subItinForm']) || isset($_POST['subItinForm2'])) {
            include './crud/createItinerary.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>