<div class="conditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                <div class="imgWrp">
                                @if($solFunctions -> problem_type == 0)
									@if(strlen($solFunctions -> problem_file) < 15)
                                            <img class="mx-auto" src="{{ asset('assets-new/problem/'.$solFunctions->problem_file)}}"  width="100%" height="128px">
									@endif
                                    @elseif($solFunctions -> problem_type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                            <source src="{{ asset('assets-new/problem/' . $solFunctions -> problem_file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunctions -> problem_type == 2)
                                            <iframe class="mx-auto" src="{{ $solFunctions -> problem_file }}" width="100%" height="128px"> </iframe>
                                    @endif
                    </div>
                    <p class="redText">{{ $solFunctions->problem_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->problem_created_at)) }}</p>
                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                </div>
            </div>
        </div>
        <div class="long-arrow">
        <p style="position:relative; top:35px;left:23px;">{{ $solFunctions->first_arr }}</p>
            <!-- add arrow Image over here -->
            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
            <!-- add arrow Image over here -->
          </div>
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Solution</h2>
                <div class="projectList text-center">
                        <div class="imgWrp">
                            @if($solFunctions -> solution_type == 0)
                                        @if(strlen($solFunctions -> solution_file) < 15)
                                            <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solFunctions->solution_file)}}"  width="100%" height="128px">
                                        @endif
                                    @elseif($solFunctions -> solution_type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                            <source src="{{ asset('assets-new/problem/' . $solFunctions -> solution_file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunctions -> solution_type == 2)
                                            <iframe class="mx-auto" src="{{ $solFunctions -> solution_file }}"  width="100%" height="128px"> </iframe>
                                    @endif
                        </div>
                    <p class="redText">{{ $solFunctions ->solution_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->solution_created)) }}</p>
                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                </div>
            </div>
        </div>
        <div class="long-arrow">
        <p style="position:relative; top:35px;left:25px;">{{ $solFunctions->second_arr }}</p>
            <!-- add arrow Image over here -->
            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
            <!-- add arrow Image over here -->
          </div>
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Solution Function</h2>
                <div class="projectList text-center">
                    <div class="imgWrp">
                        @if($solFunctions -> type == 0)
                                @if(strlen($solFunctions -> file) < 15)
                                    <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$solFunctions->file)}}"  width="100%" height="128px">
                                @endif
                            @elseif($solFunctions -> type == 1)
                                <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                    <source src="{{ asset('assets-new/solFunction/' . $solFunctions -> file) }}#t=0.1" type="video/mp4">
                                </video>
                            @elseif($solFunctions -> file == 2)
                                    <iframe class="mx-auto" src="{{ $solFunctions -> file }}" width="100%" height="128px"> </iframe>
                            @endif
                    </div>
                    <p class="redText">{{ $solFunctions->name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->created_at)) }}</p>
                    @if(!is_null($solFunctions) && $solFunctions->user_id === Auth::user()->id)
                        <ul>
                            <li>
                                <a href="javaScript:Void(0)" class="editSolFunBtn"
                                
                                data-id="{{ $solFunctions->id }}"
                                data-problem="{{ $solFunctions->problem_id }}"
                                data-solution="{{ $solFunctions->solution_id }}"
                                data-file ="{{ $solFunctions->file }}"
                                data-name ="{{ $solFunctions->name }}"
                                data-solution_function_type_id ="{{ $solFunctions->solution_function_type_id }}"
                                >
                                    <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a data-id="{{ $solFunctions->id }}"  class="delSolFunBtn" title="Delete">
                                <img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""></a>
                            </li>
                        </ul>

                            @else
                            <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                            @endif
                
                </div>
            </div>
        </div>
    </div>