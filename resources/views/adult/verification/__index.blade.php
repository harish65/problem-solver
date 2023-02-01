@extends('layouts.adult')
@section('title', 'Verification | Adult')

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
                    <p class="font-18 max-width-600">This is Verification panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="row clearfix progress-box">

                @foreach ($verifications as $item)
                <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                    <div class="card card-box text-center">
                        <div class="tab">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-success active problem-title-bottom-border" data-toggle="tab" href="#problemTab{{ $item -> id }}" role="tab" aria-selected="false">Problem</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue text-success problem-title-bottom-border" data-toggle="tab" href="#solutionTab{{ $item -> id }}" role="tab" aria-selected="false">Solution</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue text-success problem-title-bottom-border " data-toggle="tab" href="#verificationTab{{ $item -> id }}" role="tab" aria-selected="true">Verification</a>
                                    </li>
                                </ul>    
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="problemTab{{ $item -> id }}" role="tabpanel">
                                        <div class="progress-box text-center">    				
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
                                                {{ $item -> problem -> name }}
                                            </h5>
                                            <span class="d-block"><i class="icon-copy dw dw-support-1"></i> {{ $item -> problem -> user -> name }} </span>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="solutionTab{{ $item -> id }}" role="tabpanel">
                                        <div class="progress-box text-center">    				
                                            @if($item -> solution -> file == null)
                                                <div class="fileField"></div>
                                            @else
                                                @if($item -> solution -> type == 0)
                                                    @if(strlen($item -> file) < 15)
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
                                            <span class="d-block"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution -> user -> name }} </span>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade able-responsive " id="verificationTab{{ $item -> id }}" role="tabpanel">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th scope="col">
                                                        <input type="text" class="form-control" id="verificationTypeKeyInput{{ $item -> id }}_{{ $item -> verification_type -> id }}" value="{{ $item -> verification_type -> key }}" style="display: none">
                                                        <div id="verificationTypeKeyDiv{{ $item -> id }}_{{ $item -> verification_type -> id }}">{{ $item -> verification_type -> key }}</div>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control" id="verificationTypeValInput{{ $item -> id }}_{{ $item -> verification_type -> id }}" value="{{ $item -> verification_type -> val }}" style="display: none">
                                                        <div id="verificationTypeValDiv{{ $item -> id }}_{{ $item -> verification_type -> id }}">{{ $item -> verification_type -> val }}</div>
                                                    </th>
                                                    <th scope="col">
                                                        <div class="btn-group">
                                                            <button data-verification="{{ $item -> verification_type -> id }}" data-key="{{ $item -> verification_type -> key }}"data-val="{{ $item -> verification_type -> val }}"  data-item="{{ $item -> id }}" data-type="{{ $item -> verification_type -> type }}" type="button" class="btn btn-sm btn-default createVerificationBtn">
                                                                <i class="icon-copy dw dw-add"></i>
                                                            </button->
                                                            <button data-verification="{{ $item -> verification_type -> id }}" data-item="{{ $item -> id }}" id="editVerificationTypeBtn{{ $item -> id }}_{{ $item -> verification_type -> id }}" type="button" class="btn btn-sm btn-default editVerificationTypeBtn">
                                                                <i class="icon-copy dw dw-edit"></i>
                                                            </button>
                                                            <button data-verification="{{ $item -> verification_type -> id }}" data-item="{{ $item -> id }}" type="button" id="checkVerificationTypeBtn{{ $item -> id }}_{{ $item -> verification_type -> id }}" class="btn btn-sm btn-default checkVerificationTypeBtn" style="display: none">
                                                                <i class="icon-copy dw dw-check"></i>
                                                            </button>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item -> verification as $verification)
                                                    <tr style="text-align: center">
                                                        <td>
                                                            <div>{{ $verification -> key }}</div>
                                                        </td>
                                                        <td>
                                                            <div>{{ $verification -> val }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button 
                                                                data-id="{{ $verification -> id }}" 
                                                                data-key="{{ $verification -> key }}" 
                                                                data-val="{{ $verification -> val }}" 
                                                                data-type="{{ $verification -> verification_type_id }}" 
                                                                data-keyname="{{ $item -> verification_type -> key }}" 
                                                                data-valname="{{ $item -> verification_type -> val }}"
                                                                type="button" class="btn btn-sm btn-default editVerificationBtn">
                                                                    <i class="icon-copy dw dw-edit"></i>
                                                                </button>
                                                                <button data-id="{{ $verification -> id }}" type="button" class="btn btn-sm btn-default delVerificationBtn">
                                                                    <i class="icon-copy dw dw-delete"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="h5 text center">
                                    <span class="text-success">{{ $item -> problem -> name }}</span>
                                    <span class="h6 textOnlyText{{ $item -> id }}">{{ explode("xxx", $item -> verification_type_text -> name)[1] }}</span>
                                    <span class="h6 arrowOnlyText{{ $item -> id }}" style="display: none">--------></span>
                                    <span class="h6 textArrowText{{ $item -> id }}" style="display: none">{{ explode("xxx", $item -> verification_type_text -> name)[1] }}<br>--------></span>
                                    <span class="text-danger">{{ $item -> solution -> name }}</span>
                                    <span class="h6 textOnlyText{{ $item -> id }}">{{ explode("xxx", $item -> verification_type_text -> name)[2] }}</span>
                                    <span class="h6 arrowOnlyText{{ $item -> id }}" style="display: none">--------></span>
                                    <span class="h6 textArrowText{{ $item -> id }}" style="display: none">{{ explode("xxx", $item -> verification_type_text -> name)[2] }}<br>--------></span>
                                    <span class="text-info">{{ $item -> verification_type -> name }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="textOnlyRadio{{ $item -> id }}" name="showModeRadio{{ $item -> id }}" data-id="{{ $item -> id }}" class="custom-control-input showModeRadio" value="1" checked>
                                            <label class="custom-control-label" for="textOnlyRadio{{ $item -> id }}"><i class="icon-copy fa fa-amazon" aria-hidden="true"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="arrowOnlyRadio{{ $item -> id }}" name="showModeRadio{{ $item -> id }}" data-id="{{ $item -> id }}" class="custom-control-input showModeRadio" value="2">
                                            <label class="custom-control-label" for="arrowOnlyRadio{{ $item -> id }}"><i class="icon-copy dw dw-right-arrow"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="textArrowRadio{{ $item -> id }}" name="showModeRadio{{ $item -> id }}" data-id="{{ $item -> id }}" class="custom-control-input showModeRadio" value="3">
                                            <label class="custom-control-label" for="textArrowRadio{{ $item -> id }}"><i class="icon-copy dw dw-note"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 height-100-p" data-toggle="tooltip" title="Identify Verification">
                        <div class="progress-box text-center" id="createVerificationBtn">
                            <h1 class="text-light-green padding-top-10 h1" style="font-size: 10rem">
                                <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                            </h1>
                            <span class="d-block">Identify Verification </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ url("createVerification") }}" class="modal fade" id="createVerificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Identify Verification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <select class="custom-select" name="problem_id" id="createVerificationProblemSelect">
                            @foreach ($solFunctions as $item)
                                <option value="{{ $item -> problem -> id }}">Problem: {{ $item -> problem -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="solution_id" id="createVerificationSolutionSelect">
                            @foreach ($solFunctions[0] -> problem -> solution as $item)
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
                        <select class="custom-select" name="solution_function_id" id="createVerificationSolfunctionSelect">
                            @foreach ($solFunctions[0] -> solution -> solFunction as $item)
                                <option value="{{ $item -> id }}">Solution Function: {{ $item -> name }}</option>                                    
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
                        <select class="custom-select" name="verification_type_id" id="createVerificationSelect">
                            @forelse ($verificationTypes as $item)
                                <option value="{{ $item -> id }}" data-key="{{ $item -> key }}" data-val="{{ $item -> val }}">{{ $item -> name }}</option>
                            @empty    
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="verification_type_text_id" id="createVerificationTypeTextSelect">
                            @forelse ($verificationTypes[0] -> verification_type_text as $item)
                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>                    
                            @empty    
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="key" id="createVerificationKey" class="form-control" 
                        @if (count($verificationTypes) > 0)
                        placeholder="{{ $verificationTypes[0] -> key }}"
                        @endif
                        required>
                        @error('key')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#createVerificationModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="val" id="createVerificationVal" class="form-control" 
                        @if (count($verificationTypes) > 0)
                        placeholder="{{ $verificationTypes[0] -> val }}"
                        @endif
                        required>
                        @error('val')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#createVerificationModal").modal("show");
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

    <form method="POST" action="{{ url("updateVerification") }}" class="modal fade" id="updateVerificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Verification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="updateVerificationId" name="updateVerificationId">
                    <div class="form-group">
                        <select class="custom-select" name="updateVerificationTypeTextId" id="updateVerificationTypeTextId">
                            @forelse ($verificationTypes[0] -> verification_type_text as $item)
                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>                    
                            @empty    
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateVerificationKey" id="updateVerificationKey" class="form-control"  required>
                        @error('key')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#updateVerificationModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateVerificationVal" id="updateVerificationVal" class="form-control" required>
                        @error('val')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#updateVerificationModal").modal("show");
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

    <form method="POST" action="{{ url("updateVerificationType") }}" id="updateVerificationTypeModal">
        @csrf
        <input type="hidden" name="updateVerificationTypeId" id="updateVerificationTypeId">
        <input type="hidden" name="updateVerificationTypeKey" id="updateVerificationTypeKey">
        <input type="hidden" name="updateVerificationTypeVal" id="updateVerificationTypeVal">
    </form>

    <form method="POST" action="{{ url("delVerification") }}" id="delVerificationModal">
        @csrf
        <input type="hidden" name="id" id="delVerificationId">
    </form>
    <script>
        $(document).ready(function(){
            $("#createVerificationBtn").click(function(){
                @if(count($verificationTypes) > 0)
                    $("#createVerificationModal").modal("show");                
                @else
                    swal({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'There is no verification type. Please wait till admin create verification type first',
                        buttons: true
                    });
                @endif
            });

            $(".createVerificationBtn").click(function(){
                var id = $(this).data("item");

                $.ajax({
                    method: "get",
                    url: "getProblemPerSolFunction",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationProblemSelect").html(response);
                    }
                });

                $.ajax({
                    method: "get",
                    url: "getSolutionPerSolFunction",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolutionSelect").html(response);
                    }
                });

                $("#createVerificationKey").attr("placeholder", $(this).data("key"));
                $("#createVerificationVal").attr("placeholder", $(this).data("val"));

                $("#createVerificationModal").modal("show");
            });

            $("#createVerificationProblemSelect").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolutionSelect").html(response);
                    }
                });

                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolfunctionSelect").html(response);
                    }
                });
            });

            $("#createVerificationSolutionSelect").change(function(){
                var id = $(this).val();
 
                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerSolution",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolfunctionSelect").html(response);
                    }
                });
            });

            $("#createVerificationSelect").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getVerificationTypeTextPerType",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationTypeTextSelect").html(response);
                    }
                });
                
                $("#createVerificationKey").attr("placeholder", $(this).find('option[value="' + $(this).val() + '"]').data("key"));
                $("#createVerificationVal").attr("placeholder", $(this).find('option[value="' + $(this).val() + '"]').data("val"));
            });

            $(".editVerificationTypeBtn").click(function(){
                $("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).val($("#verificationTypeKeyDiv" + $(this).data("item") + "_" + $(this).data("verification")).html());
                $("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).val($("#verificationTypeValDiv" + $(this).data("item") + "_" + $(this).data("verification")).html());
           
                $("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");
                $("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");

                $("#verificationTypeKeyDiv" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");
                $("#verificationTypeValDiv" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");

                $("#editVerificationTypeBtn" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");
                $("#checkVerificationTypeBtn" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");
            });

            $(".checkVerificationTypeBtn").click(function(){
                var key = 0, val = 0;

                if($("#verificationTypeValInput" +  $(this).data("item") + "_" + $(this).data("verification")).val() == ""){
                    swal({
                    title: 'Warning',
                        text: 'Please insert Value.',
                        icon: 'warning',
                    });
                }else{
                    val = 1;
                }

                if($("#verificationTypeKeyInput" +  $(this).data("item") + "_" + $(this).data("verification")).val() == ""){
                    swal({
                    title: 'Warning',
                        text: 'Please insert Key.',
                        icon: 'warning',
                    });
                }else{
                    key = 1;
                }

                if(key == 1 && val == 1){
                    $("#updateVerificationTypeId").val($(this).data("verification"));
                    $("#updateVerificationTypeKey").val($("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).val());
                    $("#updateVerificationTypeVal").val($("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).val());
                    
                    $("#updateVerificationTypeModal").submit();   
                }
            });

            $(".editVerificationBtn").click(function(){
                var id = $(this).data("type");
                $("#updateVerificationKey").attr("placeholder", $(this).data("keyname"));
                $("#updateVerificationVal").attr("placeholder", $(this).data("valname"));

                $("#updateVerificationId").val($(this).data("id"));
                $("#updateVerificationKey").val($(this).data("key"));
                $("#updateVerificationVal").val($(this).data("val"));

                $.ajax({
                    method: "get",
                    url: "updateVerificationTypeTextId",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#updateVerificationTypeTextId").html(response);
                    }
                });

                $("#updateVerificationModal").modal("show");
            });

            $(".delVerificationBtn").click(function(){
                swal({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Do you want to delete?',
                    buttons: true
                }).then(function(value) {
                    if(value.value === true) {
                        $("#delVerificationId").val(id);
                        $("#delVerificationModal").submit();
                    }
                });
            });

            $(".showModeRadio").change(function(){
                if($(this).val() == 1){
                    $(".textOnlyText" + $(this).data("id")).css("display", "inline-block");
                    $(".arrowOnlyText" + $(this).data("id")).css("display", "none");
                    $(".textArrowText" + $(this).data("id")).css("display", "none");
                }else if($(this).val() == 2){
                    $(".textOnlyText" + $(this).data("id")).css("display", "none");
                    $(".arrowOnlyText" + $(this).data("id")).css("display", "inline-block");
                    $(".textArrowText" + $(this).data("id")).css("display", "none");
                }else if($(this).val() == 3){
                    $(".textOnlyText" + $(this).data("id")).css("display", "none");
                    $(".arrowOnlyText" + $(this).data("id")).css("display", "none");
                    $(".textArrowText" + $(this).data("id")).css("display", "inline-block");
                }
            });
        });
    </script>
@endsection
