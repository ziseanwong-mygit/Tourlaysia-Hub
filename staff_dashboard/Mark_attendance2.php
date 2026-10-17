<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: Mark_attendance_2.php -->
<!-- Description: Attendance form for the selected trip -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 1/7/2025 -->

<?php
    require './staff_crud/db_connection.php';

    $tripId = $_GET['trip_id'] ?? 'Unknown';
    $dateTime = $_GET['datetime'] ?? 'N/A';
    $departure = $_GET['departure'] ?? 'N/A';
    $destination = $_GET['destination'] ?? 'N/A';

    $names = [];
    $query = "SELECT mbr_name FROM atd_mbr_rec_t WHERE atd_ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $tripId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $names[] = $row['mbr_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles_MA.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <?php include 'staff_header.php';?>

    <div id="attendance-section">
        <a href="Mark_attendance1.php"><i class="ri-arrow-left-line back-btn"></i></a>
        <h2>Mark Attendance</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                  <th>Attendance ID:</th>
                  <td><?= htmlspecialchars($tripId) ?></td>
                  <th>Date:</th>
                  <td><?= htmlspecialchars($dateTime) ?></td>
                </tr>
                <tr>
                  <th>Title:</th>
                  <td><?= htmlspecialchars($departure) ?></td>
                  <th>Description:</th>
                  <td><?= htmlspecialchars($destination) ?></td>
                </tr>
            </table>

            <table>
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody id="attendanceBody"></tbody>
            </table>

            <div class="save-wrapper">
              <button class="save-btn" onclick="saveAttendance()">Save Attendance</button>
            </div>
        </div>
    </div>

  <script>
      const names = <?= json_encode($names) ?>;
      const tbody = document.getElementById("attendanceBody");

      names.forEach((name, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${name}</td>
          <td>
              <select onchange="toggleRemarkSelect(this)" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
              </select>
          </td>
          <td>
              <select class="remark-dropdown">
                  <option value="">-- Optional Remark --</option>
                  <option value="Medical Leave / Sick">Medical Leave / Sick</option>
                  <option value="Lost / Not Contactable">Lost / Not Contactable</option>
                  <option value="Stayed at hotel">Stayed at hotel</option>
                  <option value="Missed bus">Missed bus</option>
                  <option value="Personal Reasons">Personal Reasons</option>
                  <option value="Tour Cancellation">Tour Cancellation</option>
                  <option value="Other">Other</option>
              </select>
          </td>
      `;
      tbody.appendChild(row);
    });

    function toggleRemarkSelect(select) {
        const remarkDropdown = select.parentElement.nextElementSibling.querySelector('.remark-dropdown');
        if (select.value === "Absent") {
            remarkDropdown.style.display = "block";
            remarkDropdown.setAttribute("required", "required");
        } else {
            remarkDropdown.style.display = "none";
            remarkDropdown.removeAttribute("required");
            remarkDropdown.value = "";
        }
    }

    function saveAttendance() {
        const rows = document.querySelectorAll('#attendanceBody tr');
        const attendanceData = [];

        let valid = true; // Flag to check for required remark

        rows.forEach((row, index) => {
            const name = row.children[1].innerText.trim();
            const status = row.children[2].querySelector('select').value;
            const remarkDropdown = row.children[3].querySelector('.remark-dropdown');
            const remark = (remarkDropdown && remarkDropdown.style.display !== 'none') ? remarkDropdown.value.trim() : "";

          //Validation: If Absent and remark not selected
          if (status === "Absent" && remark === "") {
              alert(`Please provide a remark for absent tourist: ${name}`);
              remarkDropdown.focus();
              valid = false;
              return;
          }

          attendanceData.push({ name, status, remark });
      });

      if (!valid) return; // stop fetch if invalid

        // Proceed to send data
        fetch('save_attendance.php?trip_id=<?= urlencode($tripId) ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(attendanceData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
              alert('Attendance saved successfully!');
              window.location.href = 'Mark_attendance1.php';
            } else {
              alert('Failed to save attendance.\n' + (data.error || 'Please check the inputs.'));
            }
        })
        .catch(err => {
            alert('An error occurred while saving attendance.');
            console.error(err);
        });
      }
  </script>

  <?php include 'staff_footer.php';?>
</body>
</html>
