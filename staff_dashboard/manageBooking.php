<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: manageBooking.php -->
<!-- Description: This page allows staff to manage bookings -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include('./staff_crud/db_connection.php');
    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
    include('staff_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css" />
    <link rel="stylesheet" href="./staff_styles/manageBooking.css" />
</head>
<body>
    <div class="page-header">
        <h1>Manage Booking</h1>
        <p>Manage and update booking-related records.</p>
    </div>

    <div class="controls-container">
        <div class="search-container">
            <form action="" method="GET" class="searchbar">
                <input type="search" placeholder="Search..." class="search-input" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="search-btn">
                    <img src="https://img.icons8.com/ios7/600/search.png" alt="Search">
                </button>
            </form>
        </div>
        <div class="add-wrapper">
            <button onclick='window.location.href="addBookingForm.php"' class="add-button">
                <img src="https://cdn-icons-png.flaticon.com/512/117/117885.png" alt="Add" class="add-icon" />
                <span>Add Booking</span>
            </button>
        </div>
    </div>

    <div class="table-section">
        <div class="table-title">Booking List</div>
            <div class="table-container">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User ID</th>
                            <th>Package ID</th>
                            <th>Package Description</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Phone</th>
                            <th>Document ID</th>
                            <th>Booking Title</th>
                            <th>Booking Description</th>
                            <th>Booking Date</th>
                            <th>Number of Pax</th>
                            <th>Booking Remark</th>
                            <th>Booking Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $booking_query = "SELECT * FROM tour_booking_t";
                          if (!empty($search)) {
                            $booking_query .= " WHERE bkn_ID LIKE '%$search%' 
                                            OR usr_ID LIKE '%$search%' 
                                            OR pkg_ID LIKE '%$search%' 
                                            OR usr_name LIKE '%$search%'";
                          }
                        $booking_result = mysqli_query($connection, $booking_query);
                        $booking_count = mysqli_num_rows($booking_result);

                        while ($row = mysqli_fetch_assoc($booking_result)) {
                          echo "<tr>";
                          echo "<td>{$row['bkn_ID']}</td>";
                          echo "<td>{$row['usr_ID']}</td>";
                          echo "<td>{$row['pkg_ID']}</td>";
                          echo "<td>{$row['pkg_dest']}</td>";
                          echo "<td>{$row['usr_name']}</td>";
                          echo "<td>{$row['usr_email']}</td>";
                          echo "<td>{$row['usr_no_tel']}</td>";
                          echo "<td>{$row['usr_doc_ID']}</td>";
                          echo "<td>{$row['bkn_title']}</td>";
                          echo "<td>{$row['bkn_desc']}</td>";
                          echo "<td>{$row['bkn_date']}</td>";
                          echo "<td>{$row['num_pax']}</td>";
                          echo "<td>{$row['bkn_remark']}</td>";
                          echo "<td>{$row['bkn_status']}</td>";
                          echo "<td><button class='manage-btn' onclick=\"window.location.href='mng_bookingInfo.php?bookID={$row['bkn_ID']}'\">Manage</button>
                              </td>";
                          echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <div class="result-wrapper">
          <p class="result-count">Showing <?php echo $booking_count; ?> result(s)</p>
        </div>
    </div>

    <?php include('staff_footer.php'); ?>
</body>
</html>