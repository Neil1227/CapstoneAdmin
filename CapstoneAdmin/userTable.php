<?php
session_name('admin_session');
session_start();

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION["user"])) {
    header("Location: adminLogin.php");
    exit();
}

include './forms/addUser.php';
include './modals/adduserModal.php';

include './forms/editUser.php';
include './modals/edituserModal.php';

include './forms/deleteUser.php';
include './modals/deleteuserModal.php';
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
                    
                  <h2><span>User</span>  Records </h2>
                  <div class="row mt-3">
                      <div id="alertMessages" class="col d-none"></div>
                      </div>
                      <hr/>
                      <div class="table-responsive">
                  <table id="table-show" class="table table-striped w-100 " style="width:100%">
                      <thead>
                          <tr>
                          <th>
                          <div class="d-flex align-items-center">          
                          Id  
                          </div>
                          </th>
                              <th>Username</th>
                              <th>First Name</th>
                              <th>Middle Name</th>
                              <th>Last Name</th>
                              <th>Adress</th>
                              <th>Age</th>
                              <th>Sex</th>
                              <th>Dogs</th>
                              <th>
                                  <a class="btn btn-outline-primary delete-button float-end" href="#" data-bs-toggle="modal" data-bs-target="#addModal">
                                      <i class="bi bi-file-plus"></i> Add
                                  </a>
                              </th>
                              
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
      
                  
                  $sql = "SELECT * FROM user_tbl";
                  $result = $connection->query($sql);
      
                  if(!$result){
                    die ("Invalid query: ". $connection->error);
                  }
      
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                          <td>{$row['user_id']}</td>
                          <td>{$row['username']}</td>
                          <td>{$row['first_name']}</td>
                          <td>{$row['middle_name']}</td>
                          <td>{$row['last_name']}</td>
                          <td>{$row['address']}</td>
                          <td>{$row['age']}</td>
                          <td>{$row['sex']}</td>
                          <td>{$row['owns_dog']}</td>
                          <td>
                          
                          <div class='btn-group float-end'>
                              <a class='btn btn-outline-success' href='#' data-bs-toggle='modal' data-bs-target='#edituserModal'
                              data-user_id='{$row['user_id']}'
                              data-username='{$row['username']}'
                              data-first_name='{$row['first_name']}'
                              data-middle_name='{$row['middle_name']}'
                              data-last_name='{$row['last_name']}'
                              data-address='{$row['address']}'
                              data-age='{$row['age']}'
                              data-sex='{$row['sex']}'
                              data-owns_dog='{$row['owns_dog']}'
                              >
                              <i class='bi bi-pencil-square'></i> 
                              </a>
                              <a class='btn btn-outline-danger delete-button' href='#' data-bs-toggle='modal' data-bs-target='#deleteuserModal'
                              data-user_id='{$row['user_id']}'
                              data-username='{$row['username']}'
                              data-first_name='{$row['first_name']}'
                              data-middle_name='{$row['middle_name']}'
                              data-last_name='{$row['last_name']}'
                              data-address='{$row['address']}'
                              data-age='{$row['age']}'
                              data-sex='{$row['sex']}'
                              data-owns_dog='{$row['owns_dog']}'
                              >
                              <i class='bi bi-trash3-fill'></i> 
                              </a>
                          </div>
                          </td>
      
                      
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


 

<!-- JavaScript to populate the modal fields when it's opened -->
<script>
    $('#edituserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal

        // Extract data attributes from the button
        var userId = button.data('user_id');
        var firstName = button.data('first_name');
        var middleName = button.data('middle_name');
        var lastName = button.data('last_name');
        var age = button.data('age');
        var sex = button.data('sex');
        var address = button.data('address');
        var ownsDog = button.data('owns_dog');
        var username = button.data('username');

        // Update the modal's hidden input and input fields with the retrieved values
        var modal = $(this);
        modal.find('#editUserId').val(userId);
        modal.find('#editFirstname').val(firstName);
        modal.find('#editMiddlename').val(middleName);
        modal.find('#editLastname').val(lastName);
        modal.find('#editAge').val(age);
        
        // Set the selected option in the form-select element for sex
        modal.find('#editSex option').each(function () {
            if ($(this).val() === sex) {
                $(this).prop('selected', true);
            }
        });

        modal.find('#editAddress').val(address);
        modal.find('#editOwnsDog').val(ownsDog);
        modal.find('#editUsername').val(username);
    });

    // JavaScript to handle the delete action
$('#deleteuserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var userId = button.data('user_id');
    var firstName = button.data('first_name');
    var middleName = button.data('middle_name');
    var lastName = button.data('last_name');
    var age = button.data('age');
    var sex = button.data('sex');
    var address = button.data('address');
    var ownsDog = button.data('owns_dog');
    var username = button.data('username');

    // Update the modal's hidden input and input fields with the retrieved values
    var modal = $(this);
    modal.find('#deleteId').val(userId);

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
    if (isset($adduserSuccess)) {
        echo 'displayAlertMessage("' . $adduserSuccess . '");';
    }
    
    if (isset($updateSuccess) && $updateSuccess) {
        echo 'displayAlertMessage("Record updated successfully!");';
    } elseif (isset($updateSuccess) && !$updateSuccess) {
        echo 'displayAlertMessage("Error: Unable to Update the record.");';
    }
   
    if (isset($delSuccess) && $delSuccess) {
        echo 'displayAlertMessage("Record deleted successfully!");';
    } elseif (isset($delSuccess) && !$delSuccess) {
        echo 'displayAlertMessage("Error: Unable to delete the record.");';
    }
}
    ?>
</script>

<script>
$(document).ready(function() {
    var table = $('#table-show').DataTable({
        "order": [[0, "desc"]],
        "lengthChange": false, 
        "pageLength": 5,  // Set the default page length
        "paging": true,
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [1, 2, 3, 4, 5, 6,7] } // Disable sorting for columns 1 and onwards
        ]
    });


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