@extends('layouts.admin')
@section('title', 'Problem Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Problem Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Problem Manage</li>
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

<form method="POST" action="{{ url("updateAdminProblem") }}" class="modal fade" id="updateProblemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
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

<form method="POST" action="{{ url("delAdminProblem") }}" id="delAdminProblemModal">
    <input type="hidden" name="id" id="delAdminProblemId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        let timeoutID = null;

        getAdminProblem(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminProblem(1, $("#search").val()), 500)
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
    });

    function getAdminProblem(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminProblem",
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