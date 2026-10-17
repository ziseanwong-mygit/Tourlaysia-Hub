<?php
    session_start();
?> 

<?php include 'staff_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/addBookingForm.css">
</head>
<body>

<div class="container">
    <button onclick="document.location='manageBooking.php';" class="back-btn">← Back</button>
    <h1>Add Booking Part 1 & 2</h1>

    <form action="./staff_crud/add_booking_staff.php" method="POST" id="bookingForm">
        <div class="form-box">
            <label for="category">Category:</label>
            <select id="category" name="category" onchange="showFields()">
                <option value="addbooking1">Add Tour Booking</option>
                <option value="addbooking2">Add Booking Member List</option>
            </select>

            <div id="dynamic-fields">
                <!-- Dynamic fields will be injected here based on selection -->
            </div>

            <div class="button-group">
                <button type="reset">Cancel</button>
                <button type="submit">Add</button>
            </div>
        </div>
    </form>
</div>

<script>
    window.addEventListener('DOMContentLoaded', showFields);function showFields() {
        var category = document.getElementById('category').value;
        var container = document.getElementById('dynamic-fields');
        
        container.innerHTML = ''; // Clear previous fields

        if (category === 'addbooking1') {
            container.innerHTML += `
            <label for="username">Username:</label>
            <input type="text" id="" name="username" required>

            <label for="email">Email Address:</label>
            <input type="text" id="email" name="email" required>

            <label for="tor_no_tel">Contact Number:</label>
            <input type="text" id="tor_no_tel" name="tor_no_tel" required>

            <label for="userID">User ID:</label>
            <input type="text" id="tor_doc_ID_no" name="userID" required>

            <label for="tor_doc_ID_no">Document ID Number:</label>
            <input type="text" id="tor_doc_ID_no" name="tor_doc_ID_no" required>

            <label for="bkn_title">Booking Title:</label>
            <input type="text" id="bkn_title" name="bkn_title">

            <label for="bkn_desc">Booking Descriptions:</label>
            <input type="text" id="bkn_desc" name="bkn_desc">

            <label for="pkg_ID">Package ID:</label>
            <input type="text" id="pkg_dest" name="pkg_ID" required>

            <label for="pkg_dest">Package Destination:</label>
            <input type="text" id="pkg_dest" name="pkg_dest">

            <label for="num_pax">Number of Pax:</label>
            <input type="number" id="num_pax" name="num_pax" required>

            <label for="bkn_remark">Booking Remark:</label>
            <input type="text" id="bkn_remark" name="bkn_remark">

            <label for="bkn_status">Status:</label>
            <select id="bkn_status" name="bkn_status" required>
                <option value="Confirmed">Confirmed</option>
                <option value="Pending">Pending</option>
                <option value="Rejected">Rejected</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            `;
        } else if (category === 'addbooking2') {
            container.innerHTML += `
                <label for="mbr_ls_ID">Member List ID:</label>
                <input type="text" id="mbr_ls_ID" name="mbr_ls_ID" required>

                <label for="bkn_ID">Booking ID:</label>
                <input type="text" id="bkn_ID" name="bkn_ID" required>

                <label for="mbr_doc_ID">Member Document ID:</label>
                <input type="text" id="mbr_doc_ID" name="mbr_doc_ID" required>

                <label for="mbr_name">Member Name:</label>
                <input type="text" id="mbr_name" name="mbr_name" required>

                <label for="mbr_seqNo">Member Sequence Number:</label>
                <input type="text" id="mbr_seqNo" name="mbr_seqNo">
            `;
        }
    }
</script>
<?php include 'staff_footer.php'; ?>
</body>
</html>

