@if(isset($solution))
<div class="solutionconditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Problem</h2>
              <div class="projectList text-center"> 
                <div class="imgWrp">                      
                
                            @if($solution->problem_type == 0)
                                    @if(strlen($solution -> problem_file) < 15)
									    <img class="mx-auto aaa" src="{{ asset('assets-new/problem/' . $solution -> problem_file) }}" width="100%" height="128px">
                                    @endif
                            @elseif($solution -> problem_type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
										<source src="{{ asset('assets-new/problem/' . $solution -> problem_file) }}#t=0.1" type="video/mp4">
									</video>
                            @elseif($solution -> problem_type == 2)
									    <iframe class="mx-auto" src="{{ $solution -> problem_file }}"width="300" height="320"> </iframe>
                            @endif
                    </div>
                <p class="redText">{{ $solution->problem_name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($solution->problem_created_at))}}</p>
                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
              </div>
            </div>
          </div>
          <div class="long-arrow">            
                <p style="position:relative; top:35px;left:10px;">{{ $solution->output_slug }}</p>
            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
            <!-- add arrow Image over here -->
          </div>
          
          <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Solution</h2>
              <div class="projectList text-center"> 
              <div class="imgWrp">
                            @if($solution -> type == 0)
									@if(strlen($solution -> file) < 15)
										<img class="mx-auto" src="{{ asset('assets-new/solution/'.$solution -> file) }}" width="100%" height="128px">
									@endif
								    @elseif($solution -> type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
										<source src="{{ asset('assets-new/solution/'.$solution -> file) }}#t=0.1" type="video/mp4">
									</video>
								    @elseif($solution -> type == 2)
									    <iframe class="mx-auto" src="{{ $solution -> file }}" width="100%" height="128px"> </iframe>
								    @endif 
              </div>
                <p class="redText">{{ $solution->name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($solution->created_at)) }}</p>
              
                  @if(!is_null($solution) && $solution->user_id === Auth::user()->id)
                        <ul>
                            <li>
                                    <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                                        data-id="{{ $solution -> id }}"
                                                                                        data-name="{{ $solution -> name }}"
                                                                                        data-problem="{{ $solution -> problem_name }}"
                                                                                        data-type="{{ $solution -> type }}"
                                                                                        data-file="{{ $solution -> file }}"                                                                            
                                                                                        data-type-id ="{{ $solution -> solution_type_id }}"
                                                                                                
                                    >
                                        <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt=""/>
                                    </a>
                                </li>
                            <li><a data-id="{{ $solution -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""/></a></li>
                            
                        </ul>
                        @else
                        <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                  @endif
              </div>
            </div>
          </div>
    </div>

    @endif