<?php 
if (isset($_POST['submit'])) {
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

    $maxsize = 52428800; // Example maximum file size: 50MB

    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '' &&
    isset($_POST['fullname']) && isset($_POST['username']) &&
    isset($_POST['contact']) && isset($_POST['address'])){

        $fullName = $_POST['fullname'];
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $dogname = $_POST['dogname'];

        $name = $_FILES['file']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/CapstoneAdmin/Capstone/assets/img/vid/';
        $target_file = $target_dir . $name;
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

        if (in_array($extension, $extensions_arr)) {
            if ($_FILES['file']['size'] >= $maxsize){
                $updateSuccess = "File size too large";
            } else {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                    
                    $sql = "INSERT INTO video_update (fullname, username, contact, address,dogname, name, video)
                    VALUES (
                        '" . mysqli_real_escape_string($conn, $fullName) . "',
                        '" . mysqli_real_escape_string($conn, $username) . "',
                        '" . mysqli_real_escape_string($conn, $contact) . "',
                        '" . mysqli_real_escape_string($conn, $address) . "',
                        '" . mysqli_real_escape_string($conn, $dogname) . "',
                        '" . mysqli_real_escape_string($conn, $name) . "',
                        '" . mysqli_real_escape_string($conn, $target_file) . "'
                    )";
            
            
                    if(mysqli_query($conn, $sql)){
                        $updateSuccess = "Video Uploaded successfully!";
                    } else {
   
                        $updateSuccess = "Failed to insert into database . Error: " . mysqli_error($conn);
                    }
                } else {
                    $updateSuccess = "Failed to upload the file";
                }
            }
        } else {
            $updateSuccess = "Invalid file extension";
        }
    } else {
        $updateSuccess = "Please select a file";
    }

}
?>
