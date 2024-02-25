<?php
// Initialize error message
$error_message = "";

if (isset($_POST["btn_reg"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acv_db";

    // Get user input
    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $user_name = $_POST['username'];
    $pass_word = $_POST['password'];
    $pass_word_reentered = $_POST['re-password'];
    $owns_dog = $_POST['owns_dog'];
    $security_question = $_POST['security_question']; 
    $security_answer = $_POST['security_answer'];
   

    // Validate password length (at least 8 characters)
    if (strlen($pass_word) < 8) {
        echo "<script>alert('Password must be at least 8 characters long.')</script>";
        $error_message = "Password must be at least 8 characters long.";
    } else {
        // Check if the password and re-entered password match
        if ($pass_word !== $pass_word_reentered) {
            echo "<script>alert('Passwords do not match. Please re-enter your password.')</script>";
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
            $sql_check_username = "SELECT * FROM user_tbl WHERE username = ?";
            $stmt_check_username = $conn->prepare($sql_check_username);
            $stmt_check_username->bind_param("s", $user_name);
            $stmt_check_username->execute();
            $result_check_username = $stmt_check_username->get_result();

           if ($result_check_username->num_rows > 0) {
                // Username already exists, set an error message
                echo "<script>alert('Username already exists. Please sign up again.');</script>";
                $error_message = "Username already exists. Please sign up again.";
            } else {
                // Insert a new record using prepared statement
                $sql_insert_user = "INSERT INTO user_tbl (first_name, middle_name, last_name, age, sex, address, username, password, owns_dog, security_question, security_answer)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert_user = $conn->prepare($sql_insert_user);
                $stmt_insert_user->bind_param("sssssssssss", $fname, $mname, $lname, $age, $sex, $address, $user_name, $hashed_password, $owns_dog, $security_question, $security_answer);

                if ($stmt_insert_user->execute()) {
                    // User created successfully, set a session and display a success message
                    $_SESSION['logged_in'] = true;
                    $_SESSION["username"] = $user_name;
                    
                    header("Location: mainHome.php");
                    exit();
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
