@if(isset($problem) && !empty($problem))
<div class="conditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Problem</h2>
                        <div class="projectList text-center"> 
                           
                        <?php 
                        
                            $parameters = ['problem_id'=> $problem->id , 'project_id' => $projectID];
                            $parameter =  Crypt::encrypt($parameters); 
                        ?>
                        
                        <a id="problem_nav" href="{{ route('adult.problem',$parameter) }}"></a>
                        <a id="solution_nav" href="{{ route('adult.solution',$parameter) }}"></a>
                        <a id="solution_fun_nav" href="{{ route('adult.solution-func',$parameter) }}"></a>
                        <a id="verification" href="{{ route('adult.varification',$parameter) }}"></a>
                        <a id="relationship" href="{{ route('adult.rel',$parameter) }}"></a>
                
                        <div class="imgWrp">
                                @if($problem -> type == 0)
                                    @if(strlen($problem -> file) < 15)
                                        <img class="mx-auto" src="{{ asset('assets-new/problem/' . $problem -> file) }}" width="100%" height="128px">
                                    @endif
                                    @elseif($problem -> type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
                                            <source src="{{ asset('assets-new/problem/' . $problem -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($problem -> type == 2)
                                            <iframe class="mx-auto" src="{{ $problem-> file }}" width="100%" height="128px"> </iframe>
                                    @endif
                        </div>
                        <p class="redText">{{ $problem->name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($problem->created_at))}}</p>
                    @if(($can_edit != null && $can_edit->editable_problem) || $project->user_id == Auth::user()->id)
                        <ul>
                            <!-- if can edit -->                        
                                <li>
                                    <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                        data-id   ="{{ $problem->id }}"
                                                                        data-name ="{{ $problem->name }}"
                                                                        data-type ="{{ $problem->type }}"
                                                                        data-file ="{{ $problem->file }}"
                                                                        data-cat  ="{{ $problem->category_id }}"
                                                                        data-actual_problrm_name = "{{ $problem ->actual_problrm_name}}">
                                        <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt=""/>
                                    </a>
                                </li>
                            
                                <li><a data-id="{{ $problem -> id }}" class=" " title="Delete" ><img src="{{ asset('/assets-new/images/deleteIcon.png')}}" alt=""/></a></li>
                                
                        </ul>
                    @else
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                @endif
                
              </div>
            </div>
            </div>
        </div>
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>
    <!-- Shared project role -->
    <div class="row identifeid_problem">
                
    </div>
    <!-- Shared project role -->
    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Have you performed analysis to identify the problem correctly?</p>
        <div class="form-group pl-5 pb-5">
           
            
                <div class="form-check">
                    <?php 
                        $parameters = ['problem_id'=> $problem->id , 'project_id' => $problem->project_id];
                        $parameter =  Crypt::encrypt($parameters);
                    ?>
                    
                    <label class="form-check-label">                
                    <input type="radio" {{ ($problem->validation == '0') ? 'checked' : ''}} value="0" data-id="{{ $parameter  }}" class="form-check-input validation" name="optradio" {{ ($project->user_id == Auth::user()->id) ? '':'disabled' }}>Yes, I have performed analysis to identify the problem correctly
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" {{ ($problem->validation == '1') ? 'checked' : ''}} value="1" data-id="{{ $parameter  }}" name="optradio" {{ ($project->user_id == Auth::user()->id) ? '':'disabled' }}>No, I have not performed analysis to identify the problem correctly
                    </label>
                </div>
                @if(($can_edit != null && $can_edit->editable_problem) || $project->user_id == Auth::user()->id)
                <div class="row col-sm-3 mt-5 {{ ($problem->user_id == Auth::user()->id) ? '':'d-none' }} ">
                    <button type="button" class="btn btn-success" id="saveValidations" onclick='saveValidations()'>Save Validations</button>
                </div>
                @endif
        </div>
    </div>
    @endif