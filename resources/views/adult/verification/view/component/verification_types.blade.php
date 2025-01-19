<div class="col-md-6">
    <div class="d-flex align-items-center">
    <?php 
    
    $categories   =  \App\Models\VerificationType::verificationTypeCategories(); 
    $projectUsers  = \App\Models\Project::getUsers($project_id);
    $project = \App\Models\Project::find($project_id);
    
    ?>
        <h2>Verification</h2>
        <select class="form-control form-select" id="verification_types">
        <option selected="true" disabled="disabled">Select Verification Type..</option>
            @foreach(@$categories as $cat)
            <optgroup label="{{ $cat->name }}">
                    @foreach(@$types as $type)
                            @if($type->category == $cat->id)
                                <option {{ (@$verificationType->id == $type->id) ? 'selected' : '' }} value='{{ $type->id
                                    }}'>{{ $type->name }}
                                </option>
                            @endif
                    @endforeach
            </optgroup>
            @endforeach
            
        </select>
    </div>
</div>
@php 
$can_edit = \App\Models\ProjectShared::where('project_id' ,$project_id)->where('shared_with',Auth::user()->id)->first();
@endphp
@if($problem)
<div class="col-md-6">
    <div class="d-flex align-items-center">
        <h2>Users</h2>
        <select class="form-control form-select" id="verification_types">
            <option selected="true" disabled="disabled">Select User..</option>
            @foreach($projectUsers as $user)
            <option  value='{{ @$user->id }}' {{ ($problem->user_id == $user->id)  ?  'selected': '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
</div>
@endif

