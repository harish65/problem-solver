@extends('adult.layouts.adult')
@section('title', 'Adult | Relationship')
@section('content')
@php $showMessage = false @endphp
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
                               
                            <div class="d-flex">
                                @include('adult.relationship.common.principal')
                                @include('adult.relationship.common.upside')
                            </div>  
                        
                        
                            <div class="d-flex">
                                @include('adult.relationship.common.communication')
                                @include('adult.relationship.common.downside')
                            </div>                        
                               
                                
                        </div>
                        <!-- principleRelation End -->
                    @include('adult.relationship.common.validation')
                
            </div>
        </div>
    </div>


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
            title: "Communication and Principle Relationship Explanation",
            text: text_,
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
</script> 
@endsection
