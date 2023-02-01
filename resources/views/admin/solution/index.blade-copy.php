@extends('layouts.admin')
@section('title', 'Solution Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Solution Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Solution Manage</li>
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

<form method="POST" action="{{ url("updateAdminSolution") }}" class="modal fade" id="updateSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
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
                                <label class="custom-control-label" for="updateSolutionLinkRadio"> Link</label>
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
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
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
                        @foreach ($solutionTypes as $item)
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>                                    
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="updateSolutionStateRadioTrue" name="updateSolutionState" class="custom-control-input updateSolutionState" value="1" checked>
                                <label class="custom-control-label" for="updateSolutionStateRadioTrue"> Correct Solution</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="updateSolutionStateRadioFalse" name="updateSolutionState" class="custom-control-input updateSolutionState" value="0">
                                <label class="custom-control-label" for="updateSolutionStateRadioFalse"> Not Correct</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="{{ url("delAdminSolution") }}" id="delAdminSolutionModal">
    <input type="hidden" name="id" id="delAdminSolutionId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        let timeoutID = null;

        getAdminSolution(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminSolution(1, $("#search").val()), 500)
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

    });

    function getAdminSolution(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminSolution",
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