 <!-- The Modal -->
 <div class="modal fade bd-example-modal-lg" id="shareProjectModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="project_name">Share Project</h5>
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
                    <!-- <input type='email' class='form-control' name="email" id="shared_user" placeholder="example@example.com"> -->
                     <select name="user_id" id="shared_user" class='form-select'>
                        <option selected="true" disabled="disabled">Select User</option>
                     </select>
                    
                </div>
                <div class="form-group ml-3">
                        <div class="form-check form-switch">
                        <input class="form-check-input" name="project_sharing_mode" type="checkbox" role="switch" id="toggle-switch">
                        <label class="form-check-label ml-5" for="flexSwitchCheckChecked">Share project in read only mode</label>
                        </div>
                </div>
                 <div class="">
                    <table class="table slp-tbl text-center">
                        <thead>
                        <tr>
                        <th>Module</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Write</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row for a Module -->
                        <tr>
                        <td>Probelm</td>
                        <td class="text-center">
                            <input type="radio" name="editable_problem" class="read" value="0">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="editable_problem" class="write" value="1">
                        </td>
                        
                        </tr>
                        <tr>
                        <td>Solution</td>
                        <td class="text-center">
                            <input type="radio" name="editable_solution" class="read" value="0">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="editable_solution" class="write" value="1">
                        </td>
                        
                        </tr>
                        <tr>
                        <td>Solution Function</td>
                        <td class="text-center"><input type="radio" name="editable_solution_func" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_solution_func" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Verifications</td>
                        <td class="text-center"><input type="radio" name="editable_verification" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_verification" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Relationships</td>
                        <td class="text-center"><input type="radio" name="editable_relationship" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_relationship" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Reports</td>
                        <td class="text-center"><input type="radio" name="editable_report" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_report" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Results</td>
                        <td class="text-center"><input type="radio" name="editable_result" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_result" class="write" value="1"></td>
                        </tr>
                        </tbody>
                    </table>
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
