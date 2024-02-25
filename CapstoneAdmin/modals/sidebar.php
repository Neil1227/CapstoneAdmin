
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

// Query to get the count of records from the application_table
$countQuery = "SELECT COUNT(*) as record_count FROM application_table";
$countResult = $connection->query($countQuery);

// Check if the query was successful
if ($countResult) {
    $recordCount = $countResult->fetch_assoc()['record_count'];
} else {
    $recordCount = 0; // Set a default value if the query fails
}

// Close the database connection
$connection->close();
?>
<style>
    /* Common styles for the sidebar */
    .sidebar {
        background-color: #eee;
        position: fixed;
        padding: 20px;
        top: 0;
        height: 100%;
        z-index: 999;
        transition: width 0.3s; /* Add smooth transition for width changes */
    }

    .sidebar a {
        color: #37373f;
    }

    .sidebar a:hover {

    font-family: var(--font-secondary);
    font-size: 16px;
    font-weight: 600;
    color:  #ce1212;
    white-space: nowrap;
    }


    .login{
        margin-left: 100px;
        margin-top: 50px;
        
    }
    /* Larger screens (min-width: 993px) */
    @media (min-width: 993px) {
        .sidebar {
            width: 230px; /* Adjust the width as needed */
        }

        #main {
            margin-left: 65px; /* Adjust the value to match the sidebar width */
            padding: 10px;
        }
    }


  /* Smaller screens (max-width: 992px) */
@media (max-width: 992px) {
    .sidebar {
        z-index: 999;
        overflow-y: auto;
        
    }

    #main {
        margin-left: 0; /* Adjust main content to the left */
    }


}
</style>



 <div class="container-fluid">
    <div class="row flex-nowrap ">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <div class="pb-4 mb-4">
                    <a href="#" class="d-flex align-items-center text-decoration-none mt-3" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/img/logomini.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <h5 style="color: #37373f";><span class="d-none d-sm-inline mx-1"> <?php echo strtoupper ($_SESSION['user']); ?></span></h5>
                    </a>
                    
                </div>
    <hr/>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="adminTable.php" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Dog Records</span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a href="userTable.php" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-file-earmark-spreadsheet"></i> <span class="ms-1 d-none d-sm-inline">User Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="videoUpdates.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-file-earmark-play"></i> <span class="ms-1 d-none d-sm-inline">Video Uploads</span> </a>
                           
                    </li>
                    <li>
                        <a href="adoptionRecords.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-bookmarks"></i> <span class="ms-1 d-none d-sm-inline">Adoption Records</span></a>
                    </li>
                    <li>
                    <a href="applicationTable.php" class="nav-link px-0 align-middle ">
                        <span class="badge border border-dark text-dark"><?php echo $recordCount; ?></span>
                        <span class="ms-1 d-none d-sm-inline">Application Records</span>
                        
                    </a>
                    </li>

                    <li>
                        <a href="acceptedTable.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-bookmark-check"></i> <span class="ms-1 d-none d-sm-inline">Qualified Records</span> </a>
                    </li> 
                    <li>
                        <a href="unqualifiedTable.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-bookmark-x"></i> <span class="ms-1 d-none d-sm-inline">Unqualified Records</span> </a>
                           
                    </li>
                    <li>
                        <a href="deceasedRecords.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-bookmark-dash"></i> <span class="ms-1 d-none d-sm-inline">Deceased Records</span> </a>
                           
                    </li>
                   
                    <li>
                        <a href="admin-edit-profile.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-person"></i> <span class="ms-1 d-none d-sm-inline">Account Settings</span></a>
                    </li>
                    
                    <li>
                        <a href="logout.php" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Sign out</span> </a>
                    </li>
                </ul>

               
            </div>
        </div>

