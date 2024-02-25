<?php
session_name('admin_session');
session_start();

$_SESSION['dog_id'] = $_GET['id'];

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION["user"])) {
    header("Location: adminLogin.php");
    exit();
}

include './forms/addDetails.php';
include './forms/editDetails.php';
include './forms/deleteDetails.php';
include './modals/editModal.php';
include './modals/adddogModal.php';
include './modals/deleteModal.php';



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
                    
                  <h4><span>Pet</span>  Live Stream </h4> 
                  <div class="row mt-3">
                      <div id="alertMessage" class="col d-none"></div>
                    </div>
                      <hr/>
                      <div class="table-responsive">

                        <?php
                        include 'admin_livestream.php';
                        ?>
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
    $('#editModal').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); 
        var name = button.data('name'); 
        var age = button.data('age');
        var color = button.data('color');
        var gender = button.data('gender');
        var date_obtained = button.data('date_obtained');
        var background = button.data('background');


        // Update the modal's hidden input and input fields with the retrieved values
        var modal = $(this);
        modal.find('#editId').val(id);
        modal.find('#name').val(name);
        modal.find('#color').val(color);
        modal.find('#date_obtained').val(date_obtained);
        modal.find('#background').val(background);

        // Set the selected age option in the form-select element
        modal.find('#age option').each(function() {
            if ($(this).text() === age) {
                $(this).prop('selected', true);
            }
        });

        // Set the selected gender option in the form-select element
        modal.find('#gender option').each(function() {
            if ($(this).text() === gender) {
                $(this).prop('selected', true);
            }
        });
    });

    // JavaScript to handle the delete action
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id');
    var name = button.data('name');
    var age = button.data('age');
    var color = button.data('color');
    var gender = button.data('gender');
    var date_obtained = button.data('date_obtained');
    var background = button.data('background');


    // Update the hidden input field with the retrieved ID
    var modal = $(this);
    modal.find('#deleteId').val(id);

    // You can also update other elements in the modal with the data you extracted if needed
});

</script>

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

            elseif (isset($updateSuccess)) {
                echo 'displayAlertMessage("' . $updateSuccess . '");';
            }
           
            if (isset($deleteSuccess) && $deleteSuccess) {
                echo 'displayAlertMessage("Record deleted successfully!");';
            } elseif (isset($deleteSuccess) && !$deleteSuccess) {
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

</body>

</html>

</html>