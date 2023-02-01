<div class="modal fade" id="updateProblemModal" tabindex="-1" role="dialog" aria-labelledby="updateProblemModalLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Update Problem</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <form id="updateProlemForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <input type="hidden" name="updateProblemId" id="updateProblemId">
                    <input type="hidden" name="updateProblemType" id="updateProblemType">
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
                        <input type="text" name="updateProblemName" id="updateProblemName" class="form-control" placeholder="Name">
                        
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