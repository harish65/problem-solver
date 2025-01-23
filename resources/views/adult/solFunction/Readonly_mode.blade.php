@if(isset($solFunctions->id))
        @if($project->user_id == Auth::user()->id && $project->shared == 1)
                @include('adult.solFunction.solutiofunction_dd',[$solFunctions]) 
        @endif 
            @include('adult.solFunction.cards')
            @include('adult.solFunction.validations')
@else
@if(($project->user_id == Auth::user()->id && !is_null($can_edit)) || $project->shared == 0)
        <div class="row" style="margin-bottom: 10%;">
                <div class="col-md-6 align-middle">
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">+ Identify Solution Function</button>
                </div>
        </div>  
        @else 
            @include('adult.solFunction.solutiofunction_dd',[$solFunctions]) 
        
        
@endif
@endif
