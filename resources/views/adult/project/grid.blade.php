<div class="projectlist" id="grid-view">
    <div class="container">
        <div class="row">
            @foreach ($project as $item)
                
            @php 
                $projectShared = \App\Models\Project::SharedProject($item->id,Auth::user()->id);
               
            @endphp
                @if(!empty($projectShared) && $projectShared->shared_with == Auth::user()->id && $projectShared->stop_sharing == 1)
                        @continue;
                @endif
                @if(($item->user_id == Auth::user()->id) || !empty($projectShared))
                    <div class="col">
                        <div class="projectBlock text-center">
                            <h2>{{ $item->name }}</h2>
                                <?php 
                                    
                                    
                                    $parameters = ($item->problem_id) ? ['project_id' => $item->id,'problem_id'=> $item->problem_id] : ['project_id' => $item->id,'problem_id'=> null];
                                    $parameter =  Crypt::encrypt($parameters);
                                    
                                ?>
                              
                            <a href="{{ route('adult.problem',$parameter) }}" data-params="{{ $parameter }}"
                                class="project-grid">
                                <div class="projectList">
                                    <h3>Problem</h3>
                                    <p class="redText">{{ ($item->problem && $item->problem != '') ? $item->problem : 'N/A' }}</p>
                                </div>
                                <div class="projectList">
                                    <h3>Solution</h3>
                                    <p class="greenText">{{ ($item->solution_name && $item->solution_name != '') ? $item->solution_name : 'N/A' }}</p>
                                </div>
                            </a>
                            <div class="projectList">
                                <p class="date">{{ date("m/d/Y" , strtotime($item->created_at))}}</p>

                                
                                <ul>
                                @if($item->user_id == Auth::user()->id)
                                    <li><a href="javaScript:void(0)" class="editBtn" data-id="{{ $item->id }}" title="Edit"
                                            data-title="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></a></li>
                                    <li><a href="javaScript:void(0)" class="deleteBtn" data-id="{{ $item->id }}" title="Delete" ><img
                                                src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adult.project-share' , Crypt::encrypt($item->id)) }}" title="Share"><img
                                                src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" /></a>
                                    </li>

                                    <li>
                                        
                                        <a href="{{ route('quiz' , Crypt::encrypt($item->id)) }}" title="Quiz"><i class="fa fa-question fa-lg"></i></a>
                                    </li>
                                    
                                    @else
                                        <li><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></li>
                                        <li><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></li>
                                        <li><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" /></li>
                                        <li><i class="fa fa-question"></i></li>
                                    @endif
                                </ul>
                                <button type="button" class=" btn btn-light btn-block">{{  ($item->shared == 1) ? 'Shared': 'Not Shared' }}</button>
                            </div>
                        </div>
                    </div>
                    @endif
            @endforeach
            <div class="col">
                <div class="projectBlock projectAdd text-center">
                    <h2>Add New Project</h2>
                    <div class="projectNew">
                        <button type="button" class="btn btn-primary" id="btnCreate"><img src="{{ url('/') }}/assets-new/images/addIcon.png"
                                alt="" /></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>