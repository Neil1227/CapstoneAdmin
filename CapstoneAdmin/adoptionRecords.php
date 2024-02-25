<?php
session_name('admin_session');
session_start();

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION["user"])) {
    header("Location: adminLogin.php");
    exit();
}


include './forms/deleteAdoption.php';
include './modals/deleteQualModal.php';
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
      <section id="add" class="hero d-flex align-items-center  " style= "padding-top: 0;">
       <div class="container">
              <div class="row">
                  <div class="col-md-12 container-record p-4" style="width:85%">
                    
                  <h2><span>Adoption</span>  records </h2>
                  <div class="row mt-3">
                      <div id="alertMessages" class="col d-none"></div>
                      </div>
                      <hr/>
                      <div class="table-responsive">
                  <table id="table-show" class="table table-striped w-100" style="width:100%">
                      <thead>
                          <tr>
                          <th>Date Added</th>
                              <th>Username</th>
                              <th>Name</th>
                              <th>Age</th>
                              <th>Contact No.</th> 
                              <th>Address</th>
                              <th>Dogs' Name</th>
                              <th>Dogs' Gender</th>  
                              <th>Action</th> 

                          </tr>
                      </thead>
                      <tbody>
      <form action="" method="post">
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "acv_db";
              
                  // Create connection
                  $connection = new mysqli($servername, $username, $password, $dbname);
              
                  // Check connection
                  if ($connection->connect_error) {
                      die("Connection failed: " . $connection->connect_error);
                  }
      
                  
                  $sql = "SELECT * FROM adoptionrecords_table";
                  $result = $connection->query($sql);
      
                  if(!$result){
                    die ("Invalid query: ". $connection->error);
                  }
      
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                      <td>{$row['date_applied']}</td>
                          <td>{$row['username']}</td>
                          <td>{$row['name']}</td>
                          <td>{$row['age']}</td>
                          <td>{$row['contact']}</td> 
                          <td>{$row['address']}</td>     
                          <td>{$row['dogname']}</td>

                         
                          <td>{$row['doggender']}</td>
                          <td>
                          
                          <div class='btn-group float-end'>
                          <a class='btn btn-outline-primary view-dog-image' data-bs-toggle='modal' 
                            data-bs-target='#dogImageModal' data-dog-image='" . base64_encode($row['dogimage']) . "'
                            >
                            <i class='bi bi-eye'></i>
                            </a>
                              <a class='btn btn-outline-danger qual-delete-button' type='submit' href='#' data-bs-toggle='modal' data-bs-target='#deleteAppQualModal' 
                              data-id=' {$row['id']};'
                              data-date_applied=' {$row['date_applied']};' 
                              data-name=' {$row['name']};' 
                              data-age=' {$row['age']};'  
                              data-contact=' {$row['contact']};' 
                              data-dog_name=' {$row['dogname']};' 
                              data-dog_breed=' {$row['dogbreed']};' 
                             
                              data-dog_gender=' {$row['doggender']};' 
                              data-username=' {$row['username']};' 
                              >
                                  <i class='bi bi-trash3-fill'></i>
                              </a>
                          </div>
                      </td>
                      </tr>";
                  }
      ?> 
      </form>
                    </tbody>
      
                    </table>
                </div>
                </div>
                    
                      
                  </div>
                  </div>
              </div>
          </div>
 <!-- Dog Image Modal -->
 <div class="modal fade" id="dogImageModal" tabindex="-1" aria-labelledby="dogImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="modal-title">Dogs' image</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="dogImagePreview" class="img-fluid" alt="Dog's Image">
                    </div>
                </div>
            </div>
        </div>          
      </section>
        </div>



  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/js/admin.js"></script>

  <script>
    // JavaScript to display the dog's image in the modal
    $(document).ready(function() {
        $('.view-dog-image').on('click', function() {
            var dogImage = $(this).data('dog-image');
            $('#dogImagePreview').attr('src', 'data:image/jpeg;base64,' + dogImage);
        });
    });
</script>


  <script>
    // JavaScript to display an Update & Delete message
    function displayAlertMessage(message) {
        var alert_Message = document.getElementById("alertMessages");
        alert_Message.innerHTML = 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">' + message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        alert_Message.classList.remove("d-none"); // Remove the "d-none" class to make the message visible
    }

    // Check if the update was successful and display the alert message accordingly
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($delSuccess) && $delSuccess) {
        echo 'displayAlertMessage("Record deleted successfully!");';
    } elseif (isset($delSuccess) && !$delSuccess) {
        echo 'displayAlertMessage("Error: Unable to delete the record.");';
    }
}

    ?>
</script>
<script>
    // When the document is ready
    $(document).ready(function() {
        // Handle the click event for the qualification button
        $('.qual-delete-button').on('click', function() {
            // Get the username from the data attribute
            var username = $(this).data('username');
            // Set the username in the modal input or display area
            $('#deleteAppQualModal .modal-body').html('Are you sure you want to delete the adoption record of  ' + username + ' ? You might not retrieve it once deleted. ');
        });
    });
</script>

<script>
$(document).ready(function() {
    var table = $('#table-show').DataTable({
        "order": [[0, "desc"]],
        "lengthChange": false, 
        "pageLength": 4,  // Set the default page length
        "paging": true,
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [4, 6,7,8] } // Disable sorting for columns 1 and onwards
        ]
    });


});

        // JavaScript to handle the delete action
        $('#deleteAppQualModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id');
    var username = button.data('username');
    var name = button.data('name');
    var age = button.data('age');
    var contact = button.data('contact');
    var dog_name = button.data('dog_name');
    var dog_breed = button.data('dog_breed');
    var dog_color = button.data('dog_color');
    var dog_age = button.data('dog_age');
    var dog_gender = button.data('dog_gender');
    var Qualified = button.data('Qualified');

    // Update the modal's hidden input and input fields with the retrieved values
    var modal = $(this);
    modal.find('#deleteId').val(id);

});

</script>

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 0.75em;
        margin: 0;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #007bff;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        cursor: not-allowed;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #dc3545;
    color: #fff;
    }
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        margin-left: .5em;
        display: inline-block;
        width: auto;
        border: none; /* Remove the border */
        outline: none; /* Remove the outline on focus */
    }

    .dataTables_wrapper .dataTables_filter input[type="search"]::placeholder {
        color: #999; /* Customize the placeholder color */
    }

</style>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/d4873500b0.js" crossorigin="anonymous"></script>
</body>

</html>