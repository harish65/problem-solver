<!-- Modal Start -->
<div class="modal fade" id="addVocabulary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">

    <form method="POST" id="addVocabularyForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Voucablary Entity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="project_id" id="project_id" value="{{@$project_id}}">
                    <input type="hidden" name="problem_id" id="problem_id" value="{{@$problem_id}}">
                    <input type="hidden" name="ver_id" id="ver_id" value="{{ @$verification->id }}">
                    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group">
                                <label>Word</label>
                                <input type="text" name="key" id="key" class="form-control" placeholder="Word">
                            </div>
                            <div class="form-group">
                                <label>Entity</label>
                                <input type="text" name="value"  id="value" name="value" class="form-control" placeholder="Entity">
                            </div>
                            <div class="form-group">
                                <label>Point To</label>
                                    <select name="point_to" id="point_to"  class="form-control form-select">
                                        <option value="to">Point To</option>
                                        <option value="not">Not Point To</option>
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