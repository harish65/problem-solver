<div class="projectlist" id="grid-view">
    <div class="container">
        <div class="row">
            @foreach ($project as $item)
            <div class="col">
                <div class="projectBlock text-center">
                    
                        <h2>{{ $item->name }}</h2>
                        <?php 
                            $parameters = ['problem_id'=> $item->problem_id , 'project_id' => $item->id];
                            $parameter =  Crypt::encrypt($parameters);
                        ?>
                        <a href="{{ route("adult.problem",@$parameter) }}" data-params="{{ $parameter }}" class="project-grid">
                            <div class="projectList">
                                <h3>Problem</h3>
                                
                                <p class="redText">{{ ($item->problem != '') ? $item->problem : 'N/A' }}</p>
                            </div>
                            <div class="projectList">
                                <h3>Solution</h3>
                                <p class="greenText">New Oil</p>
                            </div>
                        </a>
                    <div class="projectList">
                        <p class="date">{{ date("d/m/Y" , strtotime($item->created_at))}}</p>
                        <ul>
                            <li><a href="javaScript:void(0)" class="editBtn" data-id="{{ $item->id }}" data-title="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></a></li>
                            <li><a href="javaScript:void(0)" class="deleteBtn" data-id="{{ $item->id }}" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></a>
                            </li>
                            <li><a href="javaScript:void(0)" class="shareBtn" data-id="{{ $item->id }}"><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col">
                <div class="projectBlock projectAdd text-center">
                  <h2>Add New Project</h2>
                  <div class="projectNew">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addprojectModal"><img src="{{ url('/') }}/assets-new/images/addIcon.png" alt=""/></button>
                  </div>
               
                </div>
              </div>
        </div>
    </div>
</div>