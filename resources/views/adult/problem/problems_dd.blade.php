
@if(isset($problems) && $problems->count() > 0 )
    @php
        $users = \App\Models\Problem::GetAllUsersInProblem($projectID);
        $problem_id = (isset($problem) && $problem->id != '') ?  $problem->id : $problem_id;
        
    @endphp
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Problems</label>
                <select class="form-select form-select-lg mb-3" id="view_problem">
                        <option selected="true" disabled="disabled">Please Select...</option>
                            @foreach ($users as $user)                        
                                <option value="{{   Crypt::encrypt($user->problem_id) }}" {{ ($user->problem_id == $problem_id) ?  'selected':''}}>{{ $user->user_name }}</option>
                            @endforeach
                </select>
        </div>
    </div>
@endif