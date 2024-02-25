<?php

session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

// You can also get the user's information from the session, such as username
$loggedInUsername = $_SESSION['username'];

?>
<?php
include './forms/formValidation.php';
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
          <li><a href="homeAdopt.php">GO BACK</a></li>   
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
          
 
  <section id="dogs" class="contact">
    <div class="container" data-aos="fade-up"   style="background-color:#fff;">
        <div class="section-header" >
            <h2>Dogs to Your Home</h2>
            <p>You<span> ADOPT.</span> They Give <span>LOVE.</span></p>
        </div>

        <div class="row">
            <div class="col-lg-5 column left" style="background-color:#fff;">

                <div class="mx-3">
                <form action="liveVideo.php?roomID=<?php echo $row['url']?>&role=Audience&name=<?php echo $row['name']; ?>&age=<?php echo $row['age']; ?>&color=<?php echo $row['color']; ?>&gender=<?php echo $row['gender']; ?>&date_obtained=<?php echo $row['date_obtained']; ?>&background=<?php echo $row['background']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="card mb-5 mt-3">
                    <?php
                      // Retrieve the image data and other details from the POST request
                      $imageData = $_POST['dog_image'] ?? '';
                      $name = $_POST['name'] ?? '';

                      // Decode and display the image
                      if ($imageData !== '') {
                        $decodedImageData = base64_decode($imageData);
                        // Display the image using an HTML img tag
                        echo '
                        <a href="#" data-bs-toggle="modal" data-bs-target="#dog" style="display: block; margin: 30px; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                            <img src="data:image/jpeg;base64,' . $imageData . '" alt="Dog Image" class="img-fluid mx-auto d-block" style="max-width: 90%; height: 255px; margin:15px">
                        </a>';
                        
                        // Modal HTML
                        echo '
                        <div class="modal fade" id="dog" tabindex="-1" aria-labelledby="dogLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dogLabel">Name of the Dog: ' . $name . '</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="data:image/jpeg;base64,' . $imageData . '" class="img-fluid" alt="Dog Image">
                                    </div>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo "No image data available.";
                    }
                    ?>
                   
                    <div class="row mb-3 mx-3">

                    <div class="text-center">
                    <a type="button" class="btn btn-danger btn-block mb-4 w-100" href="#live">View Live</a>
                </div>
                        <div class="col-md-4">
                        
                          <label class="form-label">Name:</label>
                          <input type="text" class="form-control" id="name" name="dogname" value="<?php echo ucfirst($_GET['name']); ?>" readonly required>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Dogs' age:</label>
                          <input type="text" class="form-control" id="age" name="age" value="<?php echo ucfirst($_GET['age']); ?>" readonly required>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Color:</label>
                          <input type="text" class="form-control" id="color" name="color" value="<?php echo ucfirst($_GET['color']); ?>" readonly required>
                      </div>
                  </div>
                  <div class="row mb-3 mx-3">
                      <div class="col-md-6">
                          <label class="form-label">Gender:</label>
                          <input type="text" class="form-control" id="gender" name="gender" value="<?php echo ucfirst($_GET['gender']); ?>" readonly required>
                      </div>
                      <div class="col-md-6 ">
                          <label class="form-label">Date Obtained:</label>
                          <input type="date" class="form-control" id="date_obtained" name="date_obtained" value="<?php echo ucfirst($_GET['date_obtained']); ?>" readonly required>
                      </div>
                  </div>
                  <div class="d-grid gap-2 mb-5 mx-4">
                      <label class="form-label">Background:</label>
                      <textarea class="form-control" id="background" name="background" rows="4" readonly required><?php echo ucfirst($_GET['background']); ?></textarea>
                  </div>
                    </div>
                  </form>
                   
              </div>
            </div>
<!--right column-->
            <div class="col-lg-7 column-right " style="background-color:#eee;">

              <form action="#" method="POST" class="mx-3"enctype="multipart/form-data">


             <div class="row mb-3 mt-3 mx-3">
                <div class="col-md-3">
                    <label class="form-label">Dogs' Name:</label>
                    <input type="text" class="form-control" id="name" name="dogname" value="<?php echo ucfirst($_GET['name']); ?>" readonly required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dogs' Color:</label>
                    <input type="text" class="form-control" id="color" name="dogcolor" value="<?php echo ucfirst($_GET['color']); ?>" readonly required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dogs' age:</label>
                    <input type="text" class="form-control" id="age" name="dogage" value="<?php echo ucfirst($_GET['age']); ?>" readonly required>
                </div>    
                <div class="col-md-3">
                    <label class="form-label">Dogs' age:</label>
                    <input type="text" class="form-control" id="gender" name="doggender" value="<?php echo ucfirst($_GET['gender']); ?>" readonly required>
                </div>  
            </div>

            <div class="row mb-3 mt-3 mx-3">
                <div class="col-md-9">
                      <label for="name" class="form-label ">Furparents' Name: *</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="col-md-3">
                      <label for="age" class="form-label">Age: *</label>
                      <input type="number" class="form-control" id="age" name="age" required>
                  </div>
            </div>

                  <div class="row mb-3 mx-3">
                  
                      <div class="col">
                          <label for="birthdate" class="form-label">Birthdate: *</label>
                          <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                      </div>
                      <div class="col">
                          <label for="address" class="form-label">Address: *</label>
                          <input type="text" class="form-control" id="address" name="address" required>
                      </div>
                  </div>

                  <div class="row mb-3 mx-3">
                      <div class="col">
                          <label for="sex" class="form-label">Sex: *</label>
                          <select class="form-select" id="sex" name="sex" required>
                              <option value="" disabled selected>Sex</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="citizenship" class="form-label">Citizenship: *</label>
                          <input type="text" class="form-control" id="citizenship" name="citizenship" required>
                      </div>
                      <div class="col">
                          <label for="contact" class="form-label">Contact No.: *</label>
                          <input type="tel" class="form-control" id="contact" name="contact">
                      </div>
                  </div>

                <div class="row mx-3">

                  <div class="col-md-6 mb-3">
                      <label for="spouse" class="form-label">Spouse Name (if any): </label>
                      <input type="text" class="form-control" id="spouse" name="spouse">
                  </div>

                  <div class="col-md-6 mb-3">
                      <label for="children" class="form-label">Names of Children (if any):</label>
                      <input type="text" class="form-control" id="children" name="children">
                  </div>
                </div>

                <div class="row mb-3 mx-3">
                  <div class="mb-3">
                      <label for="reason" class="form-label">Why do you want to adopt a dog? *</label>
                      <select class="form-select" id="reason" name="reason" required>
                          <option value="" disabled selected>Select a reason</option>
                          <option value="1">I prioritize responsibility and care, committed to being a conscientious pet owner.</option>
                          <option value="2">Thorough research and preparation have confirmed that owning a dog suits my lifestyle.</option>
                          <option value="3">As a parent, I see value in instilling important values like responsibility and empathy in my children through pet ownership.</option>
                          <option value="4">Being an animal enthusiast, I want to make a meaningful difference in supporting animal welfare.</option>
                          <option value="5">Seeking emotional support, I believe a dog can positively impact my mental health.</option>
                          <option value="6">Embracing an active lifestyle, having a dog would encourage more outdoor activities.</option>
                          <option value="7">I just want to adopt for fun. </option>
                        </select>
                  </div>
                </div>

                  <div class="row mb-3 mx-3">
                    <div class="col">
                        <label for="employment_status" class="form-label">Employment Status: *</label>
                        <select class="form-select" id="employment_status" name="employment_status" required>
                            <option value="" disabled selected>Status</option>
                            <option value="employed">Employed</option>
                            <option value="self_employed">Self-Employed</option>
                            <option value="unemployed">Unemployed</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="income_source" class="form-label">Source of Income: *</label>
                        <select class="form-select" id="income_source" name="income_source" required>
                        <option value="" disabled selected>Source</option>
                            <option value="allowance">Allowance</option>
                            <option value="business">Business</option>
                            <option value="employment">Employment</option>
                            <option value="savings">Savings</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="monthly_income" class="form-label">Monthly Income: *</label>
                        <select class="form-select" id="monthly_income" name="monthly_income" required>
                        <option value="" disabled selected>Range</option>
                            <option value="0-1000">0-1000 pesos</option>
                            <option value="1000-3000">1000-3000 pesos</option>
                            <option value="3000-5000">3000-5000 pesos</option>
                            <option value="5000-above">Above 5000 pesos</option>
                        </select>
                    </div>
                </div>

                  <div class="row mb-3 mx-3"> 
                  <div class="form-outline mb-4 col-md-5">
                        <label for="valid_id" class="form-label">Upload Valid ID: *</label>
                        <input type="file" class="form-control"  name="image" id = "image" accept=".jpg, .jpeg, .png" value="" required>
                        <small>*ID must match furparent's details.*</small>
                    </div>   
          
                      <div class="col-md-4">
                      <label for="pets" class="form-label">No. of pets in your house: *</label>
                      <input type="number" class="form-control" id="pets" name="pets" required>
                      </div>
                      
                       <div class="col-md-3">
                        <label class="form-label">Do you visit a veterinarian? *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="veterinarian" id="yes" value="yes" required>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="veterinarian" id="no" value="no" required>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                      </div>
                  </div>

                  <div class="row mb-3 mx-3">
                     <div class="col">
                        <label for="schedule" class="form-label">Add schedule when to visit and pet the dog: *</label>
                          <input type="date" class="form-control" id="schedule" name="schedule" required min="<?php echo date('Y-m-d'); ?>">
                     </div>
                 </div>

                  <!-- Submit Button -->
                  <button type="submit" class="btn btn-danger mt-5 mb-5 float-end mx-4" name="verify">Verify</button>
                  
              </form>
            </div>
            <div id="live">
            <div class="section-header mt-4">
            <h2>Join to LIVE view the dog. </h2>
            <p>Live<span> Dog</span></p>
        </div>
            <iframe id="myIframe" width="100%" height="400"  frameborder="0"></iframe>

<script>
    const iframe = document.getElementById('myIframe');
    iframe.src = 'http://localhost/CapstoneAdmin/livestream.php?roomID=<?php echo $_GET['roomID'];?>&role=Audience';  
</script>

            </div>
        </div>
    </div>
</section>

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

 



</body>


</html>