 <!-- The Modal -->
 <div class="modal fade" id="addprojectModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
            <button type="button"  data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="project-modal">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="btnSave">Submit</button>
        </div>
        </div>
    </div>
  </div>