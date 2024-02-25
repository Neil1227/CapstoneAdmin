<?php
if (isset($_POST['transferAccepted'])) {
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
    $insert_id = $_POST['id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $dog_name = $_POST['dogname'];
    $dog_color = $_POST['dogcolor'];
    $dog_age = $_POST['dogage'];
    $dog_gender = $_POST['doggender'];

    $insertSql = "INSERT INTO adoptionrecords_table (address, contact, username, name, age,  dogname, dogcolor, dogage, doggender, dogbreed, dogimage)
    SELECT '$address','$contact', '$username', '$name', '$age', '$dog_name', '$dog_color', '$dog_age', '$dog_gender', background, dog_image
    FROM dogs_tbl 
    WHERE name = '$dog_name' AND color = '$dog_color' AND age = '$dog_age'";

  
    if ($connection->query($insertSql) === TRUE) {
        // Insertion into adoptionrecords_tbl successful
        $addSuccess = true;
    
        // Retrieve the ID of the inserted record (assuming it's auto-incremented)
        $insertedId = $connection->insert_id;

            // Delete from application_tbl based on dog details
        $deleteFromApplication = "DELETE FROM application_table WHERE 
        dog_name = '$dog_name' AND dog_color = '$dog_color' AND dog_age = '$dog_age'";
        if ($connection->query($deleteFromApplication) !== TRUE) {
        $addSuccess = false;
        echo "Error deleting from application_table: " . $connection->error;
        }

        // Delete from dogs_details based on dog details
        $deleteFromDogsDetails = "DELETE FROM dogs_tbl WHERE 
        name = '$dog_name' AND color = '$dog_color' AND age = '$dog_age'";
        if ($connection->query($deleteFromDogsDetails) !== TRUE) {
        $addSuccess = false;
        echo "Error deleting from dogs_tbl: " . $connection->error;
        }
    } else {
        $addSuccess = false;
        echo "Error inserting into adoptionrecords_table: " . $connection->error;
    }
    $connection->close();
    
}
?>
