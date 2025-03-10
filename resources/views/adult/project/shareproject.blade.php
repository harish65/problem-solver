@extends('adult.layouts.adult')
@section('title', 'Problem | Adult')   
 
@section('content')
<div class="container">
      <div class="bannerSection">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="bannerLeftSide">
            <h1>Welcome to The Speak Logic</h1>
            <h1><span>Problem Solver</span></h1>
            <h5>Think logically to solve problems </h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bannerImg">
            <img src="{{ url('/') }}/assets-new/images/banner-adult-dashboard.png" alt="Banner Image"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>Share Project</h4>
        </div>
        <div class="col">          
          <div class="text-end">
            <div class="form-check">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="projectlist">
    <div class="container">
        @if($allreadySharedUsers->count() > 0)
        <div class="row bannerSection">
            <div class="form-group mainTitle">
                <h4>Projects Shared With Users</h4>
                <p class="text-muted">
                    <i class="text-black"><u>Below is the list of users with whom the project has been shared, along with their contact details.</u></i>
                </p>        
            </div>
            <div class="table-responsive">
                
       
            <table class="table slp-tbl text-center">
                        <thead>
                            <tr>
                                <th>Users</th>
                                <th>Permissions Mode</th>
                                <th>Action</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allreadySharedUsers as $user)
                            <tr>
                                <td>{{ ucfirst($user->name)}}<small><i class="text-green">({{$user->email}})</i></small></td>
                                <td class=" {{ ($user->editable_project == 1) ? 'bg-success'  : 'bg-secondary' }}   text-white">{{ ($user->editable_project == 1) ? 'Write Permissions' : 'Read Permissions'  }}</td>
                               <td><a href="{{ route('adult.project_permissions' , [Crypt::encrypt($user->shared_with) , Crypt::encrypt($user->project_id)])}}">View Permission</a></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
            </table>
            </div>
        </div>
        @endif

        <div class="row bannerSection">
            <form method="post" id="share-project" class="relationshipPage">
                <input type='hidden' name='project_id' value="{{$project_id}}"  id='shared_project_id'>
                <input type='hidden' name='shared_project' id='shared_project'>
                <input type='hidden' name='project_sharing_mode' id='shared_project_editable' value="1">
                
                <div class="form-group mainTitle">
                    <label>Share With Users:</label>
                    <!-- <input type='email' class='form-control' name="email" id="shared_user" placeholder="example@example.com"> -->
                     <select name="user_id" id="shared_user" class='form-control form-select w-100'>
                        <option selected="true" disabled="disabled">Select User</option>
                        @foreach ($projectUsers as $users)
                        <option  value="{{$users->id}}">{{$users->name}}</option>
                        @endforeach
                     </select>
                    
                </div>
                <div class="form-group ml-3">
                        <div class="form-check form-switch">
                        <input class="form-check-input" name="" type="checkbox" role="switch" id="toggle-switch">
                        <label class="form-check-label ml-5" for="flexSwitchCheckChecked">Share Project In Read Only Mode</label>
                        </div>
                </div>
                 <div class="table-responsive">
                    <table class="table slp-tbl text-center">
                        <thead>
                        <tr>
                        <th>Module</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Write</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row for a Module -->
                        <tr>
                        <td>Probelm</td>
                        <td class="text-center">
                            <input type="radio" name="editable_problem" class="read" value="0">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="editable_problem" class="write" value="1">
                        </td>
                        
                        </tr>
                        <tr>
                        <td>Solution</td>
                        <td class="text-center">
                            <input type="radio" name="editable_solution" class="read" value="0">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="editable_solution" class="write" value="1">
                        </td>
                        
                        </tr>
                        <tr>
                        <td>Solution Function</td>
                        <td class="text-center"><input type="radio" name="editable_solution_func" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_solution_func" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Verifications<small>  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="bi bi-exclamation-circle " viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                                </svg></small>
                                            </td>
                        <td class="text-center"><input type="radio" name="editable_verification" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_verification" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Relationships</td>
                        <td class="text-center"><input type="radio" name="editable_relationship" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_relationship" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Reports</td>
                        <td class="text-center"><input type="radio" name="editable_report" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_report" class="write" value="1"></td>
                        </tr>
                        <tr>
                        <td>Results</td>
                        <td class="text-center"><input type="radio" name="editable_result" class="read" value="0"></td>
                        <td class="text-center"><input type="radio" name="editable_result" class="write" value="1"></td>
                        </tr>
                        <tr>
                            <td colspan='4'>
                                <div class="accordion" id="detailsAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed btn-accordion" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" disabled>
                                            Verifications
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#detailsAccordion">
                                            <div class="accordion-body">
                                            <div class="container mt-3 ">
                                                <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" name="" type="checkbox" role="switch" id="toggle-switch-verification-read">
                                                <label class="form-check-label ml-5" for="flexSwitchCheckChecked">Share All Verifications In Read Only Mode</label>
                                                </div>
                                                <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" type="checkbox" id="toggle-switch-verification-write">
                                                <label class="form-check-label ml-5" for="switch2">Share All Verifications In Write Mode</label>
                                                </div>
                                            </div>
                                            <table class="table slp-tbl text-center">
                                                <thead>
                                                    <th>Verification Type</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($verificationTypes as $key=>$verification)
                                                        <tr>
                                                            <td>{{ $verification->name  }}</td>
                                                            <td class="text-center"><input type="radio" name="{{ strtolower(str_replace(' ', '_', $verification->name)) }}" class="v_read" value="0"></td>
                                                            <td class="text-center"><input type="radio" id="{{ strtolower(str_replace(' ', '_', $verification->name)) }}" name="{{ strtolower(str_replace(' ', '_', $verification->name)) }}" class="v_write" value="1"></td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                 </div>  
                 <div class="form-group text-right">
                 <button type="button" class="btn btn-success" id="shareprojectBtn">Submit</button>
                 </div>
            </form>
            
        </div>
    </div>   
</div>    
@endsection
@section('scripts')
<script>
    $(function(){
        const toggleSwitch = document.getElementById("toggle-switch");
        const radioReadButtons = document.querySelectorAll('.read');
        const radioWriteButtons = document.querySelectorAll('.write');
        toggleSwitch.addEventListener("change", function () {
            if (this.checked) {
              $(this).val(0);
              $('#shared_project_editable').val(0);
              $('#collapseOne').collapse('hide');
              $('#toggle-switch-verification-read').prop('checked' , false);
                // When the switch is ON, check all radio buttons
                radioReadButtons.forEach((radio, index) => {
                    // if (index === 0) {
                        radio.checked = true; // Check the first radio button
                    // }
                    
                });
                radioWriteButtons.forEach((radio, index) => {
                    // if (index === 0) {
                      $(radio).attr('disabled' , true) // Check the first radio button
                    // }
                });

            } else {
              $(this).val(1);
              $('#shared_project_editable').val(1);
                // When the switch is OFF, uncheck all radio buttons
                radioReadButtons.forEach((radio) => {
                    radio.checked = false;
                });
                radioWriteButtons.forEach((radio, index) => {
                    // if (index === 0) {
                      $(radio).attr('disabled' , false) // Check the first radio button
                    // }
                });
            }
        })
        const toggleSwitchV = document.getElementById("toggle-switch-verification-read");
        const radioReadButtonsV = document.querySelectorAll('.v_read');
        const radioWriteButtonsV = document.querySelectorAll('.v_write');
        toggleSwitchV.addEventListener("change", function () {
            var S1 = document.getElementById("toggle-switch-verification-write");
            if (this.checked) {
                S1.disabled = true;
              $(this).val(0);
             
                // When the switch is ON, check all radio buttons
                radioReadButtonsV.forEach((radio, index) => {
                        radio.checked = true; // Check the first radio button
                });
                radioWriteButtonsV.forEach((radio, index) => {
                      $(radio).attr('disabled' , true) // Check the first radio button
                });

            } else {
              $(this).val(1);
              S1.disabled = false;
              
                // When the switch is OFF, uncheck all radio buttons
                radioReadButtonsV.forEach((radio) => {
                    radio.checked = false;
                });
                radioWriteButtonsV.forEach((radio, index) => {
                    // if (index === 0) {
                      $(radio).attr('disabled' , false) // Check the first radio button
                    // }
                });
            }
        });

        const toggleSwitchR = document.getElementById("toggle-switch-verification-write");
        const radioReadButtonsR = document.querySelectorAll('.v_read');
        const radioWriteButtonsR = document.querySelectorAll('.v_write');
        toggleSwitchR.addEventListener("change", function () {
            var S2 = document.getElementById("toggle-switch-verification-read");
            if (this.checked) {
              $(this).val(0);
              S2.disabled = true;
              
              
                // When the switch is ON, check all radio buttons
                radioWriteButtonsR.forEach((radio, index) => {
                    // if (index === 0) {
                        radio.checked = true; // Check the first radio button
                    // }
                    
                });
                radioReadButtonsR.forEach((radio, index) => {
                    // if (index === 0) {
                      $(radio).attr('disabled' , true) // Check the first radio button
                    // }
                });

            } else {
              $(this).val(1);
             
              S2.disabled = false;
                // When the switch is OFF, uncheck all radio buttons
                radioWriteButtonsR.forEach((radio) => {
                    radio.checked = false;
                });
                radioReadButtonsR.forEach((radio, index) => {
                    // if (index === 0) {
                      $(radio).attr('disabled' , false) // Check the first radio button
                    // }
                });
            }
        })
    });
    
    ///////
    $(document).ready(function () {
        $('input[name="editable_verification"]').change(function () {
            // Open the accordion
            if (this.checked && $(this).val() == 1) {
            $('#collapseOne').collapse('show');            
            }else{
              $('#collapseOne').collapse('hide');
            }
        });
    });

    $('#shareprojectBtn').click(function(e){
    e.preventDefault();
    const isChecked = Array.from(document.querySelectorAll('input[type="radio"]')).some(radio => radio.checked);
    if($("#shared_project_editable").val() == 1 && !isChecked){
      toastr.error('Project user and permissions must be selected in editable mode!');
      return false;
    }
    var fd = new FormData($('#share-project')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $.ajax({
        url: "{{route('adult.share-project')}}",
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
        type: 'POST',
        beforeSend: function(){
          $('#shareprojectBtn').attr('disabled',true);
          $('#shareprojectBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        },
        error: function (xhr, status, error) {
            $('#shareprojectBtn').attr('disabled',false);
            $('#shareprojectBtn').html('Submit');
            $.each(xhr.responseJSON.data, function (key, item) {
                toastr.error(item);
            });
        },
        success: function (response){
          if(response.success == false)
          {
              $('#shareprojectBtn').attr('disabled',false);
              $('#shareprojectBtn').html('Submit');
              var errors = response.data;
              $.each( errors, function( key, value ) {
                  toastr.error(value)
              });
          } else {
              toastr.success('Project Shared successfully!');
              location.reload();
          }
        }
    });
})


$(":checkbox").change(function() {
        // Check if the checkbox is checked
        if ($(this).is(':checked')) {
            $(this).val(1); // Set value to 1 when checked
        } else {
            $(this).val(0); // Set value to 0 when unchecked
        }
    });     
       



$(document).ready(function() {
    let dependencies = {
        'function_substitution_and_people': 'people_in_project',
        'separation_step': 'people_in_project',
        'people_and_communication': 'people_in_project',
        'communication_flow': 'people_and_communication',
        'functions_belong_to_people_explanation': 'people_in_project',
        'function_of_people_explanation': 'people_in_project',
        'me_vs__you_approach': 'people_in_project',
        'people_outside_the_project': 'people_in_project',
        'solution_time_location1': 'people_in_project',
        'solution_time_location2': 'people_in_project',
        'taking_advantage_on_other': 'people_in_project',
        'problem_and_solution_at_location_explanation': 'people_in_project',
        'function_at_location_explanation': 'people_in_project',
        'principle_identification': 'people_in_project',
        'entity_available': 'principle_identification',
        'entity_usage': 'principle_identification',
        'resource_management_consideration': 'entity_usage',
        'error_correction_approach':'problem_development_from_error_explanation',
        'averaging_approach':'partition_approach',
        'mother_nature_existence_explanation':'principle_identification',
    };

$("input[type='radio']").change(function() {
        let checkbox = $(this);
        let id = checkbox.attr('id');
       
        if (checkbox.is(':checked')) {
            // Ensure dependencies are also checked
            $.each(dependencies, function(child, parent) {
                if (child === id) {
                    $("#" + parent).prop('checked', true);
                }
            });
        } else {
            // If a required dependency is unchecked, warn user
            $.each(dependencies, function(child, parent) {
                if (parent === id && $("#" + child).is(':checked')) {
                    alert(parent + " must be selected if " + child + " is checked.");
                    checkbox.prop('checked', true);
                }
            });
        }
    });
});
</script>
@endsection