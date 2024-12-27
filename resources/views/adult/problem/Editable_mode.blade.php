
    @php
        $ProjectOwner = ($project->user_id == Auth::user()->id) ? true : false;    

    @endphp
    
    @if($problem != null && $problem->user_id == Auth::user()->id) 
        @include('adult.problem.cards' , [$problems])
    @elseif($ProjectOwner)
        @include('adult.problem.problems_dd' , [$problems])
        @include('adult.problem.cards' , [$problems])
    @elseif($can_edit != null && $can_edit->editable_project == 0)
        @include('adult.problem.problems_dd' , [$problems])
        @include('adult.problem.cards' , [$problems])
    @else
        @if(($can_edit != null && $can_edit->editable_problem == 1) || ($can_edit == null && $project->user_id == Auth::user()->id && $project->shared == 0))
            <div class="row" style="margin-bottom: 10%;">
                <div class="col-md-6">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-problem-modal" type="button" id="add-problem"><i class="fa fa-plus"></i>Add Problem</button>
                </div>
            </div>       
            @else   
            @include('adult.problem.problems_dd' , [$problems])
        @endif  
        <?php $showMessage =  true; ?>
    @endif

   