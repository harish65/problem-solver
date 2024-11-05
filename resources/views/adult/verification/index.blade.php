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
                      <a id="relationship" href="{{ route('adult.rel',@$parameter) }}"></a>
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
routes();

$('.dashboard').click(function(){
    routes();
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