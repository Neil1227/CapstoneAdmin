<?php
if (isset($_POST["qual_del"])) {
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
    $id = $_POST['qual_id']; // Sanitize input as an integer

    // SQL query to delete the record using a prepared statement
    $sql = "DELETE FROM adoptionrecords_table WHERE id = $id";
    
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