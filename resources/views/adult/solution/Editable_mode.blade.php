
@if($solution != null)

@if(($project->user_id == Auth::user()->id) || (!is_null($can_edit) && $can_edit->shared_with  == Auth::user()->id && $can_edit->editable_solution == 0))
                @include('adult.solution.solutions_dd' , [$solutions , $solution])
@endif
    @include('adult.solution.cards')

    @include('adult.solution.validations')
@else
@if($can_edit != null && $can_edit->editable_solution == 1)
    <div class="row" style="margin-bottom: 10%;">
            <div class="col-md-6">
                <button class="btn btn-success" data-toggle="modal" data-target="#add-sol-modal" type="button" id="add-solution">Add Solution</button>
            </div>
    </div>       
@else   
        @include('adult.solution.solutions_dd' , [$solutions , $solution])
@endif  
<?php $showMessage =  true; ?>
@endif

