<?php
    require './staff_crud/db_connection.php';

    $response = ['success' => false, 'updated' => 0, 'errors' => []];

    // Get trip ID from URL
    $tripId = $_GET['trip_id'] ?? null;
    if (!$tripId) {
        $response['error'] = "Missing trip_id.";
        echo json_encode($response);
        exit();
    }

    // Read JSON input
    $data = json_decode(file_get_contents('php://input'), true);
    if (!is_array($data)) {
        $response['error'] = "Invalid data format.";
        echo json_encode($response);
        exit();
    }

    // Prepare SQL statement
    $stmt = mysqli_prepare($connection, "
        UPDATE atd_mbr_rec_t 
        SET atd_status = ?, atd_remark = ?
        WHERE mbr_name = ? AND atd_ID = ?
    ");

    if (!$stmt) {
        $response['error'] = "Failed to prepare SQL statement.";
        echo json_encode($response);
        exit();
    }

    foreach ($data as $record) {
        // Extract values
        $name = $record['name'] ?? '';
        $status = $record['status'] ?? '';
        $remark = $record['remark'] ?? '';

        // Validate name and status
        if (empty($name) || !in_array($status, ['Present', 'Absent'])) {
            $response['errors'][] = "Invalid data for: $name";
            continue;
        }

        // Conditional Remark Handling
        if ($status === 'Present') {
            // Ignore any remark if present
            $remark = NULL;
        } else if ($status === 'Absent') {
            // Absent must have a remark
            if (empty($remark)) {
                $response['error'] = "Remark required for absent member: $name";
                echo json_encode($response);
                exit();
            }
        }

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssss", $status, $remark, $name, $tripId);

        // Execute query
        if (mysqli_stmt_execute($stmt)) {
            $response['updated']++;
        } else {
            $response['errors'][] = "Failed to update record for: $name";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Return success response
    $response['success'] = true;
    $response['message'] = "Attendance saved successfully.";

    echo json_encode($response);
?>