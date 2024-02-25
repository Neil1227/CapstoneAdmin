<?php
session_start();


include './forms/registration.php';
include './forms/login.php';
include './forms/forgot_password.php';
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
  <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/fav.jpg">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-right">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1>Angeles CityVet<span><img src="assets/img/logomini.png" alt="mini logo"></span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">HOME</a></li>
          <li><a href="#faq">FAQ </a></li>
          <li><a href="#about">ABOUT US</a></li>
          <li><a href="#contact">CONTACT</a></li>
        </ul>
      </nav><!-- .navbar -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">

  <!-- ======= Hero Login Section ======= -->
 <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container ">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-6 order-1 order-lg-2 text-center text-lg-start">
                <img src="assets/img/logo.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>

            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start content-pad">
                <p data-aos="fade-up" style="font-size: 3rem; color: var(--color-default)">Compassionate Hearts, Safe Paws: <br>Providing Loving Homes for Dogs <i class="fa fa-paw" style="color: #ce1212" aria-hidden="true"></i></p>
                <p data-aos="fade-up" data-aos-delay="100">Join us in our mission to make every adoption story a tale of love, happiness, and secure paws. Because when technology meets compassion, hearts – both human and canine – find their forever homes.</p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="btn-login" data-bs-toggle="modal" data-bs-target="#loginModal" >Get Started!</a>
                </div>
            </div>
        </div>
    </div>

    <!--Login modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <div class="d-flex align-items-center mb-3 pb-1">
        <strong><h3>CityVet<span><img src="assets/img/logomini.png" alt="mini logo" style="width: 15%; height: auto;"></span></h3>
        </strong>
      </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
          <!-- login form fields -->
          <form method="post" action="#" autocomplete="off" >
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="text" id="form2Example17" class="form-control form-control-lg" name="u_name" placeholder="Enter Username"; />                
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="p_word" placeholder="Enter Password"/>
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-login" type="submit" name ="btn-log" >Login</button>
                  </div>
                  <a class="small text-muted" href="#"  data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot password?</a>
                  <p class="mb-5 pb-lg-2">Don't have an account? <a href="#" 
                  data-bs-toggle="modal" data-bs-target="#registerModal"
                      style="color: #393f81;">Register here</a></p>
                </form>
      </div>
    </div>
  </div>
</div>
    
<!-- Registration modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center mb-3 pb-1">
          <strong>
            <h3>CityVet<span><img src="assets/img/logomini.png" alt="mini logo" style="width: 15%; height: auto;"></span></h3>
          </strong>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Registration form fields -->
        <form method="post" action="#" class="form-pad" enctype="multipart/form-data";>
          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register account</h5>

          <div class="form-outline mb-4">
            <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name *" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="middlename" class="form-control form-control-lg" placeholder="Middle name" >
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last name *" required="">
          </div>

          <div class="row mb-3">
            <div class="col-md-6 mt-3">
              <input type="number" name="age" class="form-control form-control-lg" placeholder="Age *" required="">
            </div>

            <div class="col-md-6 mt-3">
              <select name="sex" class="form-select form-control-lg" required="">
                  <option value="" disabled selected>Sex *</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
              </select>
          </div>
          
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="address" class="form-control form-control-lg" placeholder="Address *" required="">
          </div>
          <div class="form-outline mb-4">
            <input type="number" name="owns_dog" class="form-control" placeholder="No. of own dog(s) if any *" required="">
          </div>
          <div class="form-outline mb-4">
            <input type="text" name="username" class="form-control form-control-lg" placeholder="Username *" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password *" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="password" name="re-password" class="form-control form-control-lg mb-3" placeholder=" Re-enter Password *" required="">
            <?php
             if (!empty($error_message)) {
                 echo '<div class="alert alert-danger alert-dismissible">
                          
                          ' . $error_message . '
                       </div>';
             } elseif (!empty($success_message)) {
                 echo '<div class="alert alert-success alert-dismissible">
                          
                          ' . $success_message . '
                       </div>';
             }
             ?>
          </div>
          <div class="form-outline mb-4">
            <select name="security_question" class="form-select form-control-lg" required="">
              <option value="" disabled selected>Select a Security Question *</option>
              <option value="q1">What is your mother's maiden name?</option>
              <option value="q2">What is the name of your first pet?</option>
              <option value="q3">In what city were you born?</option>
              <option value="q4">What is your favorite book?</option>
              <option value="q5">What is your favorite movie?</option>
              <!-- Add more security questions here -->
            </select>
            <input type="text" name="security_answer" class="form-control form-control-lg mt-3" placeholder="Answer *" required="">
          </div>


          <div class="pt-1 mb-4">
            <button class="btn btn-login" name="btn_reg" type="submit">Register now!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Forgot Password modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center mb-3 pb-1">
          <strong><h3>CityVet<span><img src="assets/img/logomini.png" alt="mini logo" style="width: 15%; height: auto;"></span></h3></strong>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Forgot Password form fields -->
        <!-- Forgot Password form fields -->
      <form method="post" action="#" id="forgotPasswordForm">
          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h5>

          <div class="form-outline mb-4">
              <input type="text" name="forgot-username" class="form-control form-control-lg" placeholder="Username" required="">
          </div>

          <div class="form-outline mb-4">
              <select name="forgot_security_question" class="form-select">
                  <option value="" disabled selected>Select a Security Question</option>
                  <option value="q1">What is your mother's maiden name?</option>
                  <option value="q2">What is the name of your first pet?</option>
                  <option value="q3">In what city were you born?</option>
                  <option value="q4">What is your favorite book?</option>
                  <option value="q5">What is your favorite movie?</option>
              </select>
          </div>

          <div class="form-outline mb-4">

          <input type="text" id="forgot_security_answer" class="form-control form-control-lg" name="forgot_security_answer" />

              <label class="form-label">Security Answer</label>
          </div>

          <div id="securityAnswerMessage" class="text-danger"></div>

          <div class="pt-1 mb-4">
              <button class="btn btn-login" type="submit" name="btn-forgot-password">Retrieve Password</button>
          </div>
      </form>

      </div>
    </div>
  </div>
</div>

<!-- Result modal -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultModalLabel">Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="resultModalBody">
        <!-- Result content will be displayed here -->
      </div>
    </div>
  </div>
</div>



</section>

      <!-- End Hero Section -->



     <!-- ======= Why Us Section ======= -->
     <section id="faq" class="why-us">
      <div class="section-header">
        <h2>FAQ</h2>
        <p>Frequently Asked <span>Questions</span></p>
      </div>

    <div class="container" data-aos="fade-up">
      <div class="row gy-4">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-box">
            <h3>Why Angeles City Vet?</h3>
            <p>
            Angeles City Vet is currently the only dog pound that provides free spay/neuter services and basic medical treatments accredited by BAI to operate.
            </p>
          </div>
        </div><!-- End Why Box -->

        <div class="col-lg-8 d-flex align-items-center">
          <div class="row gy-4">

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="fa fa-paw" aria-hidden="true"></i>
                <h4>What are the usual breeds <br>of dogs found in the CityVet?</h4>
                <p>
 Aspins, short for "asong Pinoy," are native Philippine dogs known for their resilience, adaptability, and loyal nature.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="fa fa-paw" aria-hidden="true"></i>
                <h4>What are the age range <br>of dogs found in the CityVet?</h4>
                <p>The age range of dogs varies widely. Dogs of all ages, from puppies to adults, can be found in the CityVet Dog Pound.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="fa fa-paw" aria-hidden="true"></i>
                <h4>Have they been neutered/spayed?</h4>
                <p> This service is provided free of charge. Neutering/spaying is a vital procedure that helps control the population of stray animals.</p>
              </div>
            </div><!-- End Icon Box -->

          </div>
        </div>

      </div>

    </div>
  </section><!-- End Why Us Section -->

 <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>Learn More <span>About Us</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/gallery/aboutimage.jpg); background-size: cover;" data-aos="fade-up" data-aos-delay="150">
            <div class="call-us position-absolute">
              <h4>Visit our Facebook Page!</h4>
              <a href="https://www.facebook.com/ACVeterinaryOffice" target="_blank">Angeles City Veterinary Office </a>
            </div>
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p>
              The City Veterinary Office is committed to ensuring the well-being of animals and the safety of the public. It includes regulating animal care, inspecting food products, and enforcing laws against animal cruelty. 
              </p>
              <ul>Mandates:
                <li><i class="bi bi-check2-all"></i> Regulate and improve the keeping of domestic animals and livestock animals.</li>
                <li><i class="bi bi-check2-all"></i> Regulate and inspect poultry, milk and dairy products for public consumption.</li>
                <li><i class="bi bi-check2-all"></i> Enforce all laws and regulation for the prevention of cruelty to animals.</li>
                <li><i class="bi bi-check2-all"></i> Take the necessary measures to eradicate, prevent or cure all forms of animal diseases.</li>
              </ul>
              <ul>Vision:
                <li><i class="bi bi-check2-all"></i> To reduce, control or eradicate all forms of animal diseases especially rabies and food animal diseases.</li>
                <li><i class="bi bi-check2-all"></i> To become more efficient in performing our duties to be able to protect the meat consuming public and provide healthy living.</li>   
              </ul>
              <p>Mission:</p>
              <p>
              To monitor, regulate and supervise all animal programs by conducting frequent vaccination campaign, also to support the food production programs to fight
              inflation and to improve the economy of the city.
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/gallery/dog.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

        <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="12 " data-purecounter-duration="3" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="50" data-purecounter-end="80" data-purecounter-duration="3" class="purecounter"></span>
              <p>Rescued Dogs</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="3" class="purecounter"></span>
              <p>Shelters for Dogs</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="3" class="purecounter"></span>
              <p>Turn Overed Dogs</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>
    </section><!-- End Stats Counter Section -->




      <!-- ======= Gallery Section ======= -->
      <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>gallery</h2>
          <p>Adoption and<span> Vaccination</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery1.jpg"><img src="assets/img/gallery/gallery1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery2.jpg"><img src="assets/img/gallery/gallery2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery3.jpg"><img src="assets/img/gallery/gallery3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery4.jpg"><img src="assets/img/gallery/gallery4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/g (3).jpg"><img src="assets/img/gallery/g (3).jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/g (1).jpg"><img src="assets/img/gallery/g (1).jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/g (7).jpg"><img src="assets/img/gallery/g (7).jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/g (6).jpg"><img src="assets/img/gallery/g (6).jpg" class="img-fluid" alt=""></a></div>
            
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section> <!--End Gallery Section -->
            
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Need Help? <span>Contact Us</span></p>
        </div>

        <div class="mb-3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3850.8681505322775!2d120.60521707426608!3d15.165583985390464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396edf7f1f8bfe5%3A0x2264b47412ddd267!2sVeterinary%20Office%20-%20Lungsod%20ng%20Angeles!5e0!3m2!1sen!2sph!4v1693555743628!5m2!1sen!2sph"style="border:0; width: 100%; height: 350px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">
          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Our Address</h3>
                <p>City Hall Building, Aniceto Gueco Street, Pulung Maragul, Angeles, 2009</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Message Us</h3>
                <p>https://www.facebook.com/ACVeterinaryOffice</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>893-2212-local-3000-3001-1086</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h3>Opening Hours</h3>
                <div><strong>Mon-Fri:</strong> 8AM - 5PM;
                  <strong>Saturday & Sunday :</strong> Closed
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php
include 'footer.php';
?>


<!--css for scrollbar in the modal register-->

<style>
  /* Add custom CSS for modal scrollbar */
  .modal-body {
    max-height: 70vh; /* Adjust the maximum height as needed */
    overflow-y: auto;
  }
</style>

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
  
    
 

</body>



</html>