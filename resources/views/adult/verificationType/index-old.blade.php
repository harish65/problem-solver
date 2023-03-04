@extends('layouts.admin')
@section('title', 'Verification Type Manage | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Verification Type Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Verification Type Manage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <button class="btn btn-success" id="createVerificationTypeBtn">Create</button>
            </div>
            <div class="col-md-6 col-sm-12">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
        </div>
        <div id="mainContainer" class="pd-20 mb-30"></div>
        <div class="loader" id="loader">Loading...</div>
    </div>
</div>

<form method="POST" action="{{ url("createAdminVerificationType") }}" class="modal fade" id="createAdminVerificationTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Verification type</h4>
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
                                $("#createAdminVerificationTypeModal").modal("show");
                            })
                        </script>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="key" class="form-control" placeholder="1st Field">
                    @error('key')
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
                <div class="form-group">
                    <input type="text" name="val" class="form-control" placeholder="2nd Field">
                    @error('val')
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
                <div class="form-group">
                    <input type="text" name="vals" class="form-control" placeholder="3rd Field">
                    @error('vals')
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

<form method="POST" action="{{ url("updateAdminVerificationType") }}" class="modal fade" id="updateAdminVerificationTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Verification type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="updateVerificationTypeId" id="updateVerificationTypeId">
                <div class="form-group">
                    <input type="text" name="updateVerificationTypeName" class="form-control" id="updateVerificationTypeName" placeholder="Name">
                    @error('updateVerificationTypeName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminVerificationTypeModal").modal("show");
                            })
                        </script>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="updateVerificationTypeKey" class="form-control" id="updateVerificationTypeKey" placeholder="1st Field">
                    @error('updateVerificationTypeKey')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminVerificationTypeModal").modal("show");
                            })
                        </script>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="updateVerificationTypeVal" class="form-control" id="updateVerificationTypeVal" placeholder="2nd Field">
                    @error('updateVerificationTypeVal')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminVerificationTypeModal").modal("show");
                            })
                        </script>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="updateVerificationTypeVals" class="form-control" id="updateVerificationTypeVals" placeholder="3rd Field">
                    @error('updateVerificationTypeVals')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <script>
                            $(document).ready(function(){
                                $("#updateAdminVerificationTypeModal").modal("show");
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

<form method="POST" action="{{ url("delAminVerificationType") }}" id="delAdminVerificationTypeModal">
    <input type="hidden" name="id" id="delAdminVerificationTypeId">
    @csrf
</form>
<script>
    $(document).ready(function(){
        $("#createVerificationTypeBtn").click(function(){
            $("#createAdminVerificationTypeModal").modal("show");
        })
        let timeoutID = null;

        getAdminVerificationType(1, $("#search").val());

        $('#search').keyup(function(e) {
            clearTimeout(timeoutID);
            const value = e.target.value
            timeoutID = setTimeout(() => getAdminVerificationType(1, $("#search").val()), 500)
        });
    });

    function getAdminVerificationType(page, search){
        $("#mainContainer").css("display", "none");
        $("#loader").css("display", "block");
        $.ajax({
            method: "get",
            url: "getAdminVerificationType",
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

