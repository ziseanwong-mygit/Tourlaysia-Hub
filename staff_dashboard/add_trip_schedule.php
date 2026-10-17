<?php
session_start();
include './staff_crud/db_connection.php';
include 'staff_header.php';

// Utility function to generate schedule ID
function generateID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Only run logic after form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get current user ID from session
    if (!isset($_SESSION['SES_UserID'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit;
    }
    $usr_ID = $_SESSION['SES_UserID'];

    // Get user name from user_account_t
    $query = "SELECT usr_name FROM user_account_t WHERE usr_ID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $usr_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
        exit;
    }
    $user = $result->fetch_assoc();
    $usr_name = $user['usr_name'];

    // Retrieve form input
    $gud_ID         = $_POST['gud_ID'] ?? '';
    $drv_ID         = $_POST['drv_ID'] ?? '';
    $itr_ID         = $_POST['itr_ID'] ?? '';
    $scd_title      = $_POST['scd_title'] ?? '';
    $scd_desc       = $_POST['scd_desc'] ?? '';
    $scd_dura       = $_POST['scd_dura'] ?? '';
    $scd_start_date = $_POST['scd_start_date'] ?? '';
    $scd_end_date   = $_POST['scd_end_date'] ?? '';
    $scd_remark     = $_POST['scd_remark'] ?? '';

    // Basic validation
    if (!$gud_ID || !$scd_title || !$scd_dura || !$scd_start_date || !$scd_end_date) {
        echo json_encode(['success' => false, 'message' => 'Required fields are missing.']);
        exit;
    }

    // Generate schedule ID
    $scd_ID = 'SCD_' . generateID(10);

    // Insert into trip_schedule_t
    $query = "INSERT INTO trip_schedule_t 
        (scd_ID, gud_ID, drv_ID, itr_ID, scd_title, scd_desc, scd_dura, scd_start_date, scd_end_date, scd_remark, stf_ID, stf_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param(
        "ssssssssssss",
        $scd_ID,
        $gud_ID,
        $drv_ID,
        $itr_ID,
        $scd_title,
        $scd_desc,
        $scd_dura,
        $scd_start_date,
        $scd_end_date,
        $scd_remark,
        $usr_ID,
        $usr_name
    );

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Trip schedule added successfully.']);
?>
        <script>
            alert("You have successfully added a trip schedule record.");
            window.location="manageTripSchedule.php";
        </script>
<?php
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add trip schedule.',
            'error' => $stmt->error
        ]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/add_bill_payment_invoice.css">
</head>
<body>

<div class="container">
    <button onclick="history.back()" class="back-btn">← Back</button>
    <h1>Add Trip Schedule - Part 1</h1>

    <form action="" method="POST" id="tripScheduleForm">
        <div class="form-box">
            <label for="gud_ID">Tour Guide ID:</label>
            <input type="text" id="gud_ID" name="gud_ID" required>

            <label for="drv_ID">Bus Driver ID:</label>
            <input type="text" id="drv_ID" name="drv_ID" required>

            <label for="itr_ID">Itinerary ID:</label>
            <input type="text" id="itr_ID" name="itr_ID" required>

            <label for="scd_title">Schedule Title:</label>
            <input type="text" id="scd_title" name="scd_title" required>

            <label for="scd_desc">Schedule Description:</label>
            <input type="text" id="scd_desc" name="scd_desc" required>

            <label for="scd_dura">Schedule Duration:</label>
            <input type="text" id="scd_dura" name="scd_dura" required>

            <label for="scd_start_date">Start Date:</label>
            <input type="date" id="scd_start_date" name="scd_start_date" required>

            <label for="scd_end_date">End Date:</label>
            <input type="date" id="scd_end_date" name="scd_end_date" required>

            <label for="scd_remark">Schedule Remark:</label>
            <input type="text" id="scd_remark" name="scd_remark" required>

            <div class="button-group">
                <button type="reset">Cancel</button>
                <button type="submit">Add Trip Schedule</button>
            </div>
        </div>
    </form>
</div>

<?php include 'staff_footer.php'; ?>
</body>
</html>


