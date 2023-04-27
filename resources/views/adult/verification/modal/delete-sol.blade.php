<!-- Modal Start -->
<div class="modal fade" id="deleteSolution" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" id="deleteSolutionForm"  enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Solution</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
            <div class="modal-body">
                <input type="hidden" name="id" id="ver_id" value="{{ @$verification->id }}">
                <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                <input type="hidden" name="project_id" value="{{ $project_id }}">
                <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                <input type="hidden" name="fileType" id="fileType">
                <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                <input type="hidden" name="id" id="id" value=" {{$solution->id}} ">
                <div class="form-group">
                    <div class="row">
                      <h3>Are you sure you want delete this Solution?</h3> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"   class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnDeleteSol" class="btn btn-success">Delete</button>
            </div>
        </div>
    </div>
</form>
</div>
