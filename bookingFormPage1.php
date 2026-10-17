<!-- Programmer Name: Seath Tan Ziren & Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: bookingFormPage1.php -->
<!-- Description: To create booking form page to allow users to book travel. -->
<!-- Date first written: 14/6/2025 -->
<!-- Date last modified: 14/7/2025 -->

<?php
    session_start();
    include('./crud/db_connection.php');
    include('header.php');

    if (!isset($_GET['pkgID'])) {
        die("Missing package ID.");
    }

    $pkg_ID = mysqli_real_escape_string($connection, $_GET['pkgID']);
    $pkg_result = mysqli_query($connection, "SELECT * FROM tour_package_t WHERE pkg_ID = '$pkg_ID' LIMIT 1");
    if (!$pkg_result || mysqli_num_rows($pkg_result) == 0) {
        die("Package not found.");
    }
    $pkg = mysqli_fetch_assoc($pkg_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/bookingFormPage.css">
</head>
<body>
<div class="form-container">
    <h3>Booking Form Part 1</h3>
    <div class="instruction-box">
        <h4>Instructions:</h4>
        <ol>
            <li style="color: red;">* Required field</li>
            <li>Fill in your personal details to proceed with the booking process.</li>
            <li>Package info is auto-filled.</li>
            <li>You must agree to Terms & Conditions. Travel insurance is optional but recommended.</li>
        </ol>
    </div>

    <form action="bookingFormPage2.php" method="POST">
        <input type="hidden" name="pkg_ID" value="<?= htmlspecialchars($pkg['pkg_ID']) ?>">
        <input type="hidden" name="pkg_dest" value="<?= htmlspecialchars($pkg['pkg_dest']) ?>">

        <div class="form-grid">
            <div>
                <label for="fullname"><span>* </span> Full name</label>
                <input type="text" id="fullname" name="fullname" required pattern="[A-Za-z\s]{3,50}">
            </div>
            <div>
                <label for="email"><span>* </span> Email address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="ic"><span>* </span> Malaysian IC/Passport</label>
                <input type="text" id="ic" name="ic" required pattern="[A-Za-z0-9]{6,20}">
            </div>
            <div>
                <label for="phone"><span>* </span> Contact number</label>
                <input type="text" id="phone" name="phone" required pattern="\d{10,12}">
            </div>
            <div>
                <label for="pax"><span>* </span> Number of pax</label>
                <input type="text" id="pax" name="pax" required pattern="\d{1,3}">
            </div>
            <div>
                <label for="package">Selected package</label>
                <input type="text" id="package" value="<?= htmlspecialchars($pkg['pkg_title']) . ' - ' . htmlspecialchars($pkg['pkg_dest']) ?>" disabled>
            </div>
        </div>

        <div class="checkbox-group">
            <label><input type="checkbox" name="insurance"> Add travel insurance</label>
        </div>

        <div class="checkbox-group">
            <label><input type="checkbox" name="agree" required> Agree to T&C</label>
        </div>

        <div class="form-btn">
            <a href="packageListPage.php" class="form-btn-back">Back</a>
            <button type="submit" class="form-btn-next">Next</button>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
