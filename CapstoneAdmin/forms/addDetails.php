<?php
$add_Success = '';

if (isset($_POST["Add"])) {
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
    $name = $_POST['name'];
    $age = $_POST['age'];
    $color = $_POST['color'];
    $gender = $_POST['gender'];
    $date_obtained = $_POST['date_obtained'];
    $background = $_POST['background'];

    // Initialize variables related to image handling
    $imageProvided = !empty($_FILES["dogImageName"]["name"]);
    $targetDir = "Capstone/assets/img/dogs/";
    $targetFile = $targetDir . basename($_FILES["dogImageName"]["name"]);

    // Check if an image is provided
    if ($imageProvided && move_uploaded_file($_FILES["dogImageName"]["tmp_name"], $targetFile)) {
        $addSuccess = "The file " . htmlspecialchars(basename($_FILES["dogImageName"]["name"])) . " has been uploaded.";

        // Read the image file
        $imageData = file_get_contents($targetFile);
    } else {
        $addSuccess = "Record added successfully without an image.";
        $imageData = null; // No image provided, setting image data to null
    }

    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO dogs_tbl (name, age, color, gender, date_obtained, background, dog_image) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $null = null;
    $stmt->bind_param("ssssssb", $name, $age, $color, $gender, $date_obtained, $background, $null);

    if ($imageProvided) {
        $stmt->send_long_data(6, $imageData);
    }

    // Execute the statement
    if ($stmt->execute()) {
        if ($imageProvided) {
            $addSuccess = "Record added successfully with an image!";
        } else {
            $addSuccess = "Record added successfully without an image.";
        }
    } else {
        $addSuccess = "Error: Unable to add the record. " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}


?>

