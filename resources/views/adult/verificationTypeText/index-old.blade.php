@extends('layouts.admin')
@section('title', 'Verification Type Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Verification Type Text Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Verification Type Text Manage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <button class="btn btn-success" id="createVerificationTypeTextBtn">Create</button>
            </div>
            <div class="col-md-6 col-sm-12">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
        </div>
        <div id="mainContainer" class="pd-20 mb-30"></div>
        <div class="loader" id="loader">Loading...</div>
    </div>
</div>

<form method="POST" action="{{ url("createAdminVerificationTypeText") }}" class="modal fade" id="createAdminVerificationTypeTextModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Verification type text</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                   <select class="custom-select" name="verification_type_id">
                        @foreach ($verificationTypes as $item)
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Text">
                    @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#createAdminVerificationTypeModal").modal("show");
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

<form method="POST" action="{{ url("updateAdminVerificationTypeText") }}" class="modal fade" id="updateAdminVerificationTypeTextModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Verification type text</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="updateVerificationTypeTextId" id="updateVerificationTypeTextId">                
                <div class="form-group">
                    <select class="custom-select" name="updateVerificationTypeTextVerificationTypeId">
                        @foreach ($verificationTypes as $item)
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                        @endforeach
                   </select>
                </div>                
                <div class="form-group">
                    <input type="text" name="updateVerificationTypeTextName" class="form-control" id="updateVerificationTypeTextName" placeholder="Text">
                    @error('updateVerificationTypeName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminVerificationTypeTextModal").modal("show");
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

<form method="POST" action="{{ url("delAminVerificationTypeText") }}" id="delAdminVerificationTypeTextModal">
    <input type="hidden" name="id" id="delAdminVerificationTypeTextId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        $("#createVerificationTypeTextBtn").click(function(){
            $("#createAdminVerificationTypeTextModal").modal("show");
        })
        let timeoutID = null;

        getAdminVerificationTypeText(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminVerificationTypeText(1, $("#search").val()), 500)
        });
    });

    function getAdminVerificationTypeText(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminVerificationTypeText",
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

