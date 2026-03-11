@extends('adult.layouts.adult')
@section('title', 'Adult | Relationship')
@section('content')

<div class='relationshipPage'>

    <?php
    $parameters = ['problem_id' => $problem_id, 'project_id' => $project_id];
    $parameter =  Crypt::encrypt($parameters);
    ?>
    <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
    <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
    <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
    <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>
    <a id="rel" href="{{ route('adult.rel',@$parameter) }}"></a>
    @include('adult.relationship.common.rel-component')
    <!-- Content Section Start -->

    @if(!$showMessage)
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                @if($relationship_applied)
                <!-- principleRelation start -->
                    @if($communications->count() > 0 && !is_null($Solution_function))
                    <div class="principleRelation">

                        <div class="d-flex">
                            @include('adult.relationship.common.communication')
                            @include('adult.relationship.common.upside')
                        </div>
                        <div class="d-flex">
                            @include('adult.relationship.common.solution_func')
                            @include('adult.relationship.common.downside')
                        </div>


                    </div>
                    @include('adult.relationship.common.validation')
                    @endif
                @else

                    @include('adult.relationship.common.apply_relationship_button')
                @endif
                <!-- principleRelation End -->
            </div>
        </div>
    </div>
    @else

    @include('adult.relationship.common.display_message_button')


    @endif

    @if($communications->count() > 0 && !is_null($Solution_function))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Apply Relationship</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Communitcation :
                                    </label>
                                    @foreach($communications as $communication)
                                    <label class="form-label fw-bold"></label>
                                    <input class="form-control" type="text" id="communication" value="{{ 'Communication : ' . $communication->title }}" value="{{ strip_tags($communication->comment) }}" readonly>

                                    @endforeach

                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Solution Function :</label>
                                    <input class="form-control" type="text" id="communication" value="{{ 'Solution Function : ' . $Solution_function->name }}" value="{{ strip_tags($communication->comment) }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Solution Function Created At:</label>
                                    <input class="form-control" type="text" id="communication" value="{{ 'Created : ' . date('d/m/Y', strtotime($Solution_function->created_at)) }}" value="{{ strip_tags($communication->comment) }}" readonly>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="modal-footer bg-success text-white">
                        <button class="btn btn-secondary border-2" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" id="applyRel">Yes, Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection
    @section('scripts')
    <script>
        $('#rel_types').on('change', function() {
            var id = $(this).val();
            window.location.href = "{{ route('adult.rel',$parameter) }}" + '/' + id;
        })
        var showMessage = "{{$showMessage}}"
        var text_ = '{{ $relationship->error_msg}}'
        if (showMessage) {

            swal({
                title: 'Communication and Solution Function Relationship Explanation',
                text: text_,
                type: "Error",
                showCancelButton: true,
                confirmButtonColor: '#00A14C',
            });
        } <
        /scrip> 
        @endsection