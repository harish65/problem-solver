<!-- Modal Start -->
<div class="modal fade" id="beforeAfterEntity" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">

    <form method="POST" id="beforeAfterEntityForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Before & After Problem & Solution</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    
                         <input type="hidden" name="id" value="{{ @$verification->id }}">        
                                <input type="hidden" name="verificationType" value="{{ @$verificationType->id }}">        
                                <input type="hidden" name="problem_id" value="{{ @$problem->id }}">        
                                <input type="hidden" name="solution_id" value="{{ @$solution->id }}">        
                                <input type="hidden" name="solution_function_id" value="{{ @$Solution_function->id }}">
                                <input type="hidden" name="project_id" value="{{ @$project_id }}">
                                <input type="hidden" name="beforeafter_id" value="{{ @$beforeAfter->id }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group">
                                <label>Before Problem Identification</label>
                                <input type="text"  class="form-control" disabled value="{{ $problem->name }}">
                                <input type="hidden" name="key" id="key"  value="{{ $problem->name }}">
                            </div>
                            <div class="form-group">
                                <label>After Solution Identification</label>
                                <input type="text"  name="value" disabled value="{{ $solution->name }}" class="form-control">
                                <input type="hidden" name="value"  id="value"  value="{{ $solution->name }}">
                            </div>
                            <div class="form-group">
                                <label>Please State If Problem Exist After The Solution</label>
                                    <select name="existing_after" id="point_to"  class="form-control form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
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