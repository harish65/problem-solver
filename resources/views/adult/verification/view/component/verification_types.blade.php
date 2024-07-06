<div class="col-sm-12">
    <div class="d-flex align-items-center">

    <?php
            $categories =  \App\Models\VerificationType::verificationTypeCategories();

        ?>
        <h2>Verification</h2>
        <select class="form-control form-select" id="verification_types">
        <option value=''>Select Verification Type..</option>
            @foreach(@$categories as $cat)
            <optgroup label="{{ $cat->name }}">
                    @foreach(@$types as $type)
                            @if($type->category == $cat->id)
                                <option {{ (@$verificationType->id == $type->id) ? 'selected' : '' }} value='{{ $type->id
                                    }}'>{{ $type->name }}
                                </option>
                            @endif
                    @endforeach
            </optgroup>
            @endforeach
            
        </select>
    </div>
</div>