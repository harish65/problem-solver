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
                <div class="col-sm-12">
                    <h1>{{ $relationship->name }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset('rel/' . $relationship->image)}}" alt="relationImage" />
                    </div>
                    <p>{{ $relationship->text }}</p>
                </div>
                
                        <!-- principleRelation start -->
                        <div class="principleRelation">   
                        @if(isset($verification))                     
                        @if($verification->id && $principal)
                                    <div class="d-flex">
                                    @include('adult.relationship.common.principal')
                                        @include('adult.relationship.common.upside')
                                    </div>  
                                    <div class="d-flex">
                                        @include('adult.relationship.common.information')
                                        @include('adult.relationship.common.downside')
                                    </div>                        
                           
                            @endif
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
         <div class="relationshipContent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                <button type="button" id="applyRel" class="btn btn-success">Apply Relationship +</button>
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
