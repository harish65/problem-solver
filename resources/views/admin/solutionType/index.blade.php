@extends('layouts.admin')
@section('title', 'Solution Type Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Solution Type Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Solution Type Manage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <button class="btn btn-success" id="createSolutionTypeBtn">Create</button>
            </div>
            <div class="col-md-6 col-sm-12">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
        </div>
        <div id="mainContainer" class="pd-20 mb-30"></div>
        <div class="loader" id="loader">Loading...</div>
    </div>
</div>

<form method="POST" action="{{ url("createAdminSolutionType") }}" class="modal fade" id="createAdminSolutionTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create solution type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#createAdminSolutionTypeModal").modal("show");
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

<form method="POST" action="{{ url("updateAdminSolutionType") }}" class="modal fade" id="updateAdminSolutionTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update solution type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="updateSolutionTypeId" id="updateSolutionTypeId">
                    <input type="text" name="updateSolutionTypeName" class="form-control" id="updateSolutionTypeName" placeholder="Name">
                    @error('updateSolutionTypeName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminSolutionTypeModal").modal("show");
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

<form method="POST" action="{{ url("delAminSolutionType") }}" id="delAdminSolutionTypeModal">
    <input type="hidden" name="id" id="delAdminSolutionTypeId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        $("#createSolutionTypeBtn").click(function(){
            $("#createAdminSolutionTypeModal").modal("show");
        })
        let timeoutID = null;

        getAdminSolutionType(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminSolutionType(1, $("#search").val()), 500)
        });
    });

    function getAdminSolutionType(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminSolutionType",
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

