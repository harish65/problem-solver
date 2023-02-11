<!-- The Modal -->
<div class="modal fade addcategory" id="addCategoryModal">
    <div class="modal-dialog">
      <div class="modal-content close-btn">
        <div class="crossBtn" style="text-end">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header -->        
        <div class="modal-header">
          <h4 class="modal-title">Add New Problem Category</h4>          
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form method="post" id="add-problem-category">
                <div class="form-group">
                    <label>Name</label>
                    <input type="hidden" id="cat_id" name="id" value=""> 
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSave" data-dismiss="modal">Save</button>
                </div>
        </form>
        
      </div>
    </div>
  </div>
  <!-- add project modal End -->