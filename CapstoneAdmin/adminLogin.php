<?php
session_name('admin_session');
session_start(); // Start the session

if (isset($_POST["login"])) {
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

  // Get the username from the user input
  $user = $_POST["username"];
  $pass = $_POST["password"];

  // Use prepared statements to prevent SQL injection
  $sql = "SELECT u_name, p_word FROM admin_table WHERE u_name=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $user);

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      // User exists, get the hashed password
      $row = $result->fetch_assoc();
      $hashed_password = $row["p_word"];
      
      if (password_verify($pass, $hashed_password)) {
          // Password matches, login successful
          $_SESSION["user"] = $user; // Set the user session
          header('Location: adminTable.php');
          exit(); // Ensure no further code execution after the redirection
      } else {
          // Password does not match
          header("Location: adminLogin.php?error=Incorrect Password");
          exit();
      }
  } else {
      // User does not exist
      header("Location: adminLogin.php?error=Username not found");
      exit();
  }
 
  $stmt->close();
  $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CityVet Angeles City</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logomini.png" rel="icon">
  
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  
  <!-- Main CSS File -->
  <link href="assets/css/errorLogin.css" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/fav.jpg">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  
</head>


<body>
   



<style>
    /* Common styles for the sidebar */
    .sidebar {
        background-color: #eee;
        position: fixed;
        padding: 20px;
        top: 0;
        height: 100%;
        z-index: 999;
        transition: width 0.3s; /* Add smooth transition for width changes */
    }

    .sidebar a {
        color: #37373f;
    }

    .sidebar a:hover {

    font-family: var(--font-secondary);
    font-size: 16px;
    font-weight: 600;
    color:  #ce1212;
    white-space: nowrap;
    }


    .login{
        margin-left: 100px;
        margin-top: 50px;
        
    }
    /* Larger screens (min-width: 993px) */
    @media (min-width: 993px) {
        .sidebar {
            width: 230px; /* Adjust the width as needed */
        }

        #main {
            margin-left: 65px; /* Adjust the value to match the sidebar width */
            padding: 10px;
        }
    }


  /* Smaller screens (max-width: 992px) */
@media (max-width: 992px) {
    .sidebar {
        z-index: 999;
        overflow-y: auto;
        
    }

    #main {
        margin-left: 0; /* Adjust main content to the left */
    }


}
</style>



 <div class="container-fluid">
    <div class="row flex-nowrap ">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <div class="pb-4 mb-4">
                    <a href="#" class="d-flex align-items-center text-decoration-none mt-3" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/img/logomini.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <h5 style="color: #37373f";><span class="d-none d-sm-inline mx-1">Admin Login</span></h5>
                    </a>
                    
                </div>
    <hr/>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="adminTable.php" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Dog Records</span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a href="userTable.php" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-file-earmark-spreadsheet"></i> <span class="ms-1 d-none d-sm-inline">User Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="adoptionRecords.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-bookmarks"></i> <span class="ms-1 d-none d-sm-inline">Adoption Records</span></a>
                    </li>
                    <li>
                        <a href="applicationTable.php" class="nav-link px-0 align-middle ">
                            <i class="fs-4  bi-archive"></i> <span class="ms-1 d-none d-sm-inline">Application Records</span></a>
                    </li>

                    <li>
                        <a href="acceptedTable.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-bookmark-check"></i> <span class="ms-1 d-none d-sm-inline">Qualified Records</span> </a>
                    </li> 
                    <li>
                        <a href="unqualifiedTable.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-bookmark-x"></i> <span class="ms-1 d-none d-sm-inline">Unqualified Records</span> </a>
                           
                    </li>
                    <li>
                        <a href="deceasedRecords.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-bookmark-dash"></i> <span class="ms-1 d-none d-sm-inline">Deceased Records</span> </a>
                           
                    </li>
                   
                    <li>
                        <a href="admin-edit-profile.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-person"></i> <span class="ms-1 d-none d-sm-inline">Account Settings</span></a>
                    </li>
                    
                    <li>
                        <a href="logout.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Sign out</span> </a>
                    </li>
                </ul>

               
            </div>
        </div>


<div class="col py-3">

<!-- ======= Login Section ======= -->
<section class="login">
  <div class="container" data-aos="fade-up">
    <section class=" d-flex justify-content-center align-items-center" style=" border-radius: 1rem;">
      <div class="col-md-6 col-lg-7">
        <div class="card container-box" style="border-radius: 1rem; ">
          <div class="card-body p-4 p-lg-5 text-black">
            <form method="post" autocomplete="off">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign in</h3>
              <div class="form-outline mb-4">
                <input   type="text" name="username" id="form2Example17" class="form-control form-control-lg" />
                <label class="form-label"  for="form2Example17">Username </label>
              </div>
              <div class="form-outline mb-4">
                <input  type="password" name="password"  id="form2Example27" class="form-control form-control-lg" />
                <label class="form-label"  for="form2Example27 required=">Password </label>
              </div>
              <?php if (isset($_GET['error'])) { ?>
     		        <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>
              <div class="pt-1 mb-4">
                <button type="submit" class="btn btn-outline-danger" name="login" href="#">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- End Section -->
    
  

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/js/admin.js"></script>






</body>

</html>