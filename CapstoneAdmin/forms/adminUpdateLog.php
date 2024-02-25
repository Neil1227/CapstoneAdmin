<?php
// Initialize error and success messages
$e_message = "";
$s_message = "";

if (isset($_POST["btn-adminLog"])) {
    // Get user input
    $new_username = $_POST['newUname'];
    $new_password = $_POST['newPassword'];
    $new_password_reentered = $_POST['cPassword'];

    // Validate password length and match
    if (strlen($new_password) < 8) {
        $e_message = "Password must be at least 8 characters long.";
    } elseif ($new_password !== $new_password_reentered) {
        $e_message = "New passwords do not match. Please re-enter your password.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Perform the update
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "acv_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $user_identifier = $_SESSION['user'];

        // Update the user's username and password without specifying a unique identifier
        $sql = "UPDATE admin_table SET u_name = ?, p_word = ? WHERE u_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $new_username, $hashed_password, $user_identifier);

        if ($stmt->execute()) {
            $s_message = "User information updated successfully.";
            $_SESSION['user'] = $new_username; // Update the session with the new username
        } else {
            $e_message = "Error: " . $stmt->error;
        }

        $conn->close();
    }
}
?>