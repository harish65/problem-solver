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

    $('#verification_users').on('change', function () { 
        var relid = $('#rel_types').val();
        var re_id = $(this).val();
        window.location.href = "{{ route("adult.rel",$parameter) }}" + '/' + relid + '/' + re_id;
    });
    </script> 
    
    <script>
        var showMessage = "{{$showMessage ?? ''}}";
        var text_ = "{{ @$relationship->error_msg }}";
        var title_ = "{{ @$relationship->name ?? '' }}"
        if(!showMessage && text_ != ''){

            swal({
                title: title_,
                text: text_,
                type: "Error",
                showCancelButton: true,
                confirmButtonColor: '#00A14C',
            });
        }
    
                $('#applyRel').click(function(){
                $.ajax({
                    url: "{{ route('adult.relationshipApplied') }}", 
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",  
                        project_id: '{{$project_id}}',  
                        user_id: "{{ $user_id }}",     
                        rel_id: '{{@$relationship->id}}',      
                        applied: true   
                    },
                    success: function (response) {
                        if (response.success) {
                            swal("Success", "Relationship applied!", "success");
                            window.location.reload();
                        } else {
                            swal("Error", "There was an issue creating the entry.", "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        swal("Error", "Request failed. Please try again.", "error");
                    }
                });
                })
    
    
    $('#rel_types').on('change', function () {
        var id = $(this).val();
        
        
        window.location.href = "{{ route('adult.rel', $parameter) }}" + '/' + id;
    });


    
</script>

@endsection