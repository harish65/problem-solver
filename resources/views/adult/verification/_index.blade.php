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
            @foreach ($solutions as $item)
            <div class="row clearfix progress-box text-center card-box pd-20" style="margin-top: 10px">
                <h4 class="d-block text-success problem-title-bottom-border mb-2 col-12">
                    Verification
                </h4>	
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Problem and Solution 
							</span>	
                            @if($item -> file == null)
								<div class="fileField"></div>
							@else
								@if($item -> type == 0)
									@if(strlen($item -> problem -> file) < 15)
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
                            {{-- @if($item -> state == 1) --}}
							<span class="d-block text-danger">
                                <i class="icon-copy ti-target"></i>
                                 Solution: {{ $item -> name }} 
                            </span>
                            {{-- @else
                            <span class="d-block">
                                <i class="icon-copy ti-target"></i>
                                 {{ $item -> problem -> name }} 
                            </span>
                            @endif --}}
                          
							<span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
						</div>
					</div>
				</div>
                <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Vocabulary Verification 
							</span>	
                            <button class="btn btn-success w-100 createVocabularyVerificationBtn" data-id="{{ $item -> id }}">Identify Verification</button>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Key</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vocabularyTBodyContainer{{ $item -> id }}">
                                        @forelse ($item["vocaVer"] as $vocabulary)
                                            <tr id="vocabularyVerificationTR{{ $vocabulary -> id }}">
                                                <td>
                                                    <div id="vocabularyKeyDiv{{ $vocabulary -> id }}" class="vocabularyKeyDiv">{{ $vocabulary -> key }}</div>
                                                    <input type="text" class="form-control vocabularyKeyInput" id="vocabularyKeyInput{{ $vocabulary -> id }}" value="{{ $vocabulary -> key }}" name="vocabularyKey[]" style="display: none">
                                                </td>
                                                <td>
                                                    <div id="vocabularyValDiv{{ $vocabulary -> id }}" class="vocabularyValDiv">{{ $vocabulary -> val }}</div>
                                                    <input type="text" class="form-control vocabularyValInput" id="vocabularyValInput{{ $vocabulary -> id }}" value="{{ $vocabulary -> val }}" name="vocabularyVal[]" style="display: none">
                                                </td>
                                                <td>
                                                    <div class="btn-group pull-right">
                                                        <button id="checkVocabularyBtn{{ $vocabulary -> id }}" data-id="{{ $vocabulary -> id }}" type="button" class="btn btn-sm btn-default" style="display: none" onclick="checkVocabulary({{ $vocabulary -> id }}, {{ $item -> id }});">
                                                            <i class="icon-copy dw dw-check"></i>
                                                        </button>
                                                        <button id="cancelVocabularyBtn{{ $vocabulary -> id }}" data-id="{{ $vocabulary -> id }}" type="button" class="btn btn-sm btn-default" style="display: none" onclick="cancelVocabulary({{ $vocabulary -> id }});">
                                                            <i class="icon-copy dw dw-cancel"></i>
                                                        </button>
                                                        <button id="editVocabularyBtn{{ $vocabulary -> id }}" data-id="{{ $vocabulary -> id }}"  type="button" class="btn btn-sm btn-default" onclick="editVocabulary({{ $vocabulary -> id }});">
                                                            <i class="icon-copy dw dw-edit-2"></i>
                                                        </button>
                                                        <button id="delVocabularyBtn{{ $vocabulary -> id }}" data-id="{{ $vocabulary -> id }}" type="button" class="btn btn-sm btn-default" onclick="delVocabulary({{ $vocabulary -> id }}, 1);">
                                                            <i class="icon-copy dw dw-delete-3"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty    
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
                </div>
                <div class="offset-lg-4 col-lg-8 offset-md-6 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<span class="d-block text-success problem-title-bottom-border mb-2">
								Information Verification 
							</span>	
                            <button class="btn btn-success w-100 createInfoVerificationBtn" data-id="{{ $item -> id }}">Identify Verification</button>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Key</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody id="infoTBodyContainer{{ $item -> id }}">
                                        @forelse ($item["infoVer"] as $info)
                                            <tr id="infoVerificationTR{{ $info -> id }}">
                                                <td>
                                                    <div id="infoKeyDiv{{ $info -> id }}" class="infoKeyDiv">{{ $info -> key }}</div>
                                                    <input type="text" class="form-control infoKeyInput" id="infoKeyInput{{ $info -> id }}" value="{{ $info -> key }}" name="infoKey[]" style="display: none">
                                                </td>
                                                <td>
                                                    <div id="infoValDiv{{ $info -> id }}" class="infoValDiv">{{ $info -> val }}</div>
                                                    <input type="text" class="form-control infoValInput" id="infoValInput{{ $info -> id }}" value="{{ $info -> val }}" name="infoVal[]" style="display: none">
                                                </td>
                                                <td>
                                                    <div class="btn-group pull-right">
                                                        <button id="checkInfoBtn{{ $info -> id }}" data-id="{{ $info -> id }}" type="button" class="btn btn-sm btn-default" style="display: none" onclick="checkInfo({{ $info -> id }}, {{ $item -> id }});">
                                                            <i class="icon-copy dw dw-check"></i>
                                                        </button>
                                                        <button id="cancelInfoBtn{{ $info -> id }}" data-id="{{ $info -> id }}" type="button" class="btn btn-sm btn-default" style="display: none" onclick="cancelInfo({{ $info -> id }});">
                                                            <i class="icon-copy dw dw-cancel"></i>
                                                        </button>
                                                        <button id="editInfoBtn{{ $info -> id }}" data-id="{{ $info -> id }}"  type="button" class="btn btn-sm btn-default" onclick="editInfo({{ $info -> id }});">
                                                            <i class="icon-copy dw dw-edit-2"></i>
                                                        </button>
                                                        <button id="delInfoBtn{{ $info -> id }}" data-id="{{ $info -> id }}" type="button" class="btn btn-sm btn-default" onclick="delInfo({{ $info -> id }}, 1);">
                                                            <i class="icon-copy dw dw-delete-3"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty    
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
                </div>
				
			</div>
            @endforeach

        </div>
    </div>

    <form method="post" action="{{ url("createVerification") }}" id="createVerificationModal">
        @csrf
        <input type="hidden" name="type" id="createVerificationType" value="0">
        <input type="hidden" name="solution_id" id="createVerificationSolutionId">
        <input type="hidden" name="key" id="createVerificationKey">
        <input type="hidden" name="val" id="createVerificationVal">
    </form>

    <form method="POST" action="{{ url("updateVerification") }}" id="updateVerificationModal">
        @csrf
        <input type="hidden" name="updateVerificationId" id="updateVerificationId" value="0">
        <input type="hidden" name="updateVerificationType" id="updateVerificationType" value="0">
        <input type="hidden" name="updateVerificationSolutionId" id="updateVerificationSolutionId">
        <input type="hidden" name="updateVerificationKey" id="updateVerificationKey">
        <input type="hidden" name="updateVerificationVal" id="updateVerificationVal">
    </form>
    
    <form method="POST" action="{{ url("delVerification") }}" id="delVerificationModal">
        @csrf
        <input type="hidden" name="id" id="delVerificationId">
    </form>
    <script>
        $(document).ready(function(){
            $(".createVocabularyVerificationBtn").click(function(){
                var id = $(this).data('id');
                const d = new Date();
                var ms = d.getTime();
                
                var content='<tr id="vocabularyVerificationTR' + ms + '">' +
                    '<td>' + 
                    '<div id="vocabularyKeyDiv' + ms + '" class="vocabularyKeyDiv" style="display: none"></div>' + 
                    '<input type="text" class="form-control input sm vocabularyKeyInput" id="vocabularyKeyInput' + ms + '"  name="vocabularyKey[]">' +
                    '</td>' +
                    '<td>' +
                    '<div id="vocabularyValDiv' + ms + '" class="vocabularyValDiv" style="display: none"></div>' +
                    '<input type="text" class="form-control input sm vocabularyValInput" id="vocabularyValInput' + ms + '" name="vocabularyVal[]">' +
                    '</td>' +
                    '<td>' +
                    '<div class="btn-group pull-right">' +
                    '<button id="checkVocabularyBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="createVocabulary(' + id + ', ' + ms + ');">' +
                    '<i class="icon-copy dw dw-check"></i>' +
                    '</button>' +
                    '<button id="cancelVocabularyBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="cancelVocabulary(' + ms + ');">' +
                    '<i class="icon-copy dw dw-cancel"></i>' +
                    '</button>' +
                    '<button id="editVocabularyBtn' + ms + '" data-id="' + ms + '"  type="button" class="btn btn-sm btn-default" style="display: none" onclick="editVocabulary(' + ms + ');">' +
                    '<i class="icon-copy dw dw-edit-2"></i>' +
                    '</button>' +
                    '<button id="delVocabularyBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" style="display: none" onclick="delVocabulary(' + ms + ', 0);">' +
                    '<i class="icon-copy dw dw-delete-3"></i>' +
                    '</button>' +
                    '</div></td></tr>';

                $("#vocabularyTBodyContainer" + id).prepend(content);
            });

            $(".createInfoVerificationBtn").click(function(){
                var id = $(this).data('id');
                const d = new Date();
                var ms = d.getTime();
                
                var content='<tr id="infoVerificationTR' + ms + '">' +
                    '<td>' + 
                    '<div id="infoKeyDiv' + ms + '" class="infoKeyDiv" style="display: none"></div>' + 
                    '<input type="text" class="form-control input sm infoKeyInput" id="infoKeyInput' + ms + '"  name="infoKey[]">' +
                    '</td>' +
                    '<td>' +
                    '<div id="infoValDiv' + ms + '" class="infoValDiv" style="display: none"></div>' +
                    '<input type="text" class="form-control input sm infoValInput" id="infoValInput' + ms + '" name="infoVal[]">' +
                    '</td>' +
                    '<td>' +
                    '<div class="btn-group pull-right">' +
                    '<button id="checkInfoBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="createInfo(' + id + ', ' + ms + ');">' +
                    '<i class="icon-copy dw dw-check"></i>' +
                    '</button>' +
                    '<button id="cancelInfoBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="cancelInfo(' + ms + ');">' +
                    '<i class="icon-copy dw dw-cancel"></i>' +
                    '</button>' +
                    '<button id="editInfoBtn' + ms + '" data-id="' + ms + '"  type="button" class="btn btn-sm btn-default" style="display: none" onclick="editInfo(' + ms + ');">' +
                    '<i class="icon-copy dw dw-edit-2"></i>' +
                    '</button>' +
                    '<button id="delInfoBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" style="display: none" onclick="delInfo(' + ms + ', 0);">' +
                    '<i class="icon-copy dw dw-delete-3"></i>' +
                    '</button>' +
                    '</div></td></tr>';

                $("#infoTBodyContainer" + id).prepend(content);
            })
        });

        function createVocabulary(id, ms){
            var key = 0, val = 0;

            if($("#vocabularyValInput" + ms).val() == ""){
                swal({
                title: 'Warning',
                    text: 'Please insert Value.',
                    icon: 'warning',
                });
            }else{
                val = 1;
            }

            if($("#vocabularyKeyInput" + ms).val() == ""){
                swal({
                title: 'Warning',
                    text: 'Please insert Key.',
                    icon: 'warning',
                });
            }else{
                key = 1;
            }

            if(key == 1 && val == 1){
                $("#createVerificationType").val("0");
                $("#createVerificationSolutionId").val(id);
                $("#createVerificationKey").val($("#vocabularyKeyInput" + ms).val());
                $("#createVerificationVal").val($("#vocabularyValInput" + ms).val());

                $("#createVerificationModal").submit();
            }
        }

        function editVocabulary(ms){
            $("#vocabularyKeyDiv" + ms).html($("#vocabularyKeyInput" + ms).val());
            $("#vocabularyValDiv" + ms).html($("#vocabularyValInput" + ms).val());

            $("#vocabularyKeyDiv" + ms).css("display", "none");
            $("#vocabularyValDiv" + ms).css("display", "none");

            $("#vocabularyKeyInput" + ms).css("display", "block");
            $("#vocabularyValInput" + ms).css("display", "block");

            $("#checkVocabularyBtn" + ms).css("display", "block");
            $("#cancelVocabularyBtn" + ms).css("display", "block");
            $("#editVocabularyBtn" + ms).css("display", "none");
            $("#delVocabularyBtn" + ms).css("display", "none");
        }

        function checkVocabulary(id, ms){
            $("#updateVerificationType").val("0");
            $("#updateVerificationId").val(id);
            $("#updateVerificationSolutionId").val(ms);
            $("#updateVerificationKey").val($("#vocabularyKeyInput" + id).val());
            $("#updateVerificationVal").val($("#vocabularyValInput" + id).val());

            $("#updateVerificationModal").submit();
        }

        function cancelVocabulary(ms, state){
            if(state == 0){
                $("#vocabularyVerificationTR" + ms).remove();
            }else{
                $("#vocabularyKeyInput" + ms).val($("#vocabularyKeyDiv" + ms).html());
                $("#vocabularyValInput" + ms).val($("#vocabularyValDiv" + ms).html());

                $("#vocabularyKeyInput" + ms).css("display", "none");
                $("#vocabularyValInput" + ms).css("display", "none");

                $("#vocabularyKeyDiv" + ms).css("display", "block");
                $("#vocabularyValDiv" + ms).css("display", "block");

                $("#checkVocabularyBtn" + ms).css("display", "none");
                $("#cancelVocabularyBtn" + ms).css("display", "none");
                $("#editVocabularyBtn" + ms).css("display", "block");
                $("#delVocabularyBtn" + ms).css("display", "block");
            }
        }

        function delVocabulary(id){
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
        }

        function createInfo(id, ms){
            var key = 0, val = 0;

            if($("#infoValInput" + ms).val() == ""){
                swal({
                title: 'Warning',
                    text: 'Please insert Value.',
                    icon: 'warning',
                });
            }else{
                val = 1;
            }

            if($("#infoKeyInput" + ms).val() == ""){
                swal({
                title: 'Warning',
                    text: 'Please insert Key.',
                    icon: 'warning',
                });
            }else{
                key = 1;
            }

            if(key == 1 && val == 1){
                $("#createVerificationType").val("1");
                $("#createVerificationSolutionId").val(id);
                $("#createVerificationKey").val($("#infoKeyInput" + ms).val());
                $("#createVerificationVal").val($("#infoValInput" + ms).val());

                $("#createVerificationModal").submit();
            }
        }

        function editInfo(ms){
            $("#infoKeyDiv" + ms).html($("#infoKeyInput" + ms).val());
            $("#infoValDiv" + ms).html($("#infoValInput" + ms).val());

            $("#infoKeyDiv" + ms).css("display", "none");
            $("#infoValDiv" + ms).css("display", "none");

            $("#infoKeyInput" + ms).css("display", "block");
            $("#infoValInput" + ms).css("display", "block");

            $("#checkInfoBtn" + ms).css("display", "block");
            $("#cancelInfoBtn" + ms).css("display", "block");
            $("#editInfoBtn" + ms).css("display", "none");
            $("#delInfoBtn" + ms).css("display", "none");
        }

        function checkInfo(id, ms){
            $("#updateVerificationType").val("1");
            $("#updateVerificationId").val(id);
            $("#updateVerificationSolutionId").val(ms);
            $("#updateVerificationKey").val($("#infoKeyInput" + id).val());
            $("#updateVerificationVal").val($("#infoValInput" + id).val());

            $("#updateVerificationModal").submit();
        }

        function cancelInfo(ms, state){
            if(state == 0){
                $("#infoVerificationTR" + ms).remove();
            }else{
                $("#infoKeyInput" + ms).val($("#infoKeyDiv" + ms).html());
                $("#infoValInput" + ms).val($("#infoValDiv" + ms).html());

                $("#infoKeyInput" + ms).css("display", "none");
                $("#infoValInput" + ms).css("display", "none");

                $("#infoKeyDiv" + ms).css("display", "block");
                $("#infoValDiv" + ms).css("display", "block");

                $("#checkInfoBtn" + ms).css("display", "none");
                $("#cancelInfoBtn" + ms).css("display", "none");
                $("#editInfoBtn" + ms).css("display", "block");
                $("#delInfoBtn" + ms).css("display", "block");
            }
        }

        function delInfo(id){
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
        }
    </script>
@endsection
