<?php
if (isset($_POST["viddel"])) {
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

    // Assuming 'viddel' is the name attribute of your form input
    $deleteId = $_POST['viddel_id'];

    // Prepare and execute the delete query using prepared statements
    $sql = "DELETE FROM video_update WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("i", $deleteId);

    // Execute the statement
    if ($stmt->execute()) {
        $delSuccess = true;
    } else {
        $delSuccess = false;
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
