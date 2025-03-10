<div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit
        </p>
    </div>
    <div class="row">
        <div class="row-title">
            <h5>Problem and Solution Function Identification</h5>
        </div>
        <div class="row-table">
            <table class="table slp-tbl text-center">
                <thead>
                    <th>Problem</th>
                    <th>Solution</th>
                    <th>Solution Function</th>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: red;">{{ $solFunctions->problem_name}}</td>
                        <td style="color: #00A14C;">{{ $solFunctions->solution_name}}</td>
                        <td style="color: #00A14C;">{{ $solFunctions->name}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

<div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Does the solution function enable the replacement of the problem?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio"  value="1" data-id="{{ $solFunctions->id }}" class="form-check-input validation" {{ ($solFunctions->validation_first == '1') ? 'checked' : '' }}
                        name="optradio_firts"    {{ (($can_edit != null && $can_edit->editable_solution_func) || ($project->user_id == Auth::user()->id && $project->shared == 0)) ? '':'disabled' }} >Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="2" data-id="{{ $solFunctions->id }}" {{ ($solFunctions->validation_first == '2') ? 'checked' : '' }}
                        name="optradio_firts" {{ (($can_edit != null && $can_edit->editable_solution_func) || ($project->user_id == Auth::user()->id && $project->shared == 0)) ? '':'disabled' }}>Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="3" data-id="{{ $solFunctions->id }}" {{ ($solFunctions->validation_first == '3') ? 'checked' : '' }}
                        name="optradio_firts" {{ (($can_edit != null && $can_edit->editable_solution_func) || ($project->user_id == Auth::user()->id && $project->shared == 0)) ? '':'disabled' }}>Yes, the solution function enables the substitution of the problem
                </label>
            </div>
            

        </div>
    </div>
    <div class="row">
        <p>Does the solution function enable the solving of the ProblemName?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" value="1" {{ ($solFunctions->validation_second == '1') ? 'checked' : '' }} data-id="{{ $solFunctions->id }}" class="form-check-input validation"
                        name="optradio_second" {{ (($can_edit != null && $can_edit->editable_solution_func) || ($project->user_id == Auth::user()->id && $project->shared == 0)) ? '':'disabled' }}>Yes, the solution function enables the solving of the ProblemName
                </label>
            </div>
        </div>
        @if(($can_edit != null && $can_edit->editable_solution_func) || ($project->user_id == Auth::user()->id && $project->shared == 0))
        <div class=" col-sm-3 mb-3">
            <button type="button" class="btn btn-success" id="saveValidations" onclick='saveValidations()'>Save Validations</button>
        </div>
        
        @endif
       
    </div>