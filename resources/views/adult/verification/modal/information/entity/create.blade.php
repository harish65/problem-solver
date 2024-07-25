<!-- Modal Start -->
<div class="modal fade" id="informationEntity" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">

    <form method="POST" id="informationEntityForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Information Entity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="ver_id" id="ver_id" value="{{ @$verification->id }}">
                    <input type="hidden" name="verificationType" id="verificationType"
                        value="{{ @$verificationType->id }}">
                    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group">
                                <label>Given Information</label>
                                <input type="text" name="key" id="key" class="form-control" placeholder="Given Information">
                            </div>
                            <div class="form-group">
                                <label>Identified Information</label>
                                <input type="text" name="value"  id="value" name="value" class="form-control" placeholder="Identified Information">
                            </div>
                            <div class="form-group">
                                <label>Please State If Identified Information Matches Given Information</label>
                                    <select name="point_to" id="point_to"  class="form-control form-select">
                                        <option value="to">Yes</option>
                                        <option value="not">No</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSaveEntity" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>