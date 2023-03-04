<form method="POST"  class="modal fade" id="verificationTypeTextModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Verification Type Text</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id"  id="id">                
                <div class="form-group">
                    <select class="custom-select" name="verification_type_id" id="verification_type_id">
                        <option>Type *</option>
                        @foreach ($verificationTypes as $item)
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                        @endforeach
                   </select>
                </div>                
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Text">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="button" id="btnSave">Save changes</button>
            </div>
        </div>
    </div>
</form>