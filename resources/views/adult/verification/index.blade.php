@extends('adult.layouts.adult')
@section('title', 'Adult | Verifications Types')
@section('content')
<?php $showMsg = false ?>
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                      <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>   

                      @include('adult.verification.view.component.verification_types')
            </div>
        </div>
    </div>
   
    <!-- Content Section Start -->
    <div class="relationshipContent" style="min-height:200px;">
        <div class="container">
            @if(isset($verificationType->id))
                @include('adult.verification.verification-content')
                <?php $showMsg = true; ?>
            @endif
        </div>
    </div>
    <!-- Content Section End -->
    <!-- Modal End -->
</div>

@endsection

@section('scripts')

<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})



</script>
<script>
$('.nav-problem').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));   
    $(this).attr('href' ,$('#problem_nav').attr('href'))
})
$('.nav-solution').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_nav').attr('href'))
})
$('.nav-solution-func').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_fun_nav').attr('href'))
})
$('.verification').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $(this).attr('href' ,$('#verification').attr('href'))
})


$('.dashboard').click(function(){
    //Solution
    $('.nav-solution').attr('href' , '');
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $('.nav-solution').attr('href' ,$('#solution_nav').attr('href'))
    //Problem
    $('.nav-problem').attr('href' , '');
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));       
    $('.nav-problem').attr('href' ,$('#problem_nav').attr('href'))
    //Sol fun
    $('.nav-solution-func').attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $('.nav-solution-func').attr('href' ,$('#solution_fun_nav').attr('href'))
    //verification
    $('.nav-varification').attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $('.nav-varification').attr('href' ,$('#solution_fun_nav').attr('href'))

})
var msg = '{{$showMsg}}';
if(msg) { 
    swal({
        title: "{{@$verificationType->error_title}}",
        text:  "{{@$verificationType->message}}",
        type: "Error",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
}
    
</script>
@endsection