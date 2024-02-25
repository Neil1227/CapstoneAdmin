<?php
if (isset($_POST['newName'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acv_db";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Retrieve data from the POST request
    $oldDogName = $_POST['dogname']; // Assuming the original dog name is in this field
    $newDogName = $_POST['newdogname'];

    // Update the dog's name in the database
    $updateSql = "UPDATE adoptionrecords_table SET dogname = '$newDogName' WHERE dogname = '$oldDogName'";

    if ($connection->query($updateSql) === TRUE) {
        // Update successful
        $updateSuccess = "Dogs name updated successfully";
    } else {
        // Update failed
        $updateSuccess = "Error updating dogs name: " . $connection->error;
    }

    $connection->close();
}
?>
