<?php

if (isset($_POST['deceasedDogs'])) {
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
    $dogId = $_POST['dogID']; // Ensure 'dogID' is received in the form

    $dogname = $connection->real_escape_string($_POST['dogname']);
    $doggender = $connection->real_escape_string($_POST['doggender']);
    $dogbreed = $connection->real_escape_string($_POST['dogbreed']);
    $dateOfDeath = $connection->real_escape_string($_POST['dateOfDeath']);
    $name = $connection->real_escape_string($_POST['name']);
    $contactNo = $connection->real_escape_string($_POST['contactNo']);
    $address = $connection->real_escape_string($_POST['address']);

    $loggedInUsername = $_SESSION['username'];

    // Prepare the SQL statement to avoid SQL injection
    $insertSql = "INSERT INTO deceaseddogs_table 
    (dogName, dogGender, dogBreed, dateOfDeath, furparentName, username, contactNo, address, dogImage) 
    SELECT 
    '$dogname', '$doggender', '$dogbreed', '$dateOfDeath', '$name', '$loggedInUsername', '$contactNo', '$address', dogimage 
    FROM adoptionrecords_table 
    WHERE dogname = '$dogname' AND username = '$loggedInUsername'";

    // Execute the insertion query
    if ($connection->query($insertSql) === TRUE) {
        // SQL query to delete from adoptionrecords_table
        $deleteFromApplication = "DELETE FROM adoptionrecords_table 
            WHERE dogname = '$dogname' AND username = '$loggedInUsername'";

        if ($connection->query($deleteFromApplication) !== TRUE) {
            $deleteSuccess = "Error deleting from adoptionrecords_table: " . $connection->error;
        } else {
            $deleteSuccess = "Your deceased dog is now on the deceased dog page.";
        }
    } else {
        $addSuccess = "Error transferring data to deceased dog page: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
}
?>

