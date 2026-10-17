<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: manageTripSchedule.php -->
<!-- Description: This page allows staff to manage trip schedules -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include('./staff_crud/db_connection.php');
    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
    include('staff_header.php');
    $refusr_ID = $_SESSION['SES_UserID'];

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css" />
    <link rel="stylesheet" href="./staff_styles/manageTripSchedule.css" />
</head>
<body>
    <div class="page-header">
        <h1>View Your Trip Schedule</h1>
        <p>For tour guides and bus drivers to view their daily schedules for perfect tour timings!</p>
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

        <div onclick='window.location.href="add_trip_schedule.php"' class="add-wrapper">
            <button class="add-button">
                <img src="https://cdn-icons-png.flaticon.com/512/117/117885.png" alt="Add" class="add-icon" />
                <span>Add</span>
            </button>
        </div>
    </div>

    <div class="table-section">
        <div class="table-title">Trip Schedule List</div>
            <div class="table-container">
                <table class="trip-schedule-table">
                  <thead>
                    <tr>
                        <th>Schedule ID</th>
                        <th>Itinerary ID</th>
                        <th>Schedule Title</th>
                        <th>Schedule Description</th>
                        <th>Schedule Duration</th>
                        <th>Schedule Start Date</th>
                        <th>Schedule End Date</th>
                        <th>Schedule Remark</th>
                        <th>Staff Name</th>
                        <th>View Full</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $schedule_query = "
                            SELECT * FROM trip_schedule_t 
                            WHERE (gud_ID = '$refusr_ID' OR drv_ID = '$refusr_ID')
                            ";

                            if (!empty($search)) {
                            $schedule_query .= "
                                AND (
                                scd_ID LIKE '%$search%' 
                                OR gud_ID LIKE '%$search%' 
                                OR drv_ID LIKE '%$search%' 
                                OR itr_ID LIKE '%$search%' 
                                OR scd_title LIKE '%$search%' 
                                OR scd_desc LIKE '%$search%' 
                                OR scd_dura LIKE '%$search%' 
                                OR scd_start_date LIKE '%$search%' 
                                OR scd_end_date LIKE '%$search%' 
                                OR scd_remark LIKE '%$search%' 
                                OR stf_ID LIKE '%$search%' 
                                OR stf_name LIKE '%$search%'
                                )
                            ";
                            }
                      $schedule_result = mysqli_query($connection, $schedule_query);
                      $schedule_count = mysqli_num_rows($schedule_result);

                      while ($row = mysqli_fetch_assoc($schedule_result)) {
                        echo "<tr>";
                        echo "<td>{$row['scd_ID']}</td>";
                        echo "<td>{$row['itr_ID']}</td>";
                        echo "<td>{$row['scd_title']}</td>";
                        echo "<td>{$row['scd_desc']}</td>";
                        echo "<td>{$row['scd_dura']}</td>";
                        echo "<td>{$row['scd_start_date']}</td>";
                        echo "<td>{$row['scd_end_date']}</td>";
                        echo "<td>{$row['scd_remark']}</td>";
                        echo "<td>{$row['stf_name']}</td>";
                        echo "<td><button class='manage-btn' onclick=\"window.location.href='more_scheduleInfo.php?scdID={$row['scd_ID']}'\">More</button>
                            </td>";
                        echo "</tr>";
                      }
                      ?>
                  </tbody>
              </table>
          </div>
          <div class="result-wrapper">
            <p class="result-count">Showing <?php echo $schedule_count; ?> result(s)</p>
          </div>
      </div>

      <?php include('staff_footer.php'); ?>
</body>
</html>