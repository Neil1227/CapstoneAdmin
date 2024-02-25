<?php
$updateSuccess = '';

if (isset($_POST["Edit"])) {
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
    $id = $_POST['id']; // Assuming the ID of the record you want to update
    $name = $_POST['name'];
    $age = $_POST['age'];
    $color = $_POST['color'];
    $gender = $_POST['gender'];
    $date_obtained = $_POST['date_obtained'];
    $background = $_POST['background'];

    // Initialize variables related to image handling
    $imageProvided = !empty($_FILES["dogImageNameEd"]["name"]);
    $targetDir = "Capstone/assets/img/dogs/";
    $targetFile = $targetDir . basename($_FILES["dogImageNameEd"]["name"]);

    // Check if an image is provided
    if ($imageProvided) {
        if (move_uploaded_file($_FILES["dogImageNameEd"]["tmp_name"], $targetFile)) {
            $updateSuccess = "Record updated successfully with a new image!";
            $imageData = file_get_contents($targetFile);

            // Update query with the new image
            $sql = "UPDATE dogs_tbl SET name=?, age=?, color=?, gender=?, date_obtained=?, background=?, dog_image=? WHERE id=?";
            
            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $null = null;
            $stmt->bind_param("sssssssi", $name, $age, $color, $gender, $date_obtained, $background, $imageData, $id);
        } else {
            $updateSuccess = "Error moving uploaded file. Record updated without changing the image.";
            // Update query without changing the image
            $sql = "UPDATE dogs_tbl SET name=?, age=?, color=?, gender=?, date_obtained=?, background=? WHERE id=?";
            
            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $name, $age, $color, $gender, $date_obtained, $background, $id);
        }
    } else {
        $updateSuccess = "No new image provided. Record updated without changing the image.";

        // Update query without modifying the image field
        $sql = "UPDATE dogs_tbl SET name=?, age=?, color=?, gender=?, date_obtained=?, background=? WHERE id=?";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $age, $color, $gender, $date_obtained, $background, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // Success message already set based on whether an image was provided or not
    } else {
        $updateSuccess = "Error updating record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

?>
