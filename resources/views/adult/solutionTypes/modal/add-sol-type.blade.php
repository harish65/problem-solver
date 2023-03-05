<form method="POST" class="modal fade" id="addSolutionTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Solution type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="solutionTypeName" placeholder="Solution Type">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="button" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</form>