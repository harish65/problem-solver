<?php
$allSolFunc = \App\Models\SolutionFunction::getAllSolutionfunction($project_id);
?>

@if(isset($allSolFunc) && $allSolFunc->count() > 0 )
    <div class="row" style="margin-bottom: 5%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Solutions Function</label>
            <select class="form-select form-select-lg mb-3" id="viewsolutionfunction">
                            <option selected="true" disabled="disabled">Please Select...</option>
                            @foreach ($allSolFunc as $sol)                        
                            <option value="{{   Crypt::encrypt($sol->id) }}"  {{ (!is_null($solFunctions) && $solFunctions->id == $sol->id) ? 'selected':'' }} >{{ $sol->name }}</option>
                            @endforeach
                    
            </select>
        </div>
    </div>

@else
<div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Solutions Function</label>
            <select class="form-select form-select-lg mb-3" id="viewsolutionfunction">
                            <option selected="true" disabled="disabled">Please Select...</option>
            </select>
        </div>
    </div>
@endif