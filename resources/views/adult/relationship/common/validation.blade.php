<div class="questionWrap">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
            Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>
@php

    $editable = false;
    $config = config('relationship.'.$relationship->id);
    if((!is_null($can_edit) && $can_edit->$slug == 1 ) || (Auth::user()->id == $project->user_id && $project->shared == 0)){
        $editable = true;
    }
    
@endphp

<!-- Validation form Start-->
<div class="row">
    <form method='post' name='rel_val_form' id="rel_val_form">
        @php
        $ans = json_decode(@$validations->ans); 
        
        @endphp
        <input type="hidden" name="project_id" value="{{ $problem_id }}">
        <input type="hidden" name="problem_id" value="{{ $project_id }}">
        <input type="hidden" name="id" value="{{ @$validations->id }}">
        <input type="hidden" name="relationship_id" value="{{ $relationship->id }}">
        <div class="question">
            <h5>{{ $config['que_1'] }}</h5>
        </div>

        <div class="ans">
            <label><input type='radio' name="ans" value='1' {{ (@$ans == 1) ? 'checked':''  }} {{ (!$editable) ? 'disabled' : '' }} class="radio">  {{ $config['ans_1_1'] }}</label>
        </div>
        <div class="ans">
            <label><input type='radio' name="ans"  value='0' {{ (@$ans == 0) ? 'checked':''  }}  {{ (!$editable) ? 'disabled' : '' }} class="radio">  {{ $config['ans_1_2'] }}</label>
        </div>
        @if($editable)
        <div class="ans">
            <button type="button" class="btn btn-success" id="btn_save_validations">Save Validations</button>
        </div>
        @endif
    </form>
</div>
<!-- Validation form End-->


              