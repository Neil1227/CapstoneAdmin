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
          <li><a href="adoptApplication.php">GO BACK</a></li>
          <li><a href="#mydog">DECEASED DOGS</a></li> 
 
          <li class="dropdown">
                    <a href="#" class="d-flex align-items-center  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     
                    <?php echo strtoupper ($_SESSION['username']); ?></a>
                    <ul class="dropdown-menu shadow text-decoration-none">
                        
                        <li><a class="dropdown-item" href="accountSettings.php">Settings</a></li>
                        <li><a class="dropdown-item" href="adoptApplication.php">My Dogs</a></li>
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
    <section id="mydog" class="gallery section">
      <div class="container shadow p-4" style="width:90%; margin-top:40px" data-aos="fade-up">

        <div class="section-header mt-3">
          <h2>My Dogs</h2>
          <p>Deceased/Lost <span>Dogs</span></p>
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

            $query = "SELECT * FROM deceaseddogs_table WHERE username = '$loggedInUsername'";
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
                        $modalId = 'imageViewModal_' . $index; // Generate unique modal ID
                        ?>
                        <div class="col-md-6 mt-3">
                        <center>
                        <div class="card disabled " style="width:100%; pointer-events: none; opacity: 0.5;  border-radius:25px;">
                            <div class="row g-0 " >
                                <!-- Column 1 for Image -->
                                <div class="col-md-5 " style="border-right: 1px solid #ccc;">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dogImage']); ?>" class="img-fluid mx-auto d-block mt-3 mb-3 " alt="Dog Image" style="width: 100%; height: 255px; object-fit: contain;">
                                    </a>
                                </div>
                                  <!-- Modal -->
                                  <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Name: <?php echo $row['dogName']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['dogImage']); ?>" 
                                                    class="img-fluid" alt="Dog Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Column 2 for Details -->
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <form method="POST" class="mx-3" action="#">
                                            <div class="card-text" id="displayedData" style="text-align: left;">
                                                <h4 class="card-title">Name: <?php echo $row['dogName']; ?></h4>
                                                Breed: <?php echo $row['dogBreed']; ?><br>
                                                Gender: <?php echo $row['dogGender']; ?><br>
                                                Date died: <?php echo $row['dateofDeath']; ?><br>

                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        </center>

                     
                        </div>
                        <?php
                        $index++; // Increment index for the next dog
                    }
                    ?>
                </div>
                <?php
            } else {
                echo "No deceased dogs found";
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
            if (isset($addSuccess)) {
                echo 'displayAlertMessage("' . $addSuccess . '");';
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