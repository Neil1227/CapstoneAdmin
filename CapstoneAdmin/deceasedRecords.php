<?php
session_name('admin_session');
session_start();

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION["user"])) {
    header("Location: adminLogin.php");
    exit();
}


include './forms/deleteAppQual.php';
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
                  <div class="col-md-12 container-record p-4" style="width:80%">
                    
                  <h2><span>Deceased</span>  Dogs </h2>
                  <div class="row mt-3">
                      <div id="alertMessages" class="col d-none"></div>
                      </div>
                      <hr/>
                      <div class="table-responsive">
                  <table id="table-show" class="table table-striped w-100" style="width:100%">
                      <thead>
                          <tr>
                          <th>Dog ID</th>
                              <th>Dog Image</th>
                              <th>Dog Name</th>
                              <th>Dog Gender</th>
                              <th>Dog Breed</th> 
                              <th>Date of death</th>
                              <th>Furparent Name</th> 
                              <th>Username</th> 
                              <th>Contact No.</th>  
                              <th>Address</th> 

                          </tr>
                      </thead>
                      <tbody>
      
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
      
                  
                  $sql = "SELECT * FROM deceaseddogs_table";
                  $result = $connection->query($sql);
      
                  if(!$result){
                    die ("Invalid query: ". $connection->error);
                  }
      
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                      <td>{$row['dogID']}</td>
                      <td><img src='data:image/jpeg;base64," . base64_encode($row['dogImage']) . "' width='50' height='50' alt='Dog Image'></td>
                          <td>{$row['dogName']}</td>
                          <td>{$row['dogGender']}</td>
                          <td>{$row['dogBreed']}</td> 
                          <td>{$row['dateofDeath']}</td>
                          <td>{$row['furparentName']}</td>
                          <td>{$row['username']}</td>
                          <td>{$row['contactNo']}</td>
                          <td>{$row['address']}</td>

                      </tr>";
                  }
      ?> 
                    </tbody>
      
                    </table>
                </div>
                </div>
                    
                      
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
            $('#deleteAppQualModal .modal-body').html('Are you sure you want to delete the qualification record of  ' + username + '? ');
        });
    });
</script>

<script>
$(document).ready(function() {
    var table = $('#table-show').DataTable({
        "order": [[0, "desc"]],
        "lengthChange": false, 
        "pageLength": 5,  // Set the default page length
        "paging": true,
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [1,3,8] } // Disable sorting for columns 1 and onwards
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