<?php
if (isset($_POST["confirmDeleteButton"])) {
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
    $tbt_id = $_POST['id']; // ID of the record to update
    // SQL query to update data in the selected table
    $sql = "DELETE FROM dogs_tbl WHERE id = $tbt_id";
    
    if ($conn->query($sql) === TRUE) {
        $deleteSuccess = true;
    } else {
        $deleteSuccess = false;
        echo "error";
    }

    // Close the database connection
    $conn->close();
}
?>