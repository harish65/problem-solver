<div class="modal fade" id="commonSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" enctype="multipart/form-data">
        <form method="POST" id="entityForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Me Vs You Approach</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">


                        <div class="form-group" id="solutio_functio_div">
                            <input type="text" class="form-control" name="" disabled
                                value="Solution Function : {{@$Solution_function->name}}">
                        </div>
                        <div class="form-group" id="solution_div">
                            <input type="text" class="form-control" name="" disabled
                                value="Solution : {{@$solution->name}}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="" disabled
                                value="Problem : {{@$problem->name}}">
                        </div>
                        <div class="form-group">
                            <label>People In Project</label>
                        </div>
                        @foreach($custommers as $entity)
                        <div class="form-group">
                           <input type="text" value="{{  $entity->name .':'. $entity->type }}" class="form-control" disabled>
                        </div>
                        @endforeach


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSave" class="btn btn-success">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>