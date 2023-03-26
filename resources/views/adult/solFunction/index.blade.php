@extends('layouts.adult')
@section('title', 'Solution Function | Adult')

@section('content')
    <div class="min-height-200px">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="assets/vendors/images/banner-img.png" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back <div class="weight-600 font-30 text-blue" style="display: inline-block">{{ Auth::user() -> name}}</div>
                    </h4>
                    <p class="font-18 max-width-600">This is Solution Function panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="row clearfix progress-box">

                @foreach ($solFunctions as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Problem
							</span>	
                            @if($item->problem->file == null)
								<div class="fileField"></div>
							@else
								@if($item -> problem -> type == 0)
									@if(strlen($item -> problem -> file) < 15)
										<img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
									@endif
								@elseif($item -> problem -> type == 1)
									<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
										<source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($item -> problem -> type == 2)
									<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
								@endif
							@endif					
							<h5 class="text-light-green padding-top-10 h5">
								{{ $item -> problem -> name }}
							</h5>
                            
							<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> problem -> user -> name }} </span>
							
						</div>
					</div>
				</div>
                <div class="col-lg-1 text-center px-0" style="margin-top: 20vh">
                    @if($item -> solution_function_type_id == 1)
                    is solved by
                    @elseif($item -> solution_function_type_id == 2)
                    is substituted by
                    @elseif($item -> solution_function_type_id == 3)
                    is replaced by
                    @endif
                    <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30 px-0">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Solution
							</span>	
                            @if($item -> solution -> file == null)
								<div class="fileField"></div>
							@else
								@if($item -> solution -> type == 0)
									@if(strlen($item -> solution -> file) < 15)
										<img src="{{ asset("assets/solution/" . $item -> solution -> file) }}" class="w-100 fileField">
									@endif
								@elseif($item -> type == 1)
									<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
										<source src="{{ asset("assets/solution/" . $item -> solution -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($item -> type == 2)
									<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
								@endif
							@endif					
							<h5 class="text-light-green padding-top-10 h5">
								{{ $item -> solution -> name }}
							</h5>
                            
							<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution -> user -> name }} </span>
						</div>
					</div>
				</div>
                <div class="col-lg-1 text-center px-0" style="margin-top: 20vh">
                    @if($item -> solution_function_type_id == 1)
                    from
                    @elseif($item -> solution_function_type_id == 2)
                    from
                    @elseif($item -> solution_function_type_id == 3)
                    through
                    @endif
                    <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pl-0">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Function
							</span>	
                            @if($item -> file == null)
								<div class="fileField"></div>
							@else
								@if($item -> type == 0)
									@if(strlen($item -> file) < 15)
										<img src="{{ asset("assets/solFunction/" . $item -> file) }}" class="w-100 fileField">
									@endif
								@elseif($item -> type == 1)
									<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
										<source src="{{ asset("assets/solFunction/" . $item -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($item -> type == 2)
									<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
								@endif
							@endif					
							<h5 class="text-light-green padding-top-10 h5">
								{{ $item -> name }}
							</h5>
                            
							<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
							<div class="btn-group mb-15">
								<button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateSolFunctionBtn" 
								data-id="{{ $item -> id }}"
                                data-type="{{ $item -> type }}"
								data-file="{{ $item -> file }}"
								data-problem="{{ $item -> problem_id }}"
								data-solution="{{ $item -> solution_id }}"
								data-solfunction="{{ $item -> solution_function_type_id }}"
								data-name="{{ $item -> name }}"
								><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
								<button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delSolFunctionBtn" data-id="{{ $item -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
                <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                @endforeach
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
					<div class="card-box pd-30 height-100-p" data-toggle="tooltip" title="Identify Solution Function">
						<div class="progress-box text-center" id="createSolFunctionBtn">
							<h1 class="text-light-green padding-top-10 h1" style="font-size: 10rem">
								<i class="icon-copy fa fa-plus" aria-hidden="true"></i>
							</h1>
							<span class="d-block">Identify Solution Function</span>
						</div>
					</div>
				</div>
            </div>

            <div class="clearfix progress-box mb-30">
                <div class="card-box table-responsive p-0" style="border-radius: 0">
                    <h5 class="d-block text-center bg-success p-2 text-white">
                       Problem and Solution and Solution Function Identification
                    </h5>	
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr style="text-align: center;">
                            <th scope="col" style="font-weight: 900">Problem</th>
                            {{-- <th scope="col"></th> --}}
                            <th scope="col" style="font-weight: 900">Solution</th>
                            {{-- <th scope="col"></th> --}}
                            <th scope="col" style="font-weight: 900">Function</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse ($solFunctions as $solFunction)
                          <tr style="text-align: center; align-content: center">
                            <td scope="row">
                                {{-- @if($solFunction -> problem -> file == null)
                                    <div class="fileFieldAdultTable"></div>
                                @else
                                    @if($solFunction -> problem -> type == 0)
                                        @if(strlen($solFunction -> problem -> file) < 15)
                                            <img src="{{ asset("assets/problem/" . $solFunction -> problem -> file) }}" class="w-20 fileFieldAdultTable">
                                        @endif
                                    @elseif($solFunction -> problem -> type == 1)
                                        <video width="400" controls="controls" preload="metadata" class="w-20 fileFieldAdultTable" preload="metadata">
                                            <source src="{{ asset("assets/problem/" . $solFunction -> problem -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunction -> problem -> type == 2)
                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solFunction -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-20 fileFieldAdultTable">
                                    @endif
                                @endif
                                <br> --}}
                                {{ $solFunction -> problem -> name }}
                            </td>
                            {{-- <td style="width: 15%">
                                @if($item -> solution_function_type_id == 1)
                                    is solved by
                                @elseif($item -> solution_function_type_id == 2)
                                    is substituted by
                                @elseif($item -> solution_function_type_id == 3)
                                    is replaced by
                                @endif<br>
                                <img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">
                            </td> --}}
                            <td scope="row">
                                {{-- @if($solFunction -> solution -> file == null)
                                    <div class="fileFieldAdultTable"></div>
                                @else
                                    @if($solFunction -> solution -> type == 0)
                                        @if(strlen($solFunction -> solution -> file) < 15)
                                            <img src="{{ asset("assets/solution/" . $solFunction -> solution -> file) }}" class="w-20 fileFieldAdultTable">
                                        @endif
                                    @elseif($solFunction -> solution -> type == 1)
                                        <video width="400" controls="controls" preload="metadata" class="w-20 fileFieldAdultTable" preload="metadata">
                                            <source src="{{ asset("assets/solution/" . $solFunction -> solution -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunction -> solution -> type == 2)
                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solFunction -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-20 fileFieldAdultTable">
                                    @endif
                                @endif
                                <br> --}}
                                {{ $solFunction -> solution -> name }}
                            </td>
                            {{-- <td style="width: 15%">
                                @if($item -> solution_function_type_id == 1)
                                    from
                                @elseif($item -> solution_function_type_id == 2)
                                    from
                                @elseif($item -> solution_function_type_id == 3)
                                    through
                                @endif<br>
                                <img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">
                            </td> --}}
                            <td scope="row">
                                {{-- @if($solFunction -> file == null)
                                    <div class="fileFieldAdultTable"></div>
                                @else
                                    @if($solFunction -> type == 0)
                                        @if(strlen($solFunction -> file) < 15)
                                            <img src="{{ asset("assets/solFunction/" . $solFunction -> file) }}" class="w-20 fileFieldAdultTable">
                                        @endif
                                    @elseif($solFunction -> type == 1)
                                        <video width="400" controls="controls" preload="metadata" class="w-20 fileFieldAdultTable" preload="metadata">
                                            <source src="{{ asset("assets/solFunction/" . $solFunction -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunction -> type == 2)
                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solFunction -> file)[1])[1] . "/0.jpg" }}" class="w-20 fileFieldAdultTable">
                                    @endif
                                @endif
                                <br> --}}
                                {{ $solFunction -> name }}
                            </td>
                          </tr>
                          @empty
                              <tr style="text-align: center">
                                  <td colspan="3">There is no data to show</td>
                              </tr>
                          @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (count($problems) > 0)
    <form method="POST" action="{{ url("createSolFunction") }}" class="modal fade" id="createSolFunctionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Identify Solution Function</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="type" value="0" id="createSolFunctionType">
                    <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createSolFunctionFileRadio" name="type" class="custom-control-input createSolFunctionType" value="0" checked>
									<label class="custom-control-label" for="createSolFunctionFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createSolFunctionLinkRadio" name="type" class="custom-control-input createSolFunctionType" value="2">
									<label class="custom-control-label" for="createSolFunctionLinkRadio"> Link</label>
								</div>
							</div>
						</div>
					</div>
                    <div class="form-group" id="createSolFunctionFileType">
						<input type="file" name="file" id="createSolFunctionPhoto" class="dropify" accept="image/*, video/*">
						@error('file')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createSolFunctionModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="createSolFunctionLinkType" style="display: none">
						<input type="url" name="link" class="form-control" placeholder="Link">
						@error('link')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createSolFunctionModal").modal("show");
								})
							</script>
						@enderror
					</div>
                    <div class="form-group">
                        <select class="custom-select" name="problem_id" id="createSolFunctionProblemSelect">
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="solution_id" id="createSolFunctionSolutionSelect">
                            @foreach ($solutions as $item)
                                <option value="{{ $item -> id }}">Solution: {{ $item -> name }}</option>                                    
                            @endforeach
                        </select>
                        @error('solution_id')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createSolFunctionModal").modal("show");
								})
							</script>
						@enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#createSolFunctionModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="solution_function_type_id">
							<option value="1">Problem is solved by solution from solution function</option>
							<option value="2">Problem is substituted by solution from solution function</option>
							<option value="3">Problem is replaced by solution through solution function</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("updateSolFunction") }}" class="modal fade" id="updateSolFunctionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upate Solution Function</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="updateSolFunctionId" id="updateSolFunctionId">
                    <input type="hidden" name="updateSolFunctionType" id="updateSolFunctionType">
                    <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolFunctionFileRadio" name="updateSolFunctionType" class="custom-control-input updateSolFunctionType" value="0">
									<label class="custom-control-label" for="updateSolFunctionFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolFunctionLinkRadio" name="updateSolFunctionType" class="custom-control-input updateSolFunctionType" value="2">
									<label class="custom-control-label" for="updateSolFunctionLinkRadio"> Link</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="updateSolFunctionFileType">
						<input type="file" name="updateSolFunctionFile" id="updateSolFunctionFileFile" class="dropify" accept="image/*, video/*">
						@error('updateSolFunctionFile')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateSolFunctionModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="updateSolFunctionLinkType" style="display: none">
						<input type="url" name="updateSolFunctionFileLink" id="updateSolFunctionLinkType" class="form-control" placeholder="Link">
						@error('updateSolFunctionFileLink')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateSolFunctionModal").modal("show");
								})
							</script>
						@enderror
					</div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionProblemId" id="updateSolFunctionProblemId">
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionSolutionId" id="updateSolFunctionSolutionSelect">
                            
                        </select>
                        @error('updateSolFunctionSolutionId')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateSolFunctionModal").modal("show");
								})
							</script>
						@enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateSolFunctionName" class="form-control" id="updateSolFunctionName" placeholder="Name" required>
                        @error('updateSolFunctionName')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#updateSolFunctionModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolFunctionTypeId" id="updateSolFunctionTypeId">
							<option value="1">Problem is solved by solution from solution function</option>
							<option value="2">Problem is substituted by solution from solution function</option>
							<option value="3">Problem is replaced by solution through solution function</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("delSolFunction") }}" id="delSolFunctionModal">
		<input type="hidden" name="id" id="delSolFunctionId">
		@csrf
	</form>
    @endif

    <script>
        $(document).ready(function(){
            $("#createSolFunctionBtn").click(function(){
                @if(count($problems) == 0)
                    swal({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'In order to identify a solution for a problem, the problem must exist.  In order to identify a solution for a problem, the problem must be identified.  Since the problem is not identified, then the solution for that problem cannot be identified.  Please, use the problem identification to identify the problem first before identifying the solution for that problem.',
                        buttons: true
                    }).then(function(value) {
                        if(value.value === true) {
                           window.location.href="/adultProblem";
                        }
                    });
                @else
                    @if (count($solutions) == 0)
                        swal({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'The problem you select has no solution yet. Please create solution first',
                            buttons: true
                        });
                    @endif
                    $("#createSolFunctionModal").modal("show");            
                @endif
            });

            $("#createSolFunctionProblemSelect").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createSolFunctionSolutionSelect").html(response);
                    }
                })
            });

            $("#updateSolFunctionProblemId").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#updateSolFunctionSolutionSelect").html(response);
                    }
                })
            });

            $(".createSolFunctionType").change(function(){
                var type = $(this).val();

                if(type == 0){
                    $("#createSolFunctionType").val("0");
                    $("#createSolFunctionFileType").css("display", "block");
                    $("#createSolFunctionLinkType").css("display", "none");
                }else if(type == 2){
                    $("#createSolFunctionType").val("2");
                    $("#createSolFunctionFileType").css("display", "none");
                    $("#createSolFunctionLinkType").css("display", "block");
                }
            });

            $(".updateSolFunctionType").change(function(){
                var type = $(this).val();

                if(type == 0){
                    $("#updateSolFunctionType").val("0");
                    $("#updateSolFunctionFileType").css("display", "block");
                    $("#updateSolFunctionLinkType").css("display", "none");
                }else if(type == 2){
                    $("#updateSolFunctionType").val("2");
                    $("#updateSolFunctionFileType").css("display", "none");
                    $("#updateSolFunctionLinkType").css("display", "block");
                }
            });

            $(".updateSolFunctionBtn").click(function(){
                var id = $(this).data("id");
                var problem_id = $(this).data("problem");
                var solution_id = $(this).data("solution");
                var file = $(this).data("file");
                var name = $(this).data("name");
                var type = $(this).data("type");
                var solFunctionType = $(this).data("solfunction");

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblemForUpdate",
                    data: {
                        problem_id: problem_id,
                        solution_id: solution_id,
                    },
                    success: function(response){
                        $("#updateSolFunctionSolutionSelect").html(response);
                        $("#updateSolFunctionId").val(id);
                        $("#updateSolFunctionProblemId").val(problem_id);
                        $("#updateSolFunctionName").val(name);
                        $("#updateSolFunctionTypeId").val(solFunctionType);

                        if(type == 2){
                            $("#updateSolFunctionType").val("2");
                            $("#updateSolFunctionFileType").css("display", "none");
                            $("#updateSolFunctionLinkType").css("display", "block");
                            
                            $("#updateSolFunctionFileRadio").attr("checked", false);
                            $("#updateSolFunctionLinkRadio").attr("checked", true);

                            $("#updateSolFunctionLinkFile").val(file);
                        }else{
                            $("#updateSolFunctionType").val("0");
                            $("#updateSolFunctionFileType").css("display", "block");
                            $("#updateSolFunctionLinkType").css("display", "none");

                            $("#updateSolFunctionFileRadio").attr("checked", true);
                            $("#updateSolFunctionLinkRadio").attr("checked", false);

                            if(file != ""){
                                var drEvent = $('#updateSolFunctionFileFile').dropify(
                                {
                                    defaultFile: "/assets/solFunction/" + file
                                });
                                drEvent = drEvent.data('dropify');
                                drEvent.resetPreview();
                                drEvent.clearElement();
                                drEvent.settings.defaultFile = "/assets/solFunction/" + file;
                                drEvent.destroy();
                                drEvent.init();	
                            }
                            
                        }

                        $("#updateSolFunctionModal").modal("show");
                    }
                });
            });

            $(".delSolFunctionBtn").click(function(){
                var id = $(this).data("id");

				swal({
					icon: 'warning',
					title: 'Warning',
					text: 'Do you want to delete?',
					buttons: true
				}).then(function(value) {
					if(value.value === true) {
						$("#delSolFunctionId").val(id);
						$("#delSolFunctionModal").submit();
					}
				});
            });

            $(".dropify").dropify();
        })
    </script>


@endsection
