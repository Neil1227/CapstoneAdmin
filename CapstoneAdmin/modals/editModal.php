<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Dog Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <!-- Include hidden input field to store the ID -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dogs' age:</label>
                            <select class="form-select" id="age" name="age" required>
                                <option value="puppy">Puppy</option>
                                <option value="adolescence">Adolescence</option>
                                <option value="adult">Adult</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color:</label>
                            <input type="text" class="form-control" id="color" name="color" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Gender:</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date Obtained:</label>
                            <input type="date" class="form-control" id="date_obtained" name="date_obtained" value=""
                                required>
                        </div>
                    </div>
                            <label class="form-label">Dogs' Breed:</label>
                            <textarea class="form-control" id="background" name="background" rows="4" required></textarea>

                            
                            <label class="form-label">Upload Dogs' Image:</label>
                            <input type="file" class="form-control" id="dogImageId" name="dogImageNameEd">
                    </div>

                        <button type="submit" name="Edit" class="btn btn-danger float-end mt-3">
                            Save Changes
                        </button>
                        <input type="hidden" id="editId" name="id">
                
                </form>
            </div>
        </div>
    </div>
</div>
