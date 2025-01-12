
@if(isset($solFunctions->id))
        @if(($project->user_id == Auth::user()->id) || (!is_null($can_edit) && $can_edit->shared_with  == Auth::user()->id))
            @if($project->user_id == Auth::user()->id || $can_edit->editable_solution_func == 0)
                @include('adult.solFunction.solutiofunction_dd',[$solFunctions]) 
            @endif 
            @include('adult.solFunction.cards')        
            @include('adult.solFunction.validations')  
        @endif

@else
        @if((!is_null($can_edit) && $can_edit->shared_with  == Auth::user()->id) && is_null($solFunctions))
            <div class="row" style="margin-bottom: 10%;">
                <div class="col-md-6 align-middle">
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">+ Identify Solution Function</button>
                </div>
            </div>  
        @else 
            @include('adult.solFunction.solutiofunction_dd',[$solFunctions]) 
        @endif
@endif
   