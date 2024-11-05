<div class="container">
        <div class="mainTitle">
            <div class="row">
                   
                    <div class="col-sm-12">
                        <div class="d-flex align-items-center">
                            <?php
                                $categories =  \App\Models\Relationship::relationshipCat();
                            ?>
                            <h2>Relationship</h2>
                            <select class="form-control form-select" id="rel_types">
                            <option value=''>Select Relationship...</option>
                                @foreach($categories as $cat)
                                    <optgroup label="{{ $cat->name }}">
                                            @foreach($relationships as $type)
                                                    @if($type->cat_id == $cat->id)
                                                        <option {{ (@$relationship->id == $type->id) ? 'selected' : '' }} value='{{ $type->id}}'>{{ $type->name }}</option>
                                                    @endif
                                            @endforeach
                                    </optgroup>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>