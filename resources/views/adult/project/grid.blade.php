<div class="projectlist" id="grid-view">
    <div class="container">
        <div class="row">
            @foreach ($project as $item)
            <div class="col">
                <div class="projectBlock text-center">
                    <h2>{{ $item->name }}</h2>
                    <div class="projectList">
                        <h3>Problem</h3>
                        <p class="redText">{{ ($item->problem != '') ? $item->problem : 'N/A' }}</p>
                    </div>
                    <div class="projectList">
                        <h3>Solution</h3>
                        <p class="greenText">New Oil</p>
                    </div>
                    <div class="projectList">
                        <p class="date">12:12:2022</p>
                        <ul>
                            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></a>
                            </li>
                            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" /></a>
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