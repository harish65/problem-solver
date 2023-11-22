@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route("adult.problem",@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route("adult.solution",@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route("adult.solution-func",@$parameter) }}"></a>
                      <a id="verification" href="{{ route("adult.varification",@$parameter) }}"></a>   

                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <h2>Verification</h2>
                        <select class="form-control form-select" id="verification_types">
                                <option value=''>Select Verification Type..</option>
                            @foreach(@$types as $type)
                                <option {{  (@$verificationType->id  == $type->id) ? 'selected' : '' }} value='{{ $type->id }}'>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset("assets-new/verification_types/" . @$verificationType->banner)}}" alt="relationImage" />
                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Person</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src="/assets-new/person/1676429790.png" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:red">Adult</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                </div>
                            </div>
                        </div>
                        <div class="line-border"></div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                </div>
                            </div>
                        </div>
                        <div class="line-border"></div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Solution</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src=" {{ asset('assets-new/solution/'.$solution->file)}}" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:#00A14C">{{ $solution->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        

                        <h2>Validation Question</h2>
                        <br>
                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}">
                                    <ul class="validate_que">
                                        <h5>Have you separated the problem from yourself?</h5>
                                        <li><label><input  type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} value="1">Yes, I have separated the problem from myself</label></li>
                                        <li><label><input  type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} value="2">No, I haven't separated the problem from myself</label></li>
                                        <br>
                                        <h5>Have you separated the problem from the people?</h5>
                                        <li><label><input  type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} value="1" >Yes, I have separated the problem from the people</label></li>
                                        <li><label><input  type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}  value="2">No, I haven’t separated the problem from the people</label></li>
                                    </ul>
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                        
                    </div>
                </div>
                <!-- End -->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->


    
    
    
    <!-- Modal End -->
</div>

@endsection
@section('css')
<style>
    .line-border{
        border-left: 2px dashed black;
        height: 338px;
        border-right: 2px dashed black;
        height: 338px;
        padding : 1px;
    }
    .validate_que{
        list-style:none;
    }
</style>
@endsection
@section('scripts')
<script>
    $('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})
</script>
@endsection