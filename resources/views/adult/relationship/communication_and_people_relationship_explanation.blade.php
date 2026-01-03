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
                                    @if($custommers->count() > 0 && $communications->count() > 0)
                                        <div class="d-flex">
                                            @include('adult.relationship.common.people')
                                            @include('adult.relationship.common.upside')
                                        </div>  
                                    
                                    
                                        <div class="d-flex">
                                            @include('adult.relationship.common.communication')
                                            @include('adult.relationship.common.downside')
                                        </div>                        
                                    
                                    @endif
                                    
                            </div>
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

                    <div class="modal-header  bg-success text-white">
                        <h5 class="modal-title">Apply Relationship</h5>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Person 1 (Editable) -->
                        <div class="form-group mt-2">
                            <label>From Person (Person 1)</label>
                            <select id="person_1" class="form-select">
                                <option value="">Please select</option>
                                @foreach ($custommers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}:  {{$user->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="communication_detail" style="display: none;">
                                <!-- Person 2 (Readonly) -->
                                <div class="form-group mt-2">
                                    <label>To Person (Person 2)</label>
                                    <input type="text" id="to_person" class="form-control" readonly>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Subject</label>
                                    <input type="text" id="subject" class="form-control" readonly>
                                </div>
                                <div class="form-group mt-2">
                                    <label>Date</label>
                                    <input type="text" id="date_created" class="form-control" readonly>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Message</label>
                                    <textarea id="msg" class="form-control" rows="4" readonly></textarea>
                                </div>
                        </div>
                    </div>

                    <div class="modal-footer  bg-success text-white">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" id="applyRel">Yes, Apply</button>
                    </div>

                </div>
            </div>
        </div>

@endsection


