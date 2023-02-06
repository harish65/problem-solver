<form method="POST" class="modal fade" id="addVerificationTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Verification type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="updateVerificationTypeName" placeholder="Name">
                    
                </div>
                <div class="form-group">
                    <input type="text" name="first_field" class="form-control" id="first_field" placeholder="1st Field">
                    
                </div>
                <div class="form-group">
                    <input type="text" name="second_field" class="form-control" id="second_field" placeholder="2nd Field">
                    
                </div>
                <div class="form-group">
                    <input type="text" name="third_field" class="form-control" id="third_field" placeholder="3rd Field">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="button" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</form>