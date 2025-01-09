@if(isset($solFunctions->id))
           
            @include('adult.solFunction.cards')
            @include('adult.solFunction.validations')
@else
        
        <div class="row" style="margin-bottom: 10%;">
                <div class="col-md-6 align-middle">
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">+ Identify Solution Function</button>
                </div>
        </div>    
        
@endif