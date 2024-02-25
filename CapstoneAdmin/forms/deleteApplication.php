<?php
if (isset($_POST["appDel"])) {
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
    $app_tbt_id = $_POST['app_id']; // Sanitize input as an integer

    // SQL query to delete the record using a prepared statement
    $sql = "DELETE FROM application_table WHERE id = $app_tbt_id";
    
    if ($conn->query($sql) === TRUE) {
        $delSuccess = true;
    } else {
        $delSuccess = false;
        echo "error"  . $conn->error;
    }
        
    
    // Close the database connection
    $conn->close();
}
?>