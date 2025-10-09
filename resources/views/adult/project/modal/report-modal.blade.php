<!-- Modal -->
<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form method="post" id="project-report-modal" action="{{route('adult.getReport')}}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="project_id" id="projectID">
                        <input type="text" name="name" id="p_name" class="form-control" placeholder="Name" autocomplete="off" readonly>
                    </div>
                     <div class="form-group">
                        <label>User</label>
                        <select class="form-control form-select ml-1" name="user_id" id="userSelect">
                            <option selected="true" disabled="disabled">Select User..</option>
                        </select>
                        
                    </div>
                     <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="getReport">Submit</button>
            </div>
                </form>
            </div>
            
           
        </div>
    </div>
</div>