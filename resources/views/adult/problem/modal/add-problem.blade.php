<div class="modal fade" id="add-problem-modal" tabindex="-1" role="dialog" aria-labelledby="add-problem-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add New Problem</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <form id="updateProlemForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <input type="hidden" name="id" id="updateProblemId">
                    <input type="hidden" name="updateProblemType" id="updateProblemType">
                    <?php $project  =  Crypt::encrypt($projectID); ?>
                    <input type="hidden" name="project_id" id="peojectID" value="{{ $project }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="updateProblemFileRadio" name="updateProblemType" class="custom-control-input updateProblemType" value="0" checked>
                                    <label class="custom-control-label" for="updateProblemFileRadio"> File</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="updateProblemLinkRadio" name="updateProblemType" class="custom-control-input updateProblemType" value="2">
                                    <label class="custom-control-label" for="updateProblemLinkRadio"> Link</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="updateProblemFileType">
                        <input type="file" name="updateProblemFile" data-height="150" id="updateProblemFileFile" class="dropify" accept="image/*, video/*">
                        
                    </div>
                    <div class="form-group" id="updateProblemLinkType" style="display: none">
                        <input type="url" name="updateProblemFileLink" id="updateProblemLinkFile" class="form-control" placeholder="Link">
                    
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateProblemName" id="updateProblemName" class="form-control" placeholder="Actual Problem">
                        
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" name="category_id" id="category_id">
                            <option value="">Choose a problem by  Category..</option>
                            @foreach($cat as $cate)
                                <option value="{{ $cate->id}}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnUpadteProblem">Save changes</button>
                </div>
        </form>
    </div>
  </div>
</div>