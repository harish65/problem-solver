<?php
$projectUsers  = \App\Models\Project::getUsers($project_id);
$problem  = \App\Models\Problem::where('id' , $problem_id)->first();
?>
<div class="container">
        <div class="mainTitle">
            <div class="row">
                   
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <?php
                                $categories =  \App\Models\Relationship::relationshipCat();
                            ?>
                            <h2>Relationship</h2>
                            <select class="form-control form-select" id="rel_types">
                            <option  selected="true" disabled="disabled">Select Relationship...</option>
                            
                                @foreach($categories as $cat)
                                    <optgroup label="{{ $cat->name }}">
                                            @foreach($relationships as $type)
                                                    @if($type->cat_id == $cat->id)
                                                        <option {{ (@$relationship->id == $type->id) ? 'selected' : '' }} value='{{ $type->id}}'>{{ $type->name }}</option>
                                                    @endif
                                            @endforeach
                                    </optgroup>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                @if($project->user_id == Auth::user()->id)
                    @if(isset($problem))
                    
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <h2>User</h2>
                            <select class="form-control form-select" id="verification_users">
                                <option selected="true" disabled="disabled">Select User..</option>
                                @foreach($projectUsers as $user)
                                <option  value='{{ @$user->id }}' {{ ($user_id == $user->id)  ?  'selected': '' }}>{{ $user->name }}</option>
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
                
            </div>
        </div>
    </div>
@section('scripts')
<script>
    $('#rel_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route('adult.rel',$parameter) }}" + '/' + id;
 })
    $('#verification_users').on('change', function () { 
        var relid = $('#rel_types').val();
        var re_id = $(this).val();
        window.location.href = "{{ route("adult.rel",$parameter) }}" + '/' + relid + '/' + re_id;
    });
    </script> 
@endsection