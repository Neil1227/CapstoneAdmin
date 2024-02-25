<?php
session_name('admin_session');
session_start();

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION["user"])) {
    header("Location: adminLogin.php");
    exit();
}
?>
<?php
include './forms/adminUpdateLog.php';
include './forms/adminReg.php';
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

  <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/fav.jpg">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  

</head>


<body>
    
 <?php
 include './modals/sidebar.php';
 ?>
<div class="col py-3">
    <main id="main">

<section id="add" class="hero d-flex align-items-center" style="padding-top: 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-6  container-record p-4" style="width: 80%;">

        <h2><span>Account</span> Settings</h2>
        <hr/>
        <?php
              if (!empty($error_message)) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $error_message .
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              } elseif (!empty($success_message)) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $success_message . 
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }
             
              ?>
              <?php
               if (!empty($e_message)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $e_message .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } elseif (!empty($s_message)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $s_message . 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
              ?>
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body">
              <h3>Update Account</h3>
              <form action="#" method="post">
                <div class="mb-3 mt-3">
                    <input type="text" class="form-control" id="oldusername" name="oldUname" value="<?php echo ($_SESSION['user']); ?>" placeholder="Current Username">
                </div>  
                <div class="mb-3">
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password">
                </div>
                <hr/>
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="newUname" placeholder="New Username">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="confirmPassword" name="cPassword" placeholder="Confirm New Password">
                </div>
                <button type="submit" name="btn-adminLog" class="btn btn-primary">Save Changes</button>
            </form>

              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body">
                <h3>Create New User</h3>
                <form action="#" method="post">
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="createUsername" name="createUsername" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="createPassword" name="createPassword" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <button type="submit" name="btn-adminReg" class="btn btn-success">Create User</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




  
    </main>
</div><!--end-->



  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/js/admin.js"></script>


 



<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
</body>

</html>