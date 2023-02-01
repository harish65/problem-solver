<form method="POST"  class="modal fade" id="updateSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upate Solution</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="updateSolutionId" id="updateSolutionId">
                <input type="hidden" name="updateSolutionType" id="updateSolutionType">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="updateSolutionFileRadio" name="updateSolutionType" class="custom-control-input updateSolutionType" value="0" checked>
                                <label class="custom-control-label" for="updateSolutionFileRadio"> File</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="updateSolutionLinkRadio" name="updateSolutionType" class="custom-control-input updateSolutionType" value="2">
                                <label class="custom-control-label" for="updateSolutionLinkRadio"> Link</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="updateSolutionFileType">
                    <input type="file" name="updateSolutionFile" id="updateSolutionFileFile" class="dropify" accept="image/*, video/*">
                  
                </div>
                <div class="form-group" id="updateSolutionLinkType" style="display: none">
                    <input type="url" name="updateSolutionFileLink" id="updateSolutionLinkFile" class="form-control" placeholder="Link">
                   
                </div>
                <div class="form-group">
                    <select class="custom-select" name="updateSolutionProblemId" id="updateSolutionProblemId">
                        <option value="">Problem *</option>
                        @if(isset($problems))
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="updateSolutionName" class="form-control" id="updateSolutionName" placeholder="Name" required>
                    
                </div>
                <div class="form-group">
                    <select class="custom-select" name="updateSolutionTypeId" id="updateSolutionTypeId">
                        <option value="">Type *</option>
                        @if(isset($solutionTypes))
                            @foreach ($solutionTypes as $item)
                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>                                    
                            @endforeach
                        @endif
                    </select>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="updateSolution">Save changes</button>
            </div>
        </div>
    </div>
</form>