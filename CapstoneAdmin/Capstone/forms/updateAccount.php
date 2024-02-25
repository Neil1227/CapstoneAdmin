
<?php
if (isset($_POST["btn-updateInfo"])) {
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

    // Handle form data submission, update the database with the new data
    $newFirstName = $_POST["firstname"];
    $newLastName = $_POST["lastname"];
    $newMiddleName = $_POST["middlename"];
    $newAddress = $_POST["address"];
    $newAge = $_POST["age"];
    $newSex = $_POST["sex"];
    $newOwnsDog = $_POST["owns_dog"];

    // Update the database with the new data
    $updateQuery = "UPDATE user_tbl SET first_name = ?, last_name = ?, middle_name = ?, address = ?, age = ?, sex = ?, owns_dog = ? WHERE username = ?";

    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("ssssssss", $newFirstName, $newLastName, $newMiddleName, $newAddress, $newAge, $newSex, $newOwnsDog, $loggedInUsername);

        if ($stmt->execute()) {
            $updateResult = "success"; // Success message
        } else {
            $updateResult = "error"; // Error message
        }
        $stmt->close();
    } else {
        $updateResult = "error"; // Error message
    }

    // Close the database connection
    $conn->close();
}

?>
