<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Dog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
                    <div class="modal-body">
                        Are you sure you want to delete this row?
                    </div>
                    <div class="modal-footer">
                <!-- Modify the form action to directly delete the record -->
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Use a submit button to trigger the form submission -->
                    <button type="submit" class="btn btn-danger" name="confirmDeleteButton">Delete</button>
                    <input type="hidden" id="deleteId" name="id">
                    <input type="hidden" id="deleteTable" name="table">
                </form>
            </div>
        </div>
    </div>
</div>