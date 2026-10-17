<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: manageFeedback.php -->
<!-- Description: This page allows staff to manage feedbacks -->
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
  <link rel="stylesheet" href="./staff_styles/manageFeedback.css" />
</head>
<body>
    <div class="page-header">
        <h1>Manage Feedback</h1>
        <p>Manage and update feedback-related records.</p>
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
    </div>

    <div class="table-section">
        <div class="table-title">Feedback List</div>
            <div class="table-container">
                <table class="feedback-table">
                    <thead>
                        <tr>
                            <th>Feedback ID</th>
                            <th>Feedback Date</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Feedback Selection</th>
                            <th>Feedback Content</th>
                            <th>Staff Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $feedback_query = "SELECT * FROM user_feedback_t";
                          if (!empty($search)) {
                            $feedback_query .= " WHERE fbk_ID LIKE '%$search%' 
                                            OR usr_ID LIKE '%$search%' 
                                            OR usr_name LIKE '%$search%'
                                            OR fbk_content LIKE '%$search%'
                                            OR stf_comt LIKE '%$search%'";
                          }
                        $feedback_result = mysqli_query($connection, $feedback_query);
                        $feedback_count = mysqli_num_rows($feedback_result);

                        while ($row = mysqli_fetch_assoc($feedback_result)) {
                          echo "<tr>";
                          echo "<td>{$row['fbk_ID']}</td>";
                          echo "<td>{$row['fbk_date']}</td>";
                          echo "<td>{$row['usr_ID']}</td>";
                          echo "<td>{$row['usr_name']}</td>";
                          echo "<td>{$row['usr_email']}</td>";
                          echo "<td>{$row['fbk_sel']}</td>";
                          echo "<td>{$row['fbk_content']}</td>";
                          echo "<td>{$row['stf_comt']}</td>";
                          echo "<td><button class='manage-btn' onclick=\"window.location.href='commentFeedback.php?fbkID={$row['fbk_ID']}'\">Comment</button>
                              </td>";
                          echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <div class="result-wrapper">
            <p class="result-count">Showing <?php echo $feedback_count; ?> result(s)</p>
        </div>
      </div>

    <?php include('staff_footer.php'); ?>
</body>
</html>