 <!-- Add Dog Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Dog Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="form-outline mb-4">
            <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First name" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="middlename" class="form-control form-control-lg" placeholder="Middle name" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last name" required="">
          </div>

          <div class="row mb-3">
            <div class="col-md-6 mt-3">
              <input type="number" name="age" class="form-control" placeholder="Age" required="">
            </div>

            <div class="col-md-6 mt-3">
              <select name="sex" class="form-select" required="">
                  <option value="" disabled selected>Sex</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
              </select>
          </div>
          
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" required="">
          </div>
          <div class="form-outline mb-4">
            <input type="number" name="owns_dog" class="form-control" placeholder="No. of own dog(s) if any" required="">
          </div>
          <div class="form-outline mb-4">
            <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required="">
          </div>

          <div class="form-outline mb-4">
            <input type="password" name="re-password" class="form-control form-control-lg mb-3" placeholder=" Re-enter Password" required="">
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
            <select name="security_question" class="form-select" required="">
              <option value="" disabled selected>Select a Security Question</option>
              <option value="q1">What is your mother's maiden name?</option>
              <option value="q2">What is the name of your first pet?</option>
              <option value="q3">In what city were you born?</option>
              <option value="q4">What is your favorite book?</option>
              <option value="q5">What is your favorite movie?</option>
              <!-- Add more security questions here -->
            </select>
            <input type="text" name="security_answer" class="form-control form-control-lg mt-3" placeholder="Answer" required="">
          </div>

          

          <div class="pt-1 mb-4">
            <button class="btn btn-danger" name="btn_reg" type="submit">Register</button>
          </div>
                </form>
            </div>
        </div>
    </div>
</div>
