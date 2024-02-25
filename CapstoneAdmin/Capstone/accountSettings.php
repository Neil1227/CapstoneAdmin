<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

// You can also get the user's information from the session, such as username
$loggedInUsername = $_SESSION['username'];

// Continue displaying the protected content of the page
// ...
?>

<?php
include 'forms/contact.php';
include './forms/updateAccount.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Angeles City Vet </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logomini.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style1.css" rel="stylesheet">
 

  <!--Login css file assets-->
  <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/fav.jpg">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-right">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="mainHome.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1  style="margin-left:5px";>Angeles CityVet<span><img src="assets/img/logomini.png" alt="mini logo"></span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="mainHome.php">GO BACK</a></li>
        
          <li class="dropdown">
                    <a href="#" class="d-flex align-items-center  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     
                    <?php echo strtoupper ($_SESSION['username']); ?></a>
                    <ul class="dropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="userLogout.php">Sign out</a></li>
                    </ul>
            </li>
        </ul>
        <style>
          .dropdown-menu .dropdown-item:active {
            background-color: #eee;
        }
        </style>
      </nav><!-- .navbar -->
      
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      
    </div>
  </header><!-- End Header -->

  <main id="main">

  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container ">
    <div class="section-header">
        <p>Users' <span>Settings</span></p>
      </div>
      <center>
            <style>
            /* Style for the active list item when clicked */
            .options .list-group-item.active, .options .list-group-item:active {
                background-color: #ce1212; /* Set your desired background color for active items */
                color: #fff; /* Set the text color for active items */
                border-color: #ce1212;
            }
        </style>
        <div class="card overflow-hidden shadow mb-5 pb-3 " style="width: 70%;">
            <div class="row no-gutters row-bordered row-border-light" >
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links options">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change username and password</a>
                       
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            
                            <hr class="border-light m-0">
                            <div class="card-body">
                                     <!-- Registration form fields -->
                                <!-- Registration form fields -->
                                <form method="post" action="#">
                                <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "acv_db";
 
                                    try {
                                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        // Get the user's information based on their username stored in the session
                                        $loggedInUsername = $_SESSION['username'];

                                        $query = "SELECT * FROM user_tbl WHERE username = :username";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(':username', $loggedInUsername);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                                        } else {
                                            // Handle the case where the user is not found
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>

                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Users' Information</h5>
                                <div id="updateStatus" class="mt-2"></div> 
                                <div id="changeInfo" class="mt-2"></div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-outline mb-4">
                                            <input type="text" name="firstname" class="form-control form-control-md" placeholder="First name" 
                                            required value="<?php echo $userData['first_name']; ?>">
                                            <label for="firstname" class="form-label">First name</label></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" name="lastname" class="form-control form-control-md" placeholder="Last name" 
                                                required value="<?php echo $userData['last_name']; ?>">
                                                <label for="lastname" class="form-label">Last name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-outline mb-6">
                                                <input type="text" name="middlename" class="form-control form-control-md" placeholder="Middle name" 
                                                required value="<?php echo $userData['middle_name']; ?>">
                                                <label for="middlename" class="form-label">Middle name</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-outline mb-6">
                                            <input type="text" name="address" class="form-control form-control-md" placeholder="Address" 
                                            required value="<?php echo $userData['address']; ?>">
                                            <label for="address" class="form-label">Address</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-outline mb-4">
                                                <input type="number" name="age" class="form-control" placeholder="Age" 
                                                required value="<?php echo $userData['age']; ?>">
                                                <label for="age" class="form-label">Age</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <select name="sex" class="form-select" 
                                            required value="<?php echo $userData['sex']; ?>">
                                                <option value="" disabled selected>Sex</option>
                                                <option value="male"<?php if ($userData['sex'] === 'male') echo 'selected'; ?>>Male</option>
                                                <option value="female"<?php if ($userData['sex'] === 'female') echo 'selected'; ?>>Female</option>
                                            </select>
                                            <label for="sex" class="form-label">Sex</label>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-outline mb-4">
                                                <input type="number" name="owns_dog" class="form-control" placeholder="No. of own dog(s) if any" 
                                                required value="<?php echo $userData['owns_dog']; ?>">
                                                <label for="owns_dog" class="form-label">No. of own dog(s) if any</label>
                                            
                                            </div>
                                            
                                            <button type="submit" name="btn-updateInfo" class="btn btn-login float-end">Save Changes</button>
                                        </div>                
                                    </div>   
                                </div>
                            </div>  
                        </form>
        
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                            <form action="#" method="post">
                            <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "acv_db";

                                try {
                                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Get the user's information based on their username stored in the session
                                    $loggedInUsername = $_SESSION['username'];

                                    // Fetch user data from the database
                                    $query = "SELECT * FROM user_tbl WHERE username = :username";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->bindParam(':username', $loggedInUsername);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                                    } else {
                                        // Handle the case where the user is not found
                                        die("User not found");
                                    }

                                    if (isset($_POST["btn-UPchange"])) { // Check for form submission
                                        // Handle form data submission and update the database with the new data
                                        $newUsername = $_POST["newUname"];
                                        $currentPassword = $_POST["currentPassword"];
                                        $newPassword = $_POST["newPassword"];
                                        $reenteredPassword = $_POST["reenterPassword"];

                                        $changeInfo = ""; // Initialize alert message variable

                                        // Check if the current password matches the one in the database
                                        if (password_verify($currentPassword, $userData['password'])) {
                                            // Current password is correct

                                            // Check if the new username is different from the old one
                                            if (!empty($newUsername) && $newUsername !== $loggedInUsername) {
                                                $updateUsernameQuery = "UPDATE user_tbl SET username = :newUsername WHERE username = :currentUsername";
                                                $stmt = $pdo->prepare($updateUsernameQuery);
                                                $stmt->bindParam(':newUsername', $newUsername);
                                                $stmt->bindParam(':currentUsername', $loggedInUsername);
                                                $stmt->execute();
                                                $loggedInUsername = $newUsername; // Update the session with the new username
                                                $changeInfo = "success";
                                            }

                                            // Check if new password and confirmation password are provided and match
                                            if (!empty($newPassword) && !empty($reenteredPassword) && $newPassword === $reenteredPassword) {
                                                // Passwords match
                                                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                                                $updatePasswordQuery = "UPDATE user_tbl SET password = :hashedPassword WHERE username = :currentUsername";
                                                $stmt = $pdo->prepare($updatePasswordQuery);
                                                $stmt->bindParam(':hashedPassword', $hashedPassword);
                                                $stmt->bindParam(':currentUsername', $loggedInUsername);
                                                $stmt->execute();
                                                $changeInfo = "success";
                                            } elseif (!empty($newPassword) || !empty($reenteredPassword)) {
                                                // Passwords don't match, don't update the username
                                                $changeInfo = "Password doesn't match";
                                            }
                                        } else {
                                            $changeInfo = "error";
                                        }

                                        // Output the alert message
                                        echo $changeInfo;

                                           // If the update is successful, force logout and display a message
                                            if ($changeInfo === "success") {
                                                session_destroy(); // Destroy the current session
                                                echo '<script>alert("Changes saved successfully. You will be automatically logged out. "); window.location.href = "userLogout.php";</script>';
                                                exit();
                                            }
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>

                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Account Settings</h5>
                             
                                <div class="row">
                                    <!-- First Column (Current Username and New Username) -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="oldusername" name="oldUname" placeholder="Current Username" value="<?php echo $loggedInUsername; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" required>
                                        </div>
                                    </div>
                                    <!-- Second Column (Current Password, New Password, and Re-enter Password) -->
                                    <div class="col-md-6">
                                        
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="username" name="newUname" placeholder="New Username" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" id="reenterPassword" name="reenterPassword" placeholder="Re-enter Password" required>
                                        </div>
                                        <button type="submit" name="btn-UPchange" class="btn btn-login float-end"  data-bs-target="#confirmationModal">Save Changes</button>
                                    </div>
                                </div>    
                            </form>

                </div>
            </div>
        </div>
        </center>
    </div>  
    
</section>

  </main>
  <!-- End #main -->

<?php
include 'footer.php';
?>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

    <script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
    // Assuming you have a PHP variable $updateResult that indicates the update result
    <?php if (isset($updateResult)) { ?>
    var updateStatus = document.getElementById("updateStatus");
    if ("<?php echo $updateResult; ?>" === "success") {
        updateStatus.innerHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert">Update successful! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else if ("<?php echo $updateResult; ?>" === "error") {
        updateStatus.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Update failed. Please try again. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    // Add a JavaScript function to hide the alert message when the close (X) button is clicked
    updateStatus.addEventListener('closed.bs.alert', function () {
        updateStatus.innerHTML = ''; // Clear the alert message
    });
<?php } ?>
<?php if (isset($changeInfo)) { ?>
    var changeUP = document.getElementById("changeInfo");
    if ("<?php echo $changeInfo; ?>" === "success") {
        changeUP.innerHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert">Username and Password successfully updated! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else if ("<?php echo $changeInfo; ?>" === "Password doesn't match") {
        changeUP.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Passwords does not match or current password incorrect. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    // Add a JavaScript function to hide the alert message when the close (X) button is clicked
    changeUP.addEventListener('closed.bs.alert', function () {
        changeUP.innerHTML = ''; // Clear the alert message
    });
<?php } ?>

</script>



</body>


</html>