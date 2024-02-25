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
          <li><a href="mainHome.php">GO BACK</a></li>
          <li><a href="#steps">STEPS</a></li> 
          <li><a href="#dogs">DOGS </a></li>   
          <li class="dropdown">
                    <a href="#" class="d-flex align-items-center  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     
                    <?php echo strtoupper ($_SESSION['username']); ?></a>
                    <ul class="dropdown-menu shadow text-decoration-none">
                        
                        <li><a class="dropdown-item" href="adoptApplication.php">My Dogs</a></li>
                        <li><a class="dropdown-item" href="pendingPage.php">Pending</a></li>
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
          
  <!-- ======= Steps Section ======= -->
  <section id="steps" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Steps</h2>
          <p>Adoption <span> Process</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/steps/step1.jpg"><img src="assets/img/steps/step1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/steps/step2.jpg"><img src="assets/img/steps/step2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/steps/step3.jpg"><img src="assets/img/steps/step3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/steps/step4.jpg"><img src="assets/img/steps/step4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/steps/step5.jpg"><img src="assets/img/steps/step5.jpg" class="img-fluid" alt=""></a></div>
            
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End steps Section -->

  <section id="dogs">
    <div class="container" data-aos="fade-up">
        <div class="section-header" id="cage1">
            <h2>Dogs to Your Home</h2>
            <p>You<span> ADOPT.</span> They Give <span>LOVE.</span></p>
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

            $query = "SELECT * FROM dogs_tbl";
            $query_run = mysqli_query($conn, $query);

            $check_dog = mysqli_num_rows($query_run) > 0;

            if ($check_dog) {
                ?>
                <div class="row justify-content-center">
                    <?php
                    $index = 1; // Initialize index for generating unique IDs
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $modalId = 'imageViewModal_' . $index; // Generate unique modal ID
                        ?>
                        <div class="col-md-4 mt-3">
                            <div class="card " style="border-radius:25px;">
                                <!-- Image Display -->                  
                                <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>" style="display: block; margin: 30px; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dog_image']); ?>" 
                                        class="img-fluid mx-auto d-block" alt="Dog Image" style="max-width: 90%; height: 255px; margin:15px; ">
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Name: <?php echo $row['name']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dog_image']); ?>" 
                                                    class="img-fluid" alt="Dog Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                  <form method="POST" class="mx-3"action="adoptProcess.php?roomID=<?php echo $row['url']?>&role=Audience&name=<?php echo $row['name']; ?>&age=<?php echo $row['age']; ?>&color=<?php echo $row['color']; ?>&gender=<?php echo $row['gender']; ?>&date_obtained=<?php echo $row['date_obtained']; ?>&background=<?php echo $row['background']; ?>">
                                      <div class="card-text" id="displayedData" style="text-align: left;">
                                          <h4 class="card-title">Name: <?php echo ucfirst ($row['name']); ?></h4>
                                          Age: <?php echo $row['age']; ?><br>
                                          Color: <?php echo ucfirst($row['color']); ?><br>
                                          Gender: <?php echo $row['gender']; ?><br>
                                          Date Obtained: <?php echo $row['date_obtained']; ?><br>
                                          Breed: <?php echo ucfirst ($row['background']); ?><br>

                                          <!-- Hidden input field to pass the image data -->
                                          <input type="hidden" name="dog_image" value="<?php echo base64_encode($row['dog_image']); ?>">

                                          <!-- Other form fields -->
                                          <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                          <input type="hidden" name="age" value="<?php echo $row['age']; ?>">
                                          <input type="hidden" name="color" value="<?php echo $row['color']; ?>">
                                          <input type="hidden" name="gender" value="<?php echo $row['gender']; ?>">
                                          <input type="hidden" name="date_obtained" value="<?php echo $row['date_obtained']; ?>">
                                          <input type="hidden" name="background" value="<?php echo $row['background']; ?>">

                                          <!-- Submit button -->
                                          <button type="submit" class="btn btn-danger mt-3 float-end">View</button>
                                      </div>
                                  </form>
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
                echo "No Available Dogs Found";
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