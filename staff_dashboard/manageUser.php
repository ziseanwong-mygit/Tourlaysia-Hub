<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: manageUser.php -->
<!-- Description: This page allows staff to manage users -->
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
    <link rel="stylesheet" href="./staff_styles/manageUser.css" />
</head>
<body>
    <div class="page-header">
        <h1>Manage User</h1>
        <p>Manage and update user-related records</p>
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
          <button onclick='window.location.href="addUserAccountPage.php"' class="add-button">
            <img src="https://cdn-icons-png.flaticon.com/512/117/117885.png" alt="Add" class="add-icon" />
            <span>Add</span>
          </button>
        </div>
    </div>

    <div class="table-section">
        <div class="table-title">User List</div>
            <div class="table-container">
                <table class="user-table">
                    <thead>
                        <tr>
                          <th>User ID</th>
                          <th>User Role</th>
                          <th>User Document ID</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Gender</th>
                          <th>Country</th>
                          <th>Profile Picture</th>
                          <th>Job Position</th>
                          <th>Department</th>
                          <th>Password</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $user_query = "SELECT * FROM user_account_t";
                          if (!empty($search)) {
                            $user_query .= " WHERE usr_ID LIKE '%$search%' 
                                            OR usr_role LIKE '%$search%'
                                            OR usr_doc_ID LIKE '%$search%'
                                            OR usr_name LIKE '%$search%'
                                            OR usr_email LIKE '%$search%'
                                            OR usr_no_tel LIKE '%$search%'
                                            OR usr_no_tel LIKE '%$search%'
                                            OR usr_country LIKE '%$search%'
                                            OR usr_job_pos LIKE '%$search%'
                                            OR usr_dep LIKE '%$search%'";
                          }
                        $user_result = mysqli_query($connection, $user_query);
                        $user_count = mysqli_num_rows($user_result);

                        while ($row = mysqli_fetch_assoc($user_result)) {
                          echo "<tr>";
                          echo "<td>{$row['usr_ID']}</td>";
                          echo "<td>{$row['usr_role']}</td>";
                          echo "<td>{$row['usr_doc_ID']}</td>";
                          echo "<td>{$row['usr_name']}</td>";
                          echo "<td>{$row['usr_email']}</td>";
                          echo "<td>{$row['usr_no_tel']}</td>";
                          echo "<td>{$row['usr_gender']}</td>";
                          echo "<td>{$row['usr_country']}</td>";
                          echo "<td>{$row['usr_prof_pic']}</td>";
                          echo "<td>{$row['usr_job_pos']}</td>";
                          echo "<td>{$row['usr_dep']}</td>";
                          echo "<td>{$row['usr_pswd']}</td>";
                          echo "<td><button class='manage-btn' onclick=\"window.location.href='mng_userAccInfo.php?userID={$row['usr_ID']}'\">Manage</button>
                              </td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                  </table>
              </div>
        <div class="result-wrapper">
          <p class="result-count">Showing <?php echo $user_count; ?> result(s)</p>
        </div>
    </div>

    <?php include('staff_footer.php'); ?>

</body>
</html>