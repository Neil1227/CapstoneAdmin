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
 include './forms/deceasedDog.php';
 include './forms/newName.php';
 include './forms/uploadUpdate.php';

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
        <h1>Angeles CityVet<span><img src="assets/img/logomini.png" alt="mini logo"></span></h1>
      </a>                    

      <nav id="navbar" class="navbar">
        <ul>
        <li><a href="homeAdopt.php">MORE DOGS</a></li>
          <li><a href="#mydog">MY DOGS</a></li> 
 
          <li class="dropdown">
                    <a href="#" class="d-flex align-items-center  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     
                    <?php echo strtoupper ($_SESSION['username']); ?></a>
                    <ul class="dropdown-menu shadow text-decoration-none">
                        

                        <li><a class="dropdown-item" href="pendingPage.php">Pending</a></li>
                        <li><a class="dropdown-item" href="deceasedDogs.php">Deceased/Lost Dogs</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="accountSettings.php">Settings</a></li>
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
          
  

    <section id="mydog" class="gallery section">
      <div class="container shadow p-4" style="width:90%; margin-top:40px" data-aos="fade-up">

        <div class="section-header mt-3">
          <h2>My Dogs</h2>
          <p>Keep on <span>track</span></p>
        </div>
        <div class="row mt-3">
                      <div id="alertMessage" class="col d-none"></div>
                    </div>
        <div class="section-header">
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
            $loggedInUsername = $_SESSION['username'];

            $query = "SELECT * FROM adoptionrecords_table WHERE username = '$loggedInUsername'";
            $query_run = mysqli_query($conn, $query);
            
            $check_dog = mysqli_num_rows($query_run) > 0;

            if ($check_dog) {
                ?>
                <div class="row justify-content-center">
                    <?php
                    $index = 1; // Initialize index for generating unique IDs
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        
                      if ($index % 2 !== 0) {
                        echo '<div class="row justify-content-center">';
                    }
                        $modalId = 'imageViewModal_' . $index;
                        $namemodalId = 'nameViewModal_' . $index;
                        $cameramodalId = 'cameraViewModal_' . $index;
                        $deceasedmodalId = 'deceasedViewModal_' . $index; // Generate unique modal ID

                        ?>
                        <div class="col-md-6 mt-3">
                        <center>
                        <div class="card shadow" style="width:100%; border-radius:25px;">
                            <div class="row g-0 " >
                                <!-- Column 1 for Image -->
                                <div class="col-md-6 " style="border-right: 1px solid #ccc;">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>"
                                >
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dogimage']); ?>" class="img-fluid mx-auto d-block mt-3 mb-3 " alt="Dog Image" style="width: 100%; height: 255px; object-fit: contain;">
                                    
                                    </a>
                                </div>
                                  <!-- Modal -->
                                  <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true" >
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Name:<?php echo ucfirst($row['dogname']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dogimage']); ?>" 
                                                    class="img-fluid" alt="Dog Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Column 2 for Details -->
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <form method="POST" class="mx-3" action="#">
                                            <div class="card-text" id="displayedData" style="text-align: left;">
                                                <h4 class="card-title"> <?php echo ucfirst($row['dogname']); ?></h4>
                  <hr>
                                                Breed: <?php echo ucfirst ($row['dogbreed']); ?><br>
                                                Color: <?php echo ucfirst($row['dogcolor']); ?><br>
                                                Gender: <?php echo ucfirst ($row['doggender']); ?><br>
                                                Date added: <?php echo $row['date_applied']; ?><br>

                                                <div class="btn-group float-end mb-3">
                                                <a class="btn btn-danger btn-block mt-3" href="#" data-bs-toggle='modal' data-bs-target="#<?php echo $cameramodalId; ?>">
                                                <i class="bi fs-4 bi-send"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-block mt-3" href="#" data-bs-toggle="modal" 
                                                data-bs-target="#<?php echo $namemodalId; ?>" >
                                                <i class="bi fs-4 bi-pencil"></i></a>
                                                <a class="btn btn-outline-danger btn-block mt-3" href="#" data-bs-toggle='modal'  
                                                data-bs-target="#<?php echo $deceasedmodalId; ?>" 

                                                ><i class="bi fs-4 bi-bookmark-dash"></i></a>
                                                
                                                </div>
                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        </center>
                <!--modal for deceased dogs-->
                     <div class="modal fade" id="<?php echo $deceasedmodalId; ?>" tabindex="1" aria-labelledby="<?php echo $deceasedmodalId; ?>Label" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="<?php echo $deceasedmodalId; ?>Label">Deceased/Lost Dogs' Information</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="container">
                                          <form id="dogForm" method="POST" action="#">
                                              <div class="form-group">                                
                                                  <input type="hidden" class="form-control" id="dogID" name="dogID"  required>
                                              </div><div class="form-group">
                                                  <label for="dogName">Dog's Name:</label>
                                                  <input type="text" class="form-control" id="dogName" name="dogname" value="<?php echo ucfirst($row['dogname']); ?>" readonly  required>
                                              </div>
                                              <div class="row">
                                              <div class="form-group col-md-6">
                                                <label for="gender">Gender:</label>
                          
                                                  <input type="text" class="form-control" id="dogGender"  name="doggender" readonly required value="<?php echo $row['doggender']; ?>" > 
                                                    <!-- Add more options if needed -->
                                            </div>

                                                  <div class="form-group col-md-6">
                                                      <label for="breed">Breed:</label>
                                                      <input type="text" class="form-control" id="dogBreed" name="dogbreed" value="<?php echo $row['dogbreed']; ?>" readonly  required >
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="dateOfDeath">Date of Death/Lost:</label>
                                                  <input type="date" class="form-control" id="dateOfDeath" name="dateOfDeath" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="furParentsName">Furparents Name:</label>
                                                  <input type="text" class="form-control" id="furParentsName" name="name" value="<?php echo $row['name']; ?>"  required>
                                              </div>
                                              <div class="row">
                                              <div class="form-group col-6">
                                                  <label for="contactNo">Contact No:</label>
                                                  <input type="text" class="form-control" id="contactNo" name="contactNo" required>
                                              </div>
                                              <div class="form-group col-6">
                                                  <label for="address">Address:</label>
                                                  <input type="text" class="form-control" id="address" name="address" required>
                                              </div>
                                              </div>
                                          
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <button type="submit" name="deceasedDogs" class="btn btn-danger">Submit</button>
                                      <input type="hidden" id="submitId" name="id">
                                  </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!--modal for edit name of dog-->
                      <div class="modal fade" id="<?php echo $namemodalId; ?>" tabindex="1" aria-labelledby="<?php echo $namemodalId; ?>Label" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="<?php echo $namemodalId; ?>Label">New Dogs Name</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="container">
                                          <form id="dogForm" method="POST" action="#">
                                              <div class="form-group">       
                                              <label for="dogName">Dog's Name:</label>                         
                                                  <input type="text" class="form-control" id="dogname" name="dogname" value="<?php echo ucfirst($row['dogname']); ?>" readonly required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="newdogName">New Dog's Name:</label>
                                                  <input type="text" class="form-control" id="newdogName" name="newdogname"  required>
                                              </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <button type="submit" name="newName" class="btn btn-danger">Submit</button>
                                      <input type="hidden" id="submitId" name="id">
                                  </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!--CAMERAMODAL-->
                    <div class="modal fade" id="<?php echo $cameramodalId; ?>" tabindex="-1" aria-labelledby="<?php echo $cameramodalId; ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo $cameramodalId; ?>Label"> <i class="bi fs-4 bi-cloud-upload"></i> Upload Video Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="#" method="POST" id="myform" enctype="multipart/form-data">
                                    <input type="file" id="environment" name="file" capture="environment" accept="video/*" />
                                    
                                    <br/>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control" name="dogname" value="<?php echo $row['dogname']; ?>" >
                                        <input type="hidden" class="form-control" name="username" value="<?php echo $row['username']; ?>" >
                                        <input type="hidden" class="form-control" name="fullname" value="<?php echo $row['name']; ?>" >
                                        <input type="hidden" class="form-control" name="address" value="<?php echo $row['address']; ?>" >
                                        <input type="hidden" class="form-control" name="contact" value="<?php echo $row['contact']; ?>" >

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" value="Upload" class="btn btn-danger">Submit</button>
                                        <input type="hidden" id="submitId" name="id">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        </div>
                        <?php
                        $index++; // Increment index for the next dog
                    }
                  
                    ?>
                    
                </div>
                
                <?php
                
            } else {
                echo "No adopted dogs found, Please wait for SMS/Phone call from the <br>Angeles city vet if qualified being a furparent! ";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
      </div>

    </section>

</main>
  <?php
include 'footer.php';
?>

<script>
    // JavaScript to display an alert message
    function displayAlertMessage(message) {
        var alertMessage = document.getElementById("alertMessage");
        alertMessage.innerHTML =
            '<div class="alert alert-success alert-dismissible fade show" role="alert">' + message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        alertMessage.classList.remove("d-none"); // Remove the "d-none" class to make the message visible
    }

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($updateSuccess)) {
                echo 'displayAlertMessage("' . $updateSuccess . '");';
            }
            if (isset($addSuccess)) {
                echo 'displayAlertMessage("' . $addSuccess . '");';
            }
            if (isset($deleteSuccess)) {
              echo 'displayAlertMessage("' . $deleteSuccess . '");';
          }

        }
        ?>
        
</script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.7.0/js/bootstrap.min.js"></script>
 



</body>


</html>