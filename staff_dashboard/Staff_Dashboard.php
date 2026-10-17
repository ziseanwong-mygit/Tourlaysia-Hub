<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: Staff_Dashbaord.php -->
<!-- Description: Allow staff to select accessible functions -->
<!-- Date first written: 26/6/2025 -->
<!-- Date last modified: 29/6/2025 -->

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles_SD.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">

</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        include './staff_crud/db_connection.php'; // Connect database

        if (isset($_SESSION['SES_UserID'])) {
            $refUserID = $_SESSION['SES_UserID']; // Retrieve user ID with session variable

            // Select record and store value
            $query = "SELECT * FROM user_account_t WHERE usr_ID = '$refUserID';";
            $results = mysqli_query($connection, $query);
            $data = mysqli_fetch_assoc($results);
        
            $name = $data['usr_name'];
            $role = $data['usr_role'];
            $profPic = $data['usr_prof_pic'];
        }
    ?>

    <!-- Main Dashboard -->
    <div class="dashboard-content">
        <header class="dashboard-header">
            <a href="index.php" class="h1">Tourlaysia</a>
        </header>

        <section class="staff-profile">
            <?php
                if ($profPic != NULL) {
            ?>
                    <img src="../img/profile/<?php echo $profPic;?>" alt="Profile Picture" class="profile-pic">
            <?php
                } else {
            ?>
                    <img src="../img/anonymous.png" alt="Profile Picture" class="profile-pic">
            <?php
                }
            ?>
            <h2 class="username2"><?php echo $name ?></h2>
            <h4>Welcome to Your Staff Dashboard!</h4>
            <p>You can manage system tasks based on your staff role.</p>
        </section>

        <section class="dashboard-actions">
            <?php if ($role === 'Admin'): ?>
                <div class="action-box" onclick="location.href='manageUser.php'">
                    <i class="ri-account-circle-line"></i>
                    <span>Manage User<br>Account</span>
                </div>
            <?php endif; ?>

            <?php if ($role === 'Admin' || $role === 'Office staff'): ?>
                <div class="action-box" onclick="location.href='manageBooking.php'">         
                    <i class="ri-calendar-check-fill"></i>
                    <span>Manage<br>Booking</span>
                </div>
                <div class="action-box" onclick="location.href='manageBillPaymentReceipt.php'">
                    <i class="ri-bill-line"></i>
                    <span>Billing &<br>Payments</span>
                </div>
                <div class="action-box" onclick="location.href='manageTripSchedule.php'">
                    <i class="ri-calendar-schedule-line"></i>
                    <span>Manage<br>Trip<br>Schedule</span>
                </div>
                <div class="action-box" onclick="location.href='manageFeedback.php'">
                    <i class="ri-message-2-line"></i>
                    <span>Manage<br>Feedback</span>
                </div>
            <?php endif; ?>

            <?php if ($role == "Tour guide" || $role == "Bus driver"): ?>
                <div class="action-box" onclick="location.href='viewTripSchedule.php'">
                    <i class="ri-edit-box-line"></i>
                    <span>View<br>Schedule</span>
                </div>
            <?php endif; ?>

            <?php if ($role === 'Tour guide'): ?>
                <div class="action-box" onclick="location.href='Mark_attendance1.php'">
                    <i class="ri-edit-box-line"></i>
                    <span>Mark<br>Attendance</span>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <?php include 'staff_footer.php';?>

    <script>
        function openSidebar() {
            document.getElementById("sidebar").style.width = "250px";
            document.getElementById("overlay").style.display = "block";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("overlay").style.display = "none";
        }

    </script>
</body>
</html>