<!-- Modal Start -->
<div class="modal fade" id="editVerification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" id="VerificationeditForm"  enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Verification</h4>
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
                       <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="file" name="file" class="custom-control-input filetypeRadio" value="0" {{ ($verification->type == '0' || $verification->type == '1')  ? 'checked' : ''}}>
                                <label class="custom-control-label" for="file"> File</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="link" name="file" class="custom-control-input filetypeRadio" value="2" {{ ($verification->type == '2')  ? 'checked' : ''}}>
                                <label class="custom-control-label" for="link"> Link</label>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="form-group" id="imageFile" style="{{($verification->type == '2') ? 'display:none' : ''}}">
                    <input type="file" name="imageFile" id="imageFile" class="dropify" accept="image/*, video/*">
                    
                </div> 
                 

                <div class="form-group " id="youtubeLink " style="{{($verification->type == '0' || $verification->type == '1') ? 'display:none' : ''}}">
                    <input type="url" name="youtubeLink" id="youtubeLink" value='{{ $verification->file }}'  class="form-control" placeholder="Link">
                    
                </div>
                
                <div class="form-group">

                <input type="text" disabled  value="{{ 'Problem : '.@$problem->name }}"  class="form-control" placeholder="Problem Name">
                    
                </div>
                <div class="form-group">
                <input type="text" disabled value="{{ 'Solution : '.@$solution->name }}"   class="form-control" placeholder="Problem Name">
                </div>
                <div class="form-group">
                    <input type="text" disabled  value="{{ 'Solution Function : '.@$Solution_function->name }}"  class="form-control" id="updateSolFunctionName" placeholder="Solution Function Name *" required>
                    
                </div>
                <!-- <div class="form-group">
                    <input type="text"  name="varificationName"  value=""  class="form-control" id="varificationName" placeholder="Name *" required>
                    
                </div> -->
                <div class="form-group">
                <input type="text"  disabled value="{{ 'varification Type : '.@$verificationType->name }}"  class="form-control" id="varificationType" placeholder="varification Type *" required>
                </div>
                <div class="form-group">

                    <input type="text" name="name"  value='{{ $verification->name }}'  class="form-control" placeholder="Problem Name">
                    
                </div>
                <div class="form-group">
                    
                        <select class="form-control" name="verification_type_text_id" id="verification_type_text_id">
                                <option value=''>Choose verification type text..</option>
                                @foreach($verificationTypeText as $typetext)
                                    <option {{ ($verification->verification_type_text_id == $typetext->id ) ? 'selected' : '' }} value='{{ $typetext->id }}'>{{ $typetext->name }}</option>
                                @endforeach
                        </select>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"   class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnUpdate" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</form>
</div>
