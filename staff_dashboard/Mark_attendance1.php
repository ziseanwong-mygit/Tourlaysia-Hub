<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: Mark_attendance_1.php -->
<!-- Description: Trip list selection for marking attendance -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 10/7/2025 -->

<?php
    require './staff_crud/db_connection.php';
    $searchTerm = $_GET['search'] ?? ''; // Get input from user
    if (!empty($searchTerm)) {
        $safeSearch = mysqli_real_escape_string($connection, $searchTerm);
        $query = "SELECT * FROM atd_rec_t WHERE atd_ID LIKE '%$safeSearch%' ORDER BY atd_date DESC";
    } else {
        $query = "SELECT * FROM atd_rec_t ORDER BY atd_date DESC";
    }

    $result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="icon" type="image/png" href="./img/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles_MA.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <?php include 'staff_header.php';?>

    <div id="trip-list-section">
        <a href="Staff_Dashboard.php"><i class="ri-arrow-left-line back-btn"></i></a>
        <h1>Mark Attendance</h1>

        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search by Trip ID" value="<?= htmlspecialchars($searchTerm) ?>">
                <button type="submit">Search</button>
                <button type="button" onclick="location.href='add_attendanceRec.php';">Add record</button>
            </form>
        </div>

        <div class="table-wrapper">
            <table id="tripTable">
                <thead>
                    <tr>
                      <th>Attendance ID</th>
                      <th>Booking ID</th>
                      <th>Date</th>
                      <th>Attendance Title</th>
                      <th>Attendance Description</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['atd_ID']) ?></td>
                            <td><?= htmlspecialchars($row['bkn_ID']) ?></td>
                            <td><?= htmlspecialchars($row['atd_date']) ?></td>
                            <td><?= htmlspecialchars($row['atd_title']) ?></td>
                            <td><?= htmlspecialchars($row['atd_desc']) ?></td>
                            <td>
                              <form action="Mark_attendance2.php" method="GET">
                                  <input type="hidden" name="trip_id" value="<?= $row['atd_ID'] ?>">
                                  <input type="hidden" name="datetime" value="<?= $row['atd_date'] ?>">
                                  <input type="hidden" name="departure" value="<?= $row['atd_title'] ?>">
                                  <input type="hidden" name="destination" value="<?= $row['atd_desc'] ?>">
                                  <button type="submit">Mark Attendance</button>
                              </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                      <td colspan="6">No attendance records found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
  </div>

  <?php include 'staff_footer.php';?>
</body>
</html>
