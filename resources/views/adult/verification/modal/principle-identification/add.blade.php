<!-- Modal Start -->
<div class="modal fade" id="createVerification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">

    <form method="POST" id="createVerificationForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Principle identification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_" value="">
                    <input type="hidden" name="principle_main_id" id="principle_main_id" value="{{ @$content->id}}">
                    <input type="hidden" name="principle_identification_id" id="principle_identification_id" value="">
                    <input type="hidden" name="principle_type" id="principle_type	" value="{{ @$content->principle_type	}}">
                    <input type="hidden" name="problem_id" id="problem_id" value="{{  Crypt::decrypt($problem_id) }}">
                    <input type="hidden" name="project_id" value="{{ Crypt::decrypt($project_id) }}">
                    <div class="form-group">
                        <input type="text" disabled value="{{ 'Problem : '.@$problem->name }}" class="form-control"
                            placeholder="Problem Name">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled value="{{ 'Solution : '.@$solution->name }}" class="form-control"
                            placeholder="Problem Name">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled value="{{ 'Solution Function : '.@$Solution_function->name }}"
                            class="form-control" id="updateSolFunctionName" placeholder="Solution Function Name *"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" disabled value="{{ 'varification Type : '.@$verificationType->name }}"
                            class="form-control" id="varificationType" placeholder="varification Type *" required>
                    </div>
                    <div class="form-group">
                        <input type="text" value="" disabled id="principle" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="applicable" id="applicable">
                            <option value='1'>YES</option>
                            <option value='0'>NO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSavePriciple" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>