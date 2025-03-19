<?php 
    $categories   =  \App\Models\VerificationType::verificationTypeCategories(); 
    $projectUsers  = \App\Models\Project::getUsers($project_id);
    $project = \App\Models\Project::find($project_id);

    // echo '<pre>';print_r($types);
    // echo '<pre>';print_r($project->sharedUsers);die;



    ?>
<div class="col-md-6">
    <div class="d-flex align-items-center">
        <h2>Verification</h2>
        <select class="form-control form-select" id="verification_types">
            <option selected="true" disabled="disabled">Select Verification Type..</option>
            @foreach(@$categories as $cat)
                @php
                    $filteredTypes = $types->where('category', $cat->id);
                @endphp
                @if($filteredTypes->isNotEmpty())
                    <optgroup label="{{ $cat->name }}">
                        @foreach($filteredTypes as $type)
                            <option {{ (@$verificationType->id == $type->id) ? 'selected' : '' }} value='{{ $type->id }}'>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endif
            @endforeach
        </select>
    </div>
</div>
@php 
$can_edit = \App\Models\ProjectShared::where('project_id' ,$project_id)->where('shared_with',Auth::user()->id)->first();
@endphp
@if($project->user_id == Auth::user()->id)
    @if(isset($problem))
    
    <div class="col-md-6">
        <div class="d-flex align-items-center">
            <h2>User</h2>
            <select class="form-control form-select" id="verification_users">
                <option selected="true" disabled="disabled">Select User..</option>
                @foreach($projectUsers as $user)
                <option  value='{{ @$user->id }}' {{ ($problem->user_id == $user->id)  ?  'selected': '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
@endif
@else
    <div class="col-md-6">
        <div class="d-flex align-items-center">
            <h2>User</h2>
            <select class="form-control form-select" id="verification_types" disabled>
                <option selected="true" disabled="disabled">{{ Auth::user()->name }}</option>
            </select>
        </div>
    </div>
    @endif
   

    

