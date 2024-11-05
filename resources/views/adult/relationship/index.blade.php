@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')


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
    <div class="relationshipContent" style='min-height:200px;'>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   
                    <div class="relationImage text-center">
                        
                    </div>
                    
                </div>
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock">

                    </div>
                    <div class="questionWrap">
                        
                    </div>
                </div>
                <!-- End -->

            </div>
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
 
</script> 
@endsection