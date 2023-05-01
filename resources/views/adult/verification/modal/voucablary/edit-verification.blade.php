<!-- Modal Start -->
<div class="modal fade" id="editVerification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">

<form method="POST" id="VerificationeditForm"  enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Voucablary Verification</h4>
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
                <!-- <div class="form-group">

                    <input type="text" name="name"  value='{{ $verification->name }}'  class="form-control" placeholder="Problem Name">
                    
                </div> -->
                <div class="form-group">
                    
                        <select class="form-control" name="verification_type_text_id" id="verification_type_text_id">
                                <option value=''>Choose verification type text..</option>
                                @foreach($verificationTypeText as $typetext)
                                    <option {{ ($verification->verification_type_text_id == $typetext->id ) ? 'selected' : '' }} value='{{ $typetext->id }}'>{{ $typetext->name }}</option>
                                @endforeach
                        </select>
                    
                </div>
                <div class="form-group">
                    
                    <select class="form-control" name="file" id="file">
                            <option value=''>Choose Image..</option>
                            <option {{ ($verification->file == 1) ? 'selected' : '' }} data-src="{{ asset('assets-new/verification/voucablary/1vocabulary.png')}}" value="1">Image One </option>
                            <option {{ ($verification->file == 2) ? 'selected' : '' }} data-src="{{ asset('assets-new/verification/voucablary/2vocabulary.png')}}" value="2">Image Tow</option>
                    </select>
                    <div class="image"  id="default-image"style="margin: 20px;text-align: center;">
                        
                        @if($verification->file == 1)
                        <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/1vocabulary.png')}}"  width="200" height="200">
                        @else
                        <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/2vocabulary.png')}}"  width="200" height="200">
                        @endif
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
