@extends('layouts.admin')
@section('title', 'Solution Function Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Solution Function Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Solution Manage Manage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="row">
            <div class="offset-md-6 col-md-6 col-sm-12">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
        </div>
        <div id="mainContainer" class="pd-20 mb-30"></div>
        <div class="loader" id="loader">Loading...</div>
    </div>
</div>

<form method="POST" action="{{ url("updateAdminSolFunction") }}" class="modal fade" id="updateSolFunctionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
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
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</form>
<form method="POST" action="{{ url("delAdminSolFunction") }}" id="delSolFunctionModal">
    <input type="hidden" name="id" id="delSolFunctionId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        let timeoutID = null;

        getAdminSolFunction(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminSolFunction(1, $("#search").val()), 500)
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

        $(".dropify").dropify();
    });

    function getAdminSolFunction(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminSolFunction",
            data: {
                page: page,
                search: search
            },
            success: function(response){
                $("#mainContainer").html(response);
                $("#mainContainer").css("display", "block");
                $("#loader").css("display", "none");
            }
        })
    }
</script>
@endsection