<div class="modal fade" id="updateSolFunctionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" id="updateFormSolFunctionModal" >
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Solution Function</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php 
               
                            $problem_id =  Crypt::encrypt($problem_id);
                            $project_id =  Crypt::encrypt($project_id);
                            $solution_id =  Crypt::encrypt($solution_id);
                        ?>
                <div class="modal-body">

                <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                <input type="hidden" name="project_id" value="{{ $project_id }}">
                <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                    <input type="hidden" name="updateSolFunctionId" id="updateSolFunctionId">
                    <input type="hidden" name="updateSolFunctionType" id="updateSolFunctionType">
                    <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolFunctionFileRadio" name="updateSolFunctionType" class="custom-control-input updateSolFunctionType" value="0" checked>
									<label class="custom-control-label" for="updateSolFunctionFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolFunctionLinkRadio" name="updateSolFunctionType" class="custom-control-input updateSolFunctionType" value="2">
									<label class="custom-control-label" for="updateSolFunctionLinkRadio"> Link</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="updateSolFunctionFileType">
						<input type="file" name="updateSolFunctionFile" id="updateSolFunctionFileFile" class="dropify" accept="image/*, video/*">
						
					</div>
					<div class="form-group" id="updateSolFunctionLinkType" style="display: none">
						<input type="url" name="updateSolFunctionFileLink" id="updateSolFunctionLinkType" class="form-control" placeholder="Link">
						
					</div>
                    <div class="form-group">

                    <input type="text"  value="{{ $solutionProblemName }}" name="updateSolFunctionProblemId"  class="form-control" placeholder="Problem Name">
                        
                    </div>
                    <div class="form-group">
                    <input type="text"  value="{{ $solutionName }}" name="updateSolFunctionSolutionId"  class="form-control" placeholder="Problem Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateSolFunctionName" class="form-control" id="updateSolFunctionName" placeholder="Solution Function Name *" required>
                        
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionTypeId" id="updateSolFunctionTypeId">
                            <option value="">Transition Phrase *</option>
							<option value="1">Problem is solved by solution from solution function</option>
							<option value="2">Problem is substituted by solution from solution function</option>
							<option value="3">Problem is replaced by solution through solution function</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="sol-function" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>