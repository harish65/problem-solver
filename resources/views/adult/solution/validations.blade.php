        
        @php 
        $disabled =  '';
        @endphp
        
        @if(($can_edit != null && $can_edit->editable_solution) || ($project->user_id == Auth::user()->id && $project->shared == 0))
        @else
        @php  $disabled =  "disabled"; @endphp   
        @endif
       
    
        <div class="row pt-5">
                <h5>Validation Questions</h5>
                <p>Does the solution of the actual problem replace the actual problem?</p>
                <div class="form-group pl-5 pb-5">
                    <div class="form-check">
                        <label class="form-check-label">
                        
                        <input type="radio" {{ ($solution->validation_first == '0') ? 'checked' : '' }} {{ $disabled }} value="0" data-id="{{ $solution->id }}" class="form-check-input validation" name="optradio_firts">Yes, the solution of the actual problem replaces the actual problem
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input validation" {{ ($solution->validation_first == '1') ? 'checked' : '' }}  {{ $disabled }} value="1" data-id="{{ $solution->id }}" name="optradio_firts">No, the solution of the actual problem does not replace the actual problem
                        </label>
                    </div>
                    
                </div>
                <p>Does the (solution name pull from the database) solve the (problem name pull from the database)?</p>
                <div class="form-group pl-5 pb-5">
                    <div class="form-check">
                        <label class="form-check-label">
                        
                        <input type="radio" {{ ($solution->validation_second == '0') ? 'checked' : '' }} {{ $disabled }} value="0" data-id="{{ $solution->id }}" class="form-check-input validation" name="optradio">Yes, (solution name form database) solves (problem name from database)
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input validation" {{ ($solution->validation_second == '1') ? 'checked' : '' }} {{ $disabled }} value="1" data-id="{{ $solution->id }}" name="optradio">No, (solution name form database) does not solve (problem name from database)
                        </label>
                    </div>
                    
                </div>
                @if($disabled == '')
                <div class=" col-sm-3 mb-3">

                    <button type="button" class="btn btn-success" onclick='saveValidations()' >Save Validations</button>
                </div>
                @endif
    </div>

    