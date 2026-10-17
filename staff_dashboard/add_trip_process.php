<?php
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "Tourlaysiadb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $data = json_decode(file_get_contents("php://input"));
    $tripId = $data->tripId;
    $dateTime = $data->dateTime;
    $departure = $data->departure;
    $destination = $data->destination;
    $status = $data->status;

    $sql = "INSERT INTO trips (trip_id, date_time, departure, destination, status) VALUES ('$tripId', '$dateTime', '$departure', '$destination', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }

    $conn->close();
?>
