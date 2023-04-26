<!-- Modal Start -->
<div class="modal fade" id="addVocabulary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" id="addVocabularyForm"  enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Voucablary</h4>
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
                <div class="form-group">
                    <div class="row">
                    <div class="form-group">
                        <!-- key is for words -->
                        <input type="text"  name="key" class="form-control" placeholder="Please Enetr The Key">
                    </div>
                    <div class="form-group">
                        <!-- value is for Entity -->
                        <input type="text"  name="value" class="form-control" placeholder="Please Enetr The Value">
                    </div>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button type="button"   class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSaveEntity" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</form>
</div>