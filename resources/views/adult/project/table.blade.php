<div class="projectlist d-none" id="table-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-end">
                <button class="btn btn-success add-project-btn" data-toggle="modal" data-target="#addprojectModal"><i class="fa fa-plus"></i>Add Project</button>
            </div>
            <table class="table slp-tbl" id="myTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Problem</th>
                        <th>Solution</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                    @foreach ($project as $item)
                        <tr>
                            <td>{{ date('m/d/Y' , strtotime($item->created_at))}}</td>

                            <?php 
                            $parameters = ['problem_id'=> $item->problem_id , 'project_id' => $item->id];
                            $parameter =  Crypt::encrypt($parameters);
                            ?>
                            
                            <td><a class="grid-p-l" href="{{ route('adult.problem' ,@$parameter) }}" >{{ $item->name }}</a></td>
                            <td style="color:red">{{ ($item->problem != '') ? $item->problem : 'N/A' }}</td>
                            <td style="color:#00A14C">{{ ($item->solution_name != '') ? $item->solution_name : 'N/A' }}</td>
                            <td>
                            @if($item->user_id == Auth::user()->id)
                                <a href="javaScript:void(0)" class="editBtn" data-id="{{ $item->id }}" data-title="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></a>
                                <a href="javaScript:void(0)" class="deleteBtn" data-id="{{ $item->id }}"><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></a>
                                <a href="javaScript:void(0)" class="shareBtn" data-id="{{ $item->id }}" data-shared="{{ $item->shared }}" data-name="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" /></a>
                                <a href="javaScript:void(0)" class="viewBtn" data-id="{{ $item->id }}" data-shared="{{ $item->shared }}" data-name="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/viewIcon.png" alt="" /></a>

                                @else
                                    <img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" />
                                    <img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" />
                                    <img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" />
                                    <img src="{{ url('/') }}/assets-new/images/viewIcon.png" alt="" />
                            @endif
                            </td>
                            
                        </tr>
                        
                    @endforeach
                  
                </tbody>
            </table>
            
        </div>
    </div>   
</div>    