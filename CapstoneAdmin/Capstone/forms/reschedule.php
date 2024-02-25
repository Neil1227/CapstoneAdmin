<?php
if (isset($_POST["rescheduleSubmit"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acv_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $newDate = $_POST["newdate"];
    $Id = $_POST["id"]; // Add a hidden input field in your HTML to store the dog ID

    // Perform the update query to reschedule the dog adoption
    $updateQuery = "UPDATE application_table SET schedule = '$newDate' WHERE id = '$Id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $updateSuccess = "Rescheduled done! Please wait for sms/calls from the CityVet for updates. Thank you! ";
    } else {
        // Handle the update failure (e.g., display an error message)
        $updateSuccess = "Error updating schedule: " . mysqli_error($conn);
    }
}
?>
