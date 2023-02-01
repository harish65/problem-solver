@extends('layouts.adult')
@section('title', 'Problem | Adult')

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
                    <p class="font-18 max-width-600">This is Problem panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="row clearfix progress-box">
				@foreach ($problems as $item)
				<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Problem 
							</span>						
							@if($item -> file == null)
								<div class="fileField"></div>
							@else
								@if($item -> type == 0)
									@if(strlen($item -> file) < 15)
										<img src="{{ asset("assets/problem/" . $item -> file) }}" class="w-100 fileField">
									@endif
								@elseif($item -> type == 1)
									<video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
										<source src="{{ asset("assets/problem/" . $item -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($item -> type == 2)
									<img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
								@endif
							@endif
							<h5 class="text-light-green padding-top-10 h5">
								{{ $item -> name }}
							</h5>
							<span class="d-block"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
							<div class="btn-group mb-15">
								<button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left editProblemBtn" 
								data-id="{{ $item -> id }}"
								data-type="{{ $item -> type }}"
								data-file="{{ $item -> file }}"
								data-name="{{ $item -> name }}"
								><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
								<button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delProblemBtn" data-id="{{ $item -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p" data-toggle="tooltip" title="Identify Problem">
						<div class="progress-box text-center" id="createProblemBtn">
							<h1 class="text-light-green padding-top-10 h1" style="font-size: 10rem">
								<i class="icon-copy fa fa-plus" aria-hidden="true"></i>
							</h1>
							<span class="d-block">Identify Problem </span>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
   
	<form method="POST" action="{{ url("createProblem") }}" class="modal fade" id="createProblemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
		@csrf
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Identify Problem</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="type" value="0" id="createProblemType">
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createProblemFileRadio" name="type" class="custom-control-input createProblemType" value="0" checked>
									<label class="custom-control-label" for="createProblemFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="createProblemLinkRadio" name="type" class="custom-control-input createProblemType" value="2">
									<label class="custom-control-label" for="createProblemLinkRadio"> Link</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="createProblemFileType">
						<input type="file" name="file" id="createProblemPhoto" class="dropify" accept="image/*, video/*">
						@error('file')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="createProblemLinkType" style="display: none">
						<input type="url" name="link" class="form-control" placeholder="Link">
						@error('link')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Name">
						@error('name')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#createProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</form>
   
	<form method="POST" action="{{ url("updateProblem") }}" class="modal fade" id="updateProblemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
		@csrf
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Problem</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="updateProblemId" id="updateProblemId">
					<input type="hidden" name="updateProblemType" id="updateProblemType">
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateProblemFileRadio" name="updateProblemType" class="custom-control-input updateProblemType" value="0" checked>
									<label class="custom-control-label" for="updateProblemFileRadio"> File</label>
								</div>
							</div>
							<div class="col-6">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="updateProblemLinkRadio" name="updateProblemType" class="custom-control-input updateProblemType" value="2">
									<label class="custom-control-label" for="updateProblemLinkRadio"> Link</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="updateProblemFileType">
						<input type="file" name="updateProblemFile" id="updateProblemFileFile" class="dropify" accept="image/*, video/*">
						@error('updateProblemFile')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group" id="updateProblemLinkType" style="display: none">
						<input type="url" name="updateProblemFileLink" id="updateProblemLinkFile" class="form-control" placeholder="Link">
						@error('updateProblemFileLink')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
					<div class="form-group">
						<input type="text" name="updateProblemName" id="updateProblemName" class="form-control" placeholder="Name">
						@error('updateProblemName')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							<script>
								$(document).ready(function(){
									$("#updateProblemModal").modal("show");
								})
							</script>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</form>

	<form method="POST" action="{{ url("delProblem") }}" id="delProblemModal">
		<input type="hidden" name="id" id="delProblemId">
		@csrf
	</form>
	<script>
		$(document).ready(function(){
			$("#createProblemBtn").click(function(){
				$("#createProblemModal").modal("show");
			});

			$(".createProblemType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#createProblemType").val("0");
					$("#createProblemFileType").css("display", "block");
					$("#createProblemLinkType").css("display", "none");
				}else if(type == 2){
					$("#createProblemType").val("2");
					$("#createProblemFileType").css("display", "none");
					$("#createProblemLinkType").css("display", "block");
				}
			});

			$(".updateProblemType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#updateProblemType").val("0");
					$("#updateProblemFileType").css("display", "block");
					$("#updateProblemLinkType").css("display", "none");
				}else if(type == 2){
					$("#updateProblemType").val("2");
					$("#updateProblemFileType").css("display", "none");
					$("#updateProblemLinkType").css("display", "block");
				}
			});

			$(".editProblemBtn").click(function(){
				$("#updateProblemId").val($(this).data("id"));
				$("#updateProblemName").val($(this).data("name"));

				if($(this).data("type") == 2){
					$("#updateProblemType").val("2");
					$("#updateProblemFileType").css("display", "none");
					$("#updateProblemLinkType").css("display", "block");
					
					$("#updateProblemFileRadio").attr("checked", false);
					$("#updateProblemLinkRadio").attr("checked", true);

					$("#updateProblemLinkFile").val($(this).data("file"));
				}else{
					$("#updateProblemType").val("0");
					$("#updateProblemFileType").css("display", "block");
					$("#updateProblemLinkType").css("display", "none");

					$("#updateProblemFileRadio").attr("checked", true);
					$("#updateProblemLinkRadio").attr("checked", false);

					if($(this).file != ""){
						var file = $(this).data("file");
						var drEvent = $('#updateProblemFileFile').dropify(
						{
							defaultFile: "/assets/problem/" + file
						});
						drEvent = drEvent.data('dropify');
						drEvent.resetPreview();
						drEvent.clearElement();
						drEvent.settings.defaultFile = "/assets/problem/" + file;
						drEvent.destroy();
						drEvent.init();	
					}
					
				}

				$("#updateProblemModal").modal("show");
			});

			$(".delProblemBtn").click(function(){
				var id = $(this).data("id");

				swal({
					icon: 'warning',
					title: 'Warning',
					text: 'Do you want to delete?',
					buttons: true
				}).then(function(value) {
					if(value.value === true) {
						$("#delProblemId").val(id);
						$("#delProblemModal").submit();
					}
				});
			});

            $(".dropify").dropify();
		})
	</script>
@endsection

