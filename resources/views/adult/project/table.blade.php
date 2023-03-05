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
                            <td>{{ date('d/m/Y' , strtotime($item->created_at))}}</td>
                            <?php $parameter= Crypt::encrypt($item->problem_id);?>
                            <td><a class="grid-p-l" href="{{ route("adult.problem" ,@$parameter) }}" >{{ $item->name }}</a></td>
                            <td style="color:red">{{ ($item->problem != '') ? $item->problem : 'N/A' }}</td>
                            <td style="color:#00A14C">{{ ($item->solution_name != '') ? $item->solution_name : 'N/A' }}</td>
                            <td>
                                <a href="javaScript:void(0)" class="editBtn" data-id="{{ $item->id }}" data-title="{{ $item->name }}"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt="" /></a>
                                <a href="javaScript:void(0)" class="deleteBtn" data-id="{{ $item->id }}"><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt="" /></a>
                                <a href="javaScript:void(0)" class="shareBtn" data-id="{{ $item->id }}"><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt="" />
                            </td>
                            
                        </tr>
                        
                    @endforeach
                  
                </tbody>
            </table>
            
        </div>
    </div>   
</div>    