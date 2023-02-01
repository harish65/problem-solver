@extends('layouts.adult')
@section('title', 'Solution | Adult')

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
                    <p class="font-18 max-width-600">This is Solution panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow">
            <div class="row clearfix progress-box">
                @foreach ($solutions as $item)
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30 pr-0">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<span class="d-block text-success problem-title-bottom-border mb-2">
									Problem 
								</span>	
								@if($item -> problem -> file == null)
									<div class="fileField"></div>
								@else
									@if($item -> problem -> type == 0)
										@if(strlen($item -> file) < 15)
											<img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
										@endif
									@elseif($item -> type == 1)
										<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
											<source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
										</video>
									@elseif($item -> type == 2)
										<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
									@endif
								@endif					
								<h5 class="text-light-green padding-top-10 h5">
									Problem: {{ $item -> problem -> name }}
								</h5>
							
								<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
								
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30 p-0 m-0 px-0">
						<div class="text-center" style="margin-top: 20vh">
							@if($item -> solution_type_id == 1)
								is solved by
							@elseif($item -> solution_type_id == 2)
								is substituted by
							@elseif($item -> solution_type_id == 3)
								cross out after equal
							@elseif($item -> solution_type_id == 4)
								cross out equal
							@elseif($item -> solution_type_id == 5)
								is replaced by
							@endif
							<img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -50px">
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30 pl-0">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<span class="d-block text-success problem-title-bottom-border mb-2">
									Solution 
								</span>	
								@if($item -> file == null)
									<div class="fileField"></div>
								@else
									@if($item -> type == 0)
										@if(strlen($item -> file) < 15)
											<img src="{{ asset("assets/solution/" . $item -> file) }}" class="w-100 fileField">
										@endif
									@elseif($item -> type == 1)
										<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
											<source src="{{ asset("assets/solution/" . $item -> file) }}#t=0.1" type="video/mp4">
										</video>
									@elseif($item -> type == 2)
										<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
									@endif
								@endif					
								<h5 class="text-light-green padding-top-10 h5">
									Solution: {{ $item -> name }}
								</h5>
							
								<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
								<div class="btn-group mb-15">
									<button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateSolutionBtn" 
									data-id="{{ $item -> id }}"
									data-type="{{ $item -> type }}"
									data-file="{{ $item -> file }}"
									data-problem="{{ $item -> problem_id }}"
									data-stype="{{ $item -> solution_type_id }}"
									data-name="{{ $item -> name }}"
									data-state="{{ $item -> state }}"
									><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
									<button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delSolutionBtn" data-id="{{ $item -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                @endforeach
				<div class="col-lg-4 col-md-6 col-sm-12 mb-30 pr-0">
					<div class="card-box pd-30 height-100-p" data-toggle="tooltip" title="Identify Solution">
						<div class="progress-box text-center" id="createSolutionBtn">
							<h1 class="text-light-green padding-top-10 h1" style="font-size: 10rem">
								<i class="icon-copy fa fa-plus" aria-hidden="true"></i>
							</h1>
							<span class="d-block">Identify Solution </span>
						</div>
					</div>
				</div>
			</div>

			<div class="clearfix progress-box mb-30">
                <div class="card-box table-responsive p-0" style="border-radius: 0">
                    <h5 class="d-block text-center bg-success p-2 text-white">
                       Problem and Solution Identification
                    </h5>	
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr style="text-align: center">
                            <th scope="col" style="font-weight: 900">Problem</th>
                            {{-- <th scope="col"></th> --}}
                            <th scope="col" style="font-weight: 900">Solution</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse ($solutions as $solution)
                          <tr style="text-align: center; align-content: center">
                            <td scope="row">
                                {{-- @if($solution -> problem -> file == null)
                                    <div class="fileFieldAdultTable"></div>
                                @else
                                    @if($solution -> problem -> type == 0)
                                        @if(strlen($solution -> problem -> file) < 15)
                                            <img src="{{ asset("assets/problem/" . $solution -> problem -> file) }}" class="w-20 fileFieldAdultTable">
                                        @endif
                                    @elseif($solution -> problem -> type == 1)
                                        <video width="400" controls="controls" preload="metadata" class="w-20 fileFieldAdultTable" preload="metadata">
                                            <source src="{{ asset("assets/problem/" . $solution -> problem -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solution -> problem -> type == 2)
                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solution -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-20 fileFieldAdultTable">
                                    @endif
                                @endif
                                <br> --}}
								{{ $solution -> problem -> name }}
                            </td>
							{{-- <td style="width: 20%">
								@if($solution -> solution_type_id == 1)
									is solved by
								@elseif($solution -> solution_type_id == 2)
									is substituted by
								@elseif($solution -> solution_type_id == 3)
									cross out after equal
								@elseif($solution -> solution_type_id == 4)
									cross out equal
								@elseif($solution -> solution_type_id == 5)
									is replaced by
								@endif<br>
								<img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">
							</td> --}}
                            <td scope="row">
                                {{-- @if($solution -> file == null)
                                    <div class="fileFieldAdultTable"></div>
                                @else
                                    @if($solution -> type == 0)
                                        @if(strlen($solution -> file) < 15)
                                            <img src="{{ asset("assets/solution/" . $solution -> file) }}" class="w-20 fileFieldAdultTable">
                                        @endif
                                    @elseif($solution -> type == 1)
                                        <video width="400" controls="controls" preload="metadata" class="w-20 fileFieldAdultTable" preload="metadata">
                                            <source src="{{ asset("assets/solution/" . $solution -> file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solution -> type == 2)
                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solution -> file)[1])[1] . "/0.jpg" }}" class="w-20 fileFieldAdultTable">
                                    @endif
                                @endif
                                <br> --}}
								{{ $solution -> name }}
                            </td>
                          </tr>
                          @empty
                              <tr style="text-align: center">
                                  <td colspan="2">There is no data to show</td>
                              </tr>
                          @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (count($problems) > 0)
    <form method="POST" action="{{ url("createSolution") }}" class="modal fade" id="createSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Identify Solution</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="type" value="0" id="createSolutionType">
                    <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createSolutionFileRadio" name="type" class="custom-control-input createSolutionType" value="0" checked>
									<label class="custom-control-label" for="createSolutionFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createSolutionLinkRadio" name="type" class="custom-control-input createSolutionType" value="2">
									<label class="custom-control-label" for="createSolutionLinkRadio"> Youtube</label>
								</div>
							</div>
						</div>
					</div>
                    <div class="form-group" id="createSolutionFileType">
						<input type="file" name="file" id="createSolutionPhoto" class="dropify" accept="image/*, video/*">
						@error('file')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createSolutionModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="createSolutionLinkType" style="display: none">
						<input type="url" name="link" class="form-control" placeholder="Link">
						@error('link')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createSolutionModal").modal("show");
								})
							</script>
						@enderror
					</div>
                    <div class="form-group">
                        <select class="custom-select" name="problem_id">
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#createSolutionModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="solution_type_id">
							<option value="1">Problem is solved by Solution</option>
							<option value="2">Problem is substituted by Solution</option>
							<option value="3">Problem (cross out after) equal solution</option>
							<option value="4">Cross out problem equal solution</option>
							<option value="5">Problem is replaced by Solution</option>
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

    <form method="POST" action="{{ url("updateSolution") }}" class="modal fade" id="updateSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upate Solution</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="updateSolutionId" id="updateSolutionId">
                    <input type="hidden" name="updateSolutionType" id="updateSolutionType">
                    <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolutionFileRadio" name="updateSolutionType" class="custom-control-input updateSolutionType" value="0">
									<label class="custom-control-label" for="updateSolutionFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolutionLinkRadio" name="updateSolutionType" class="custom-control-input updateSolutionType" value="2">
									<label class="custom-control-label" for="updateSolutionLinkRadio"> Youtube</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="updateSolutionFileType">
						<input type="file" name="updateSolutionFile" id="updateSolutionFileFile" class="dropify" accept="image/*, video/*">
						@error('updateSolutionFile')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updatePSolutionModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="updateSolutionLinkType" style="display: none">
						<input type="url" name="updateSolutionFileLink" id="updateSolutionLinkFile" class="form-control" placeholder="Link">
						@error('updateSolutionFileLink')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateSolutionModal").modal("show");
								})
							</script>
						@enderror
					</div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolutionProblemId" id="updateSolutionProblemId">
                            @foreach ($problems as $item)
                                <option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateSolutionName" class="form-control" id="updateSolutionName" placeholder="Name" required>
                        @error('updateSolutionName')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#createSolutionModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="updateSolutionTypeId" id="updateSolutionTypeId">
                            <option value="1">Problem is solved by Solution</option>
							<option value="2">Problem is substituted by Solution</option>
							<option value="3">Problem (cross out after) equal solution</option>
							<option value="4">Cross out problem equal solution</option>
							<option value="5">Problem is replaced by Solution</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolutionStateRadioTrue" 
                                    @if (count($setting) > 0)
                                        @if ($setting[0] -> single_solution == 1)
                                            disabled
                                        @endif        
                                    @endif
                                    name="updateSolutionState" class="custom-control-input updateSolutionState" value="1" checked>
									<label class="custom-control-label" for="updateSolutionStateRadioTrue"> Correct Solution</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateSolutionStateRadioFalse" 
                                    @if (count($setting) > 0)
                                        @if ($setting[0] -> single_solution == 1)
                                            disabled
                                        @endif        
                                    @endif
                                    name="updateSolutionState" class="custom-control-input updateSolutionState" value="0">
									<label class="custom-control-label" for="updateSolutionStateRadioFalse"> Not Correct</label>
								</div>
							</div>
						</div>
					</div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("delSolution") }}" id="delSolutionModal">
		<input type="hidden" name="id" id="delSolutionId">
		@csrf
	</form>
    @endif
    <script>
        $(document).ready(function(){
            $("#createSolutionBtn").click(function(){
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
                    $("#createSolutionModal").modal("show");                
                @endif
            });

            $(".createSolutionType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#createSolutionType").val("0");
					$("#createSolutionFileType").css("display", "block");
					$("#createSolutionLinkType").css("display", "none");
				}else if(type == 2){
					$("#createSolutionType").val("2");
					$("#createSolutionFileType").css("display", "none");
					$("#createSolutionLinkType").css("display", "block");
				}
			});

            $(".updateSolutionType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#updateSolutionType").val("0");
					$("#updateSolutionFileType").css("display", "block");
					$("#updateSolutionLinkType").css("display", "none");
				}else if(type == 2){
					$("#updateSolutionType").val("2");
					$("#updateSolutionFileType").css("display", "none");
					$("#updateSolutionLinkType").css("display", "block");
				}
			});

            $(".updateSolutionBtn").click(function(){
				$("#updateSolutionId").val($(this).data("id"));
                $("#updateSolutionProblemId").val($(this).data("problem"));
                $("#updateSolutionTypeId").val($(this).data("stype"));
                $("#updateSolutionName").val($(this).data("name"));

                if($(this).data("state") == 0){
					$("#updateSolutionStateRadioTrue").attr("checked", false);
					$("#updateSolutionStateRadioFalse").attr("checked", true);
				}else{
					$("#updateSolutionStateRadioTrue").attr("checked", true);
					$("#updateSolutionStateRadioFalse").attr("checked", false);
				}

				if($(this).data("type") == 2){
					$("#updateSolutionType").val("2");
					$("#updateSolutionFileType").css("display", "none");
					$("#updateSolutionLinkType").css("display", "block");
					
					$("#updateSolutionFileRadio").attr("checked", false);
					$("#updateSolutionLinkRadio").attr("checked", true);

					$("#updateSolutionLinkFile").val($(this).data("file"));
				}else{
					$("#updateSolutionType").val("0");
					$("#updateSolutionFileType").css("display", "block");
					$("#updateSolutionLinkType").css("display", "none");

					$("#updateSolutionFileRadio").attr("checked", true);
					$("#updateSolutionLinkRadio").attr("checked", false);

					if($(this).file != ""){
						var file = $(this).data("file");
						var drEvent = $('#updateSolutionFileFile').dropify(
						{
							defaultFile: "/assets/solution/" + file
						});
						drEvent = drEvent.data('dropify');
						drEvent.resetPreview();
						drEvent.clearElement();
						drEvent.settings.defaultFile = "/assets/solution/" + file;
						drEvent.destroy();
						drEvent.init();	
					}
					
				}

				$("#updateSolutionModal").modal("show");
			});

            $(".delSolutionBtn").click(function(){
                var id = $(this).data("id");

				swal({
					icon: 'warning',
					title: 'Warning',
					text: 'Do you want to delete?',
					buttons: true
				}).then(function(value) {
					if(value.value === true) {
						$("#delSolutionId").val(id);
						$("#delSolutionModal").submit();
					}
				});
            });

            $(".dropify").dropify();
        });
    </script>
@endsection