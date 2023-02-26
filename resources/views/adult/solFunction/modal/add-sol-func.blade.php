<div class="modal fade" id="updateSolFunctionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" >
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Solution Function</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
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
                        <select class="custom-select" name="updateSolFunctionProblemId" id="updateSolFunctionProblemId">
                            <option value="">Problem *</option>
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionSolutionId" id="updateSolFunctionSolutionSelect">
                            <option value="">Solution *</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateSolFunctionName" class="form-control" id="updateSolFunctionName" placeholder="Name *" required>
                        
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionTypeId" id="updateSolFunctionTypeId">
                            <option value="">Type *</option>
							<option value="1">Problem is solved by solution from solution function</option>
							<option value="2">Problem is substituted by solution from solution function</option>
							<option value="3">Problem is replaced by solution through solution function</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>