<?php
$error_message = "";
$success_message = "";
if (isset($_POST["btn-adminReg"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acv_db";

    // Get user input
    $user_name = $_POST['createUsername'];
    $pass_word = $_POST['createPassword'];
    $pass_word_reentered = $_POST['confirmPassword'];

    // Validate password length (at least 8 characters)
    if (strlen($pass_word) < 8) {
        $error_message = "Password must be at least 8 characters long.";
    } else {
        // Check if the password and re-entered password match
        if ($pass_word !== $pass_word_reentered) {
            $error_message = "Passwords do not match. Please re-enter your password.";
        } else {
            // Hash the password
            $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Use prepared statements to prevent SQL injection
            $sql_check_username = "SELECT * FROM admin_table WHERE u_name = ?";
            $stmt_check_username = $conn->prepare($sql_check_username);
            $stmt_check_username->bind_param("s", $user_name);
            $stmt_check_username->execute();
            $result_check_username = $stmt_check_username->get_result();

            if ($result_check_username->num_rows > 0) {
                // Username already exists, set an error message
                $error_message = "Username already exists. Please sign up again.";
            } else {
                // Insert a new record using prepared statement
                $sql_insert_user = "INSERT INTO admin_table (u_name, p_word) VALUES (?, ?)";
                $stmt_insert_user = $conn->prepare($sql_insert_user);
                $stmt_insert_user->bind_param("ss", $user_name, $hashed_password);

                if ($stmt_insert_user->execute()) {
                    // User created successfully, display a success message
                    $success_message = "User created successfully.";
                } else {
                    $error_message = "Error: " . $stmt_insert_user->error;
                }
            }

            // Close the database connection
            $conn->close();
        }
    }
}
?>