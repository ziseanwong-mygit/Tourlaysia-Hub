<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: bookingFormPage3.php -->
<!-- Description: To create booking form page to allow users to book travel. -->
<!-- Date first written: 14/6/2025 -->
<!-- Date last modified: 14/7/2025 -->

<?php
    session_start();
    include('./crud/db_connection.php');
    include('header.php');

    // Utility function to generate ID
    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Check session data
    if (!isset($_SESSION['booking']) || !isset($_SESSION['members'])) {
        echo "<script>alert('Invalid access. Please try again.'); window.location.href='home_page.php';</script>";
        exit;
    }

    // On form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit'])) {
        $booking = $_SESSION['booking'];
        $members = $_SESSION['members'];

        $fullname   = $booking['fullname'];
        $email      = $booking['email'];
        $ic         = $booking['ic'];
        $phone      = $booking['phone'];
        $pax        = (int)$booking['pax'];
        $pkg_ID     = $booking['pkg_ID'];
        $pkg_dest   = $booking['pkg_dest'];
        $insurance  = $booking['insurance'];
        $agree      = $booking['agree'];

        $bkn_title  = $_POST['booking_title'];
        $bkn_desc   = $_POST['booking_desc'];
        $bkn_remark = $_POST['booking_remarks'];

        $bkn_ID     = $_SESSION['bkn_ID'] ?? "BKN_" . generateID();
        $usr_ID     = $_SESSION['SES_UserID'] ?? '';
        $bkn_date   = date('Y-m-d');
        $bkn_status = 'Pending';

        // Insert into tour_booking_t
        $insertBooking = "INSERT INTO tour_booking_t (
            bkn_ID, pkg_ID, pkg_dest, usr_ID, usr_doc_ID, usr_name, usr_email, usr_no_tel,
            bkn_title, bkn_desc, bkn_date, num_pax, bkn_remark, bkn_status
        ) VALUES (
            '$bkn_ID', '$pkg_ID', '$pkg_dest', '$usr_ID', '$ic', '$fullname', '$email', '$phone',
            '$bkn_title', '$bkn_desc', '$bkn_date', '$pax', '$bkn_remark', '$bkn_status'
        )";

        if (!mysqli_query($connection, $insertBooking)) {
            die("Booking insert failed: " . mysqli_error($connection));
        }

        // Insert into book_mbr_list_t
        foreach ($members as $member) {
            $mbr_ls_ID  = mysqli_real_escape_string($connection, $member['mbr_ls_ID']);
            $mbr_doc_ID = mysqli_real_escape_string($connection, $member['doc_ID']);
            $mbr_name   = mysqli_real_escape_string($connection, $member['name']);
            $mbr_seqNo  = (int)$member['seqNo'];

            $insertMember = "INSERT INTO book_mbr_list_t (
                mbr_ls_ID, bkn_ID, mbr_doc_ID, mbr_name, mbr_seqNo
            ) VALUES (
                '$mbr_ls_ID', '$bkn_ID', '$mbr_doc_ID', '$mbr_name', $mbr_seqNo
            )";

            if (!mysqli_query($connection, $insertMember)) {
                die("Member insert failed: " . mysqli_error($connection));
            }
        }

        // All data inserted successfully
        echo "<script>alert('Booking completed successfully!'); window.location.href='itinerary_formOne.php?bknID=$bkn_ID&pkgDest=$pkg_dest';</script>";
        unset($_SESSION['bkn_ID']);
        unset($_SESSION['booking']);
        unset($_SESSION['members']);
        exit;
    }
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
        <h3>Booking Details</h3>
        <div class="instruction-box">
            <h4>Instructions:</h4>
            <ol>
                <li style="color: red;">* Required field</li>
                <li>Provide booking title, description, and remarks.</li>
            </ol>
        </div>

        <form action="" method="POST">
            <div class="form-grid">
                <div>
                    <label for="booking_title"><span>* </span> Booking Title</label>
                    <input type="text" id="booking_title" name="booking_title" required pattern=".{5,100}" title="At least 5 characters">
                </div>
                <div>
                    <label for="booking_desc"><span>* </span> Booking Description</label>
                    <textarea id="booking_desc" name="booking_desc" rows="4" required></textarea>
                </div>
                <div>
                    <label for="booking_remarks">Booking Remarks</label>
                    <textarea id="booking_remarks" name="booking_remarks" rows="4" placeholder="Special needs, allergies, etc."></textarea>
                </div>
            </div>

            <div class="form-btn">
                <a href="javascript:history.back()" class="form-btn-back">Back</a>
                <button type="submit" name="final_submit" class="form-btn-next">Proceed</button>
            </div>
        </form>
    </div>

    <?php include 'footer.php';?>
</body>
</html>
