<div class="modal fade" id="add-sol-modal" tabindex="-1" role="dialog" aria-labelledby="add-sol-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Solution</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <form id="updateProlemForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <input type="hidden" name="id" id="id">
                    <!-- <input type="hidden" name="solutionType" id="solutionType"> -->
                    <?php 
                            $problem_id =  Crypt::encrypt($problem_id);
                            $project_id =  Crypt::encrypt($project->id);
                        ?>
                    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project_id" id="project_id" value="{{ $project_id }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="solFileRadio" name="solutionType" class="custom-control-input solutionType" value="0" checked>
                                    <label class="custom-control-label" for="solFileRadio"> File</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="solutionLinkRadio" name="solutionType" class="custom-control-input solutionType" value="2">
                                    <label class="custom-control-label" for="solutionLinkRadio"> Link</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="solutionFileType">
                        <input type="file" name="solutionFile" data-height="150" id="solutionFile" class="dropify" accept="image/*, video/*">
                        
                    </div>
                    <div class="form-group" id="solutionLinkType" style="display: none">
                        <input type="url" name="solutionLinkType" id="solutionLinkTypeFile" class="form-control" placeholder="Link">
                    
                    </div>
                    <div class="form-group">
                        <input type="text" name="problem" disabled id="problem"  value="{{ $problem_name }}" class="form-control" placeholder="Problem *">
                        
                    </div>
                    <div class="form-group">
                        <input type="text" name="solutionName" id="solutionName" class="form-control" placeholder="Solution Name">
                        
                    </div>
                    <div class="form-group">
                       <select class="form-control form-select" id="solution_type" name="solution_type_id">
                        <option value=" ">Transition Phrase *</option>
                            @foreach($solutionTypes as $solutionType)
                                <option value="{{ $solutionType->id  }}"> {{ $solutionType->name }}</option>
                            @endforeach    
                            
                       </select>
                        
                    </div>
                    <!--  -->
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnUpadteProblem">Save changes</button>
                </div>
        </form>
    </div>
  </div>
</div>