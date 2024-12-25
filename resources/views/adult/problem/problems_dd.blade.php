
@if(isset($problems) && $problems->count() > 0 )
    @php
        $problem_id = (isset($problem) && $problem->id != '') ?  $problem->id : $problem_id;
    @endphp
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Problems</label>
            <select class="form-select form-select-lg mb-3" id="view_problem">
                            <option selected="true" disabled="disabled">Please Select...</option>
                        @foreach ($problems as $prob)                        
                            <option value="{{   Crypt::encrypt($prob->id) }}" {{ ($prob->id == $problem_id) ?  'selected':''}}>{{ $prob->name }}</option>
                        @endforeach
            </select>
        </div>
    </div>
@else
<div class="row" style="margin-bottom: 10%;">
<div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Problems</label>
            <select class="form-select form-select-lg mb-3" id="view_problem">
                            <option selected="true" disabled="disabled">Please Select...</option>
            </select>
        </div>
</div>

@endif