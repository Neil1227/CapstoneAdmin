<?php
if (isset($_POST["btn_edit-user"])) {
    // Get user ID and other form data
    $user_id = $_POST['user_id'];
    $newFirstName = $_POST['firstname'];
    $newLastName = $_POST['lastname'];
    $newMiddleName = $_POST['middlename'];
    $newAddress = $_POST['address'];
    $newAge = $_POST['age'];
    $newSex = $_POST['sex'];
    $newOwnsDog = $_POST['owns_dog'];

    // Create a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acv_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the user's details in the database using a prepared statement
    $updateQuery = "UPDATE user_tbl SET first_name = ?, last_name = ?, middle_name = ?, address = ?, age = ?, sex = ?, owns_dog = ? WHERE user_id = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $newFirstName, $newLastName, $newMiddleName, $newAddress, $newAge, $newSex, $newOwnsDog, $user_id);

    if ($stmt->execute()) {
        $updateSuccess = true;
    } else {
        $updateSuccess = false;
        echo "Error updating data: " . $stmt->error . "";
    }

    $stmt->close();
    $conn->close();
}
?>
