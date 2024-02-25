<?php
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

// Check if the form is submitted
if (isset($_POST["btn-forgot-password"])) {
    // Get form input
    $username = $_POST["forgot-username"];
    $securityQuestion = $_POST["forgot_security_question"];
    $securityAnswer = $_POST["forgot_security_answer"];

    // Prepare a SQL statement to retrieve the hashed password, security question, and security answer based on the username
    $sql = "SELECT password, security_question, security_answer FROM user_tbl WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Check if the prepare statement was successful
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbPassword, $dbSecurityQuestion, $dbSecurityAnswer);
        $stmt->fetch();

        if ($securityQuestion === $dbSecurityQuestion && $securityAnswer === $dbSecurityAnswer) {
            // Security question and answer match, generate a new password
            $newPassword = generateRandomPassword(); // You need to implement the function to generate a random password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $updatePasswordSql = "UPDATE user_tbl SET password = ? WHERE username = ?";
            $updatePasswordStmt = $conn->prepare($updatePasswordSql);

            // Check if the prepare statement was successful
            if (!$updatePasswordStmt) {
                die("Prepare failed: " . $conn->error);
            }

            $updatePasswordStmt->bind_param("ss", $hashedPassword, $username);
            $updatePasswordStmt->execute();

            // Close the update statement for resetting the password
            $updatePasswordStmt->close();

            // Reset the login attempts to zero
            $resetAttemptsSql = "UPDATE user_tbl SET login_attempts = 0 WHERE username = ?";
            $resetAttemptsStmt = $conn->prepare($resetAttemptsSql);

            // Check if the prepare statement was successful
            if (!$resetAttemptsStmt) {
                die("Prepare failed: " . $conn->error);
            }

            $resetAttemptsStmt->bind_param("s", $username);
            $resetAttemptsStmt->execute();

            // Close the update statement for resetting attempts
            $resetAttemptsStmt->close();

            // Display the new password to the user
            $resultContent = "Password reset successfully. Your new password is: " . $newPassword;
        } else {
            // Security question and answer do not match, set an error message
            $resultContent = "Security question and answer do not match. Please try again.";
        }
    } else {
        // User not found in the database, set an error message
        $resultContent = "User not found. Please try again.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Open the result modal and set the result content
    echo '<script>';
    echo 'alert("' . $resultContent . '");';
    echo '</script>';
}

// Function to generate a random password
function generateRandomPassword() {
    // Implement a random password generation logic here, e.g., using random characters
    return "newpassword123"; // Replace with your implementation
}
?>
