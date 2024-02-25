<?php
if (isset($_POST["user-delete"])) {
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
   
    // Retrieve data from the form
    $id = $_POST['del_id']; // ID of the record to update
    // SQL query to update data in the selected table
    $sql = "DELETE FROM user_tbl WHERE user_id = $id";
    
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