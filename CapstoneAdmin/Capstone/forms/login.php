<?php
if (isset($_POST["btn-log"])) {
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

    // Get the username and password from the user input using $_POST
    $user = $_POST["u_name"];
    $pass = $_POST["p_word"];

    // Check if the user is disabled (login_attempts >= 3)
    $sqlCheckDisabled = "SELECT login_attempts FROM user_tbl WHERE username = ?";
    $stmtCheckDisabled = $conn->prepare($sqlCheckDisabled);
    $stmtCheckDisabled->bind_param("s", $user);
    $stmtCheckDisabled->execute();
    $stmtCheckDisabled->bind_result($loginAttempts);
    $stmtCheckDisabled->fetch();
    $stmtCheckDisabled->close();

    if ($loginAttempts >= 3) {
        // User is disabled, show a message or redirect to an appropriate page
        echo "<script>alert('Account is disabled. Please reset your password to recover your account')</script>";
    } else {
        // Retrieve the hashed password and admin status from the database based on the username
        $sql = "SELECT password, admin FROM user_tbl WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($hashedPassword, $isAdmin);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($pass, $hashedPassword)) {
            // Set the 'logged_in' session variable to indicate the user is logged in
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user; // You can store other user data in the session as well

            // Reset login attempts on successful login
            $sqlResetAttempts = "UPDATE user_tbl SET login_attempts = 0 WHERE username = ?";
            $stmtResetAttempts = $conn->prepare($sqlResetAttempts);
            $stmtResetAttempts->bind_param("s", $user);
            $stmtResetAttempts->execute();
            $stmtResetAttempts->close();

            // Redirect based on whether the user is an admin or not
            if ($isAdmin == 1) {
                // If the user is an admin, redirect to the admin site
                header("Location: \CapstoneAdmin/adminLogin.php");
            } else {
                // If the user is not an admin, redirect to the main site
                header("Location: mainHome.php");
            }
            exit();
        } else {
            // Invalid credentials
            echo "<script>alert('Invalid username or password. Please try again.')</script>";

            // Increment the login attempts counter
            $sqlIncrementAttempts = "UPDATE user_tbl SET login_attempts = login_attempts + 1 WHERE username = ?";
            $stmtIncrementAttempts = $conn->prepare($sqlIncrementAttempts);
            $stmtIncrementAttempts->bind_param("s", $user);
            $stmtIncrementAttempts->execute();
            $stmtIncrementAttempts->close();
        }
    }

    // Close the connection
    $conn->close();
}
?>
