<!-- Edit User Modal -->
<div class="modal fade" id="edituserModal" tabindex="-1" aria-labelledby="edituserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserModalLabel">Edit User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                <div class="form-outline mb-4">
                        <input type="text" name="username" id="editUsername" class="form-control form-control-lg" placeholder="Username" value="" required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="firstname" id="editFirstname" class="form-control form-control-lg" placeholder="First name" value="" required>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="middlename" id="editMiddlename" class="form-control form-control-lg" placeholder="Middle name" value="" required>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="lastname" id="editLastname" class="form-control form-control-lg" placeholder="Last name" value="" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mt-3">
                            <input type="number" name="age" id="editAge" class="form-control" placeholder="Age" value="" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <select name="sex" id="editSex" class="form-select"value="" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="address" id="editAddress" class="form-control form-control-lg" placeholder="Address" value="" required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="number" name="owns_dog" id="editOwnsDog" class="form-control" placeholder="No. of own dog(s) if any" value="" required>
                    </div>
                    <input type="hidden" name="user_id" id="editUserId" value="">
                    <div class="pt-1 mb-4">
                        <button class="btn btn-danger float-end" name="btn_edit-user" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
