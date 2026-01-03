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
                        @if(isset($principal)) 
                        <div class="principleRelation">                    
                            
                            <div class="d-flex">
                                @include('adult.relationship.common.principal')
                                @include('adult.relationship.common.upside')
                            </div>  
                        
                        
                            <div class="d-flex">
                                @include('adult.relationship.common.communication')
                                @include('adult.relationship.common.downside')
                            </div>                        
                           
                            
                                
                        </div>
                        @else
                        @php $showMessage = true @endphp
                        @endif
                        <!-- principleRelation End -->
                        @include('adult.relationship.common.validation')
                
            </div>
        </div>
    </div>
    @else
        @include('adult.relationship.common.apply_relationship_button')
        @endif

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
                      
                            <div class="col-12 mb-2">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Communication
                                    </label>
                                    <select class="form-select"   style="height:auto;">
                                        @foreach($custommers as $user)
                                        <option>{{ $user->name }} : Communication</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                       
                        @if (isset($principal))
                
                        @if ($principal->principle_type == 1)
                        
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Principal : THE GIVEN SET
                                </label>
                                <ol class="form-control bg-light" style="height:auto; padding-left:10%;">
                                    @foreach ($drived_principle as $item)
                                            <li>{{ strip_tags($item->content) }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        @else
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Principal : DERIVED PRINCIPLE
                                </label>
                                <ol class="form-control bg-light" style="height:auto; padding-left:10%;">
                                    @foreach ($drived_principle as $item)
                                        <li>{{ strip_tags($item->content) }}</li>
                                    @endforeach
                                    </ol>
                            </div>
                        </div>
                            @endif
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
@endsection 

