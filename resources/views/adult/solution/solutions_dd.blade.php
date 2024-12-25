
@if(isset($solutions) && $solutions->count() > 0 )
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Solutions</label>
            <select class="form-select form-select-lg mb-3" id="viewsolution">
                            <option selected="true" disabled="disabled">Please Select...</option>
                        @foreach ($solutions as $sol)                        
                            <option value="{{   Crypt::encrypt($sol->id) }}"  {{ (!is_null($solution) && $solution->id == $sol->id) ? 'selected':'' }} >{{ $sol->name }}</option>
                        @endforeach
                    
            </select>
        </div>
    </div>
    @else
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Solutions</label>
            <select class="form-select form-select-lg mb-3" id="viewsolution">
                            <option selected="true" disabled="disabled">Please Select...</option>
                       
                    
            </select>
        </div>
    </div>
@endif