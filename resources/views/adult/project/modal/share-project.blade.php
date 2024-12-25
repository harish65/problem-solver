 <!-- The Modal -->
 <div class="modal fade" id="shareProjectModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="project_name"></h5>
            <button type="button"  data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="share-project">
                <input type='hidden' name='project_id' id='shared_project_id'>
                <input type='hidden' name='shared_project' id='shared_project'>
                <div class="form-group">
                    <label>Share With</label>
                    <input type='email' class='form-control' name="email" id="shared_user" placeholder="example@example.com">
                    
                </div>
                <div class="form-group">
                    <label>Project Permissions</label>
                    
                </div>
                
                    
                <div class="form-group">
                <label class="radio-inline"><input type="radio" name="project_sharing_mode" value="0" checked>Share Project In Readonly Mode</label>
                <label class="radio-inline"><input type="radio" name="project_sharing_mode" value="1" >Share Project In Editable Mode</label>
                    <div class="project_permission" style="display:none;">
                        <ul class="list-group list-style-none" style="list-style:none;">
                            <!-- <li><label><input type="checkbox" value='0' class="form-controle" name="editable_project"> Project Editable</label></li> -->
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_problem"> Problem Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_solution"> Solution Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_solution_func"> Solution function Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_verification"> Verifications Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_relationship"> Relationship Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_report"> Report Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_result"> Result Editable</label></li>
                            <li class="ml-3"><label><input type="checkbox" value='0' class="form-controle" name="editable_quiz"> Quiz Editable</label></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="shareprojectBtn">Submit</button>
        </div>
        </div>
    </div>
  </div>