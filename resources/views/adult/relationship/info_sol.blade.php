@extends('adult.layouts.adult')
@section('title', 'Adult | Relationship')
@section('content')
<?php $showMessage =  \App\Models\Relationship::appliedRelationship($relationship->id,$project_id,$user_id); ?>
<div class='relationshipPage'>
    
        <?php 
            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
            $parameter =  Crypt::encrypt($parameters);
        ?>
        <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
        <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
        <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
        <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>
        <a id="rel" href="{{ route('adult.rel',@$parameter) }}"></a>
        @include('adult.relationship.common.rel-component')
    <!-- Content Section Start -->
     @if($showMessage)
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
               
                
                        <!-- principleRelation start -->
                        <div class="principleRelation">                    
                        @if($verification)
                                    <div class="d-flex">
                                        @include('adult.relationship.common.information')
                                        @include('adult.relationship.common.upside')
                                    </div>  
                                    <div class="d-flex">
                                        @include('adult.relationship.common.solution')
                                        @include('adult.relationship.common.downside')
                                    </div>                        
                                @else
                                @php $showMessage = true @endphp
                                @endif
                                
                        </div>
                        <!-- principleRelation End -->
                    @include('adult.relationship.common.validation')
                
            </div>
        </div>
    </div>
@else
        @include('adult.relationship.common.apply_relationship_button')
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Apply Relationship</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                            <div class="card p-3">
                                                @if($verification->file == 1)
                                                    <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-001.jpg')}}" width="100%" height="250px">
                                                @else
                                                    <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-002.jpg')}}" width="100%" height="250px">
                                                @endif
                                                <label class="form-label fw-bold mt-3">Information : </label>
                                                <input type="text" class="form-control" disabled value="{{ date('d/m/Y' , strtotime($verification->created_at)) }}">
                                               
                                            </div>
                                        
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Solution :</label>
                                        <input class="form-control" type="text" id="communication" value="{{ 'Solution : ' . $Solution->name }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Solution Created At:</label>
                                        <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution->created_at)) }}"  readonly>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer bg-success text-white">
                            <button class="btn btn-secondary border-2" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" id="applyRel">Yes, Apply</button>
                        </div>
                        </div>
                </div>
            </div>
        </div>
        @endif

@endsection 
@section('scripts')
<script>
    $('#rel_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route('adult.rel',$parameter) }}" + '/' + id;
    })
 var showMessage = "{{$showMessage}}"
    var text_ = '{{ $relationship->error_msg}}'
    if (showMessage) {
       
        swal({
            title: 'Communication and Solution Function Relationship Explanation',
            text: text_,
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
</script> 
@endsection
