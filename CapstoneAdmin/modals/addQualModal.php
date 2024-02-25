<!-- Qualification Modal -->
<div class="modal fade" id="qualModal" tabindex="-1" aria-labelledby="qualModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qualModalLabel">Verify User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    <div class="modal-body">
    <form action="" method="POST">

        <div class="form-outline mb-4 mt-3">
            <input type="text" name="name" id="name" class="form-control form-control-lg" required readonly>
          </div>
          <div class="form-outline mb-4 mt-3">
            <input type="text" name="address" id="address" class="form-control form-control-lg" required readonly>
          </div>
        <div class="row">
        <div class="col-md-8 mb-4">
              <input type="number" name="contact" id="contact"class="form-control form-control-lg" required readonly>
            </div>

          <div class="col-md-4 form-outline mb-4">
            <input type="text" name="age" id="age" class="form-control form-control-lg" required readonly>
          </div>
         
        </div>

        

        <div class="row">
            <div class="col-md-7 mb-4">
              <input type="text" name="dogname" id="dogname"class="form-control form-control-lg" required readonly>
            </div>
          <div class="col-md-5 form-outline mb-4">
            <input type="text" name="dogcolor"id="dogcolor" class="form-control form-control-lg" required readonly>
          </div>
        </div>


        <div class="row">
          <div class="col-md-6 form-outline mb-4">
            <input type="text" name="dogage" id="dogage"class="form-control form-control-lg" required readonly>
          </div>
          <div class="col-md-6 form-outline">
            <input type="text" name="doggender" id="doggender"class="form-control form-control-lg" required readonly>
          </div>
          </div>
        </div>
                    <div class="modal-footer">
                <!-- Modify the form action to directly delete the record -->
        <div class="row">
        <div class="col-md-7 form-outline mb-4">
            <input type="hidden" name="username" id="username" class="form-control form-control" required readonly>
          </div>
          <div class="col-md-5 form-outline mb-4">
            <input type="hidden" name="Qualified" id="Qualified" class="form-control form-control" required readonly>
          </div>
          <div class="col-md-5 form-outline mb-4">
            <input type="hidden" name="id" id="id" class="form-control form-control" required readonly>
          </div>
        </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Use a submit button to trigger the form submission -->
                    <button type="submit" class="btn btn-danger" name="transferAccepted" id="transferAcceptedId">Yes</button>
                    <input type="hidden" id="transferAcceptedId" name="transferAcceptedId">
                </form>
            </div>
        </div>
    </div>
</div>
