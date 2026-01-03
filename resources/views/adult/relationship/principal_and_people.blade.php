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
        <a id="relationship" href="{{ route('adult.rel',@$parameter) }}"></a>
        @include('adult.relationship.common.rel-component')
    <!-- Content Section Start -->
      @if($showMessage)
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                
                        @if($relationship->id == 9)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                                    @if($principal)
                                        <div class="d-flex">
                                            @include('adult.relationship.common.people')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.principal')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    @else
                                    @php $showMessage = true @endphp
                                    @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif

                         @if($relationship->id == 10)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                                    @if($principal)
                                        <div class="d-flex">
                                            @include('adult.relationship.common.solution_func')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.principal')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    @else
                                    @php $showMessage = true @endphp
                                    @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif
                         @if($relationship->id == 11)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                                    @if($principal)
                                        <div class="d-flex">
                                        @include('adult.relationship.common.solution')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.principal')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    @else
                                    @php $showMessage = true @endphp
                                    @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif
                         @if($relationship->id == 12)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                            @if($principal && $words->count() > 0)
                                        <div class="d-flex">
                                            @include('adult.relationship.common.principal')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.voucab')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                            @else
                            @php $showMessage = true @endphp
                            @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif
                         @if($relationship->id == 13)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                            @if($entitieUsage)
                                        <div class="d-flex">
                                        @include('adult.relationship.common.solution')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.entity_usage')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    @else
                                    @php $showMessage = true @endphp
                                    @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif

                         @if($relationship->id == 14)
                        <!-- principleRelation start -->
                            <div class="principleRelation">                    
                                    @if($custommers->count() > 0)
                                        <div class="d-flex">
                                        @include('adult.relationship.common.people')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                        <div class="d-flex">
                                            @include('adult.relationship.common.solution_func')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    @else
                                    @php $showMessage = true @endphp
                                    @endif
                                    
                            </div>
                        <!-- principleRelation End -->
                         @endif


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

                                @if($relationship->id == 9)
                                    <div class="mb-3 d-flex justify-content-center">
                                        @include('adult.relationship.common.people')
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Principle Type : </label>
                                        <input type="text" class="form-control" disabled value="{{$principal->principle_type == 0 ? 'THE GIVEN SET' : 'DERIVED PRINCIPLE'}}">
                                    </div>
                                    @elseif($relationship->id == 10)
                                    <div class="card p-3 mb-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Solution Function :</label>
                                            <input class="form-control" type="text" id="communication" value="{{ 'Solution Function : ' . $Solution_function->name }}"  readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Solution Function Created At:</label>
                                            <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution_function->created_at)) }}"  readonly>
                                        </div>

                                        <div class="mb-3">
                                   
                                        <label class="form-label fw-bold">Principle Type : </label>
                                        <input type="text" class="form-control" disabled value="{{$principal->principle_type == 0 ? 'THE GIVEN SET' : 'DERIVED PRINCIPLE'}}">
                                        </div>
                                    </div>
                                    @elseif($relationship->id == 11)
                                    <div class="card p-3 mb-3">
                                        <div class="mb-3">
                                                <label class="form-label fw-bold">Solution :</label>
                                                <input class="form-control" type="text" id="communication" value="{{ 'Solution : ' . $Solution->name }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Solution Created At:</label>
                                                <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution->created_at)) }}"  readonly>
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label fw-bold">Principle Type : </label>
                                        <input type="text" class="form-control" disabled value="{{$principal->principle_type == 0 ? 'THE GIVEN SET' : 'DERIVED PRINCIPLE'}}">
                                        </div>
                                    </div>
                                    @elseif($relationship->id == 12)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Principle Type : </label>
                                        <input type="text" class="form-control" disabled value="{{$principal->principle_type == 0 ? 'THE GIVEN SET' : 'DERIVED PRINCIPLE'}}">
                                        </div>
                                        <div class="mb-3">
                                           

                                            @foreach($words as $word)
                                            <label class="form-label fw-bold">Vacabulary</label>
                                            <input type="text" class="form-control" disabled value="{{ $word->verification_key}}">
                                            @endforeach
                                               
                                            
                                        
                                    </div>
                                    @elseif($relationship->id == 13)
                                    <div class="card p-3 mb-3">
                                        <div class="mb-3">
                                                <label class="form-label fw-bold">Solution :</label>
                                                <input class="form-control" type="text" id="communication" value="{{ 'Solution : ' . $Solution->name }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Solution Created At:</label>
                                                <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution->created_at)) }}"  readonly>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-center">
                                        @include('adult.relationship.common.entity_usage')
                                        </div>
                                    </div>

                                    @elseif($relationship->id == 14)
                                    <div class="card p-3 mb-3">
                                    <div class="mb-3">
                                            <label class="form-label fw-bold">Solution Function :</label>
                                            <input class="form-control" type="text" id="communication" value="{{ 'Solution Function : ' . $Solution_function->name }}"  readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Solution Function Created At:</label>
                                            <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution_function->created_at)) }}"  readonly>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-center">
                                        @include('adult.relationship.common.people')
                                        </div>
                                    </div>
                                    @endif
                                
                                
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
