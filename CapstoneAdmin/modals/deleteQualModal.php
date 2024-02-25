<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteAppQualModal" tabindex="-1" aria-labelledby="deleteAppQualModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteQualModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST">
      <div class="modal-body">

        <p id="delete-username"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!-- Button to trigger deletion -->
        <button type="submit" class="btn btn-danger" name="qual_del">Delete</button>
        <input type="hidden" id="deleteId" name="qual_id">
        <input type="hidden" id="deleteTable" name="table">
        </form>
      </div>
    </div>
  </div>
</div>

