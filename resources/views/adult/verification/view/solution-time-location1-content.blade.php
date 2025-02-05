@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $showMsg = false; ?>
@php
$VerificationPermission = \App\Models\Verification::CheckVerificationPermission($project_id);
@endphp
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                        <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                        ?>
                   

                   @include('adult.verification.view.component.common_routes')
                   @include('adult.verification.view.component.verification_types')
            </div>
        </div>
    </div>

    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset('assets-new/verification_types/' . @$verificationType->banner)}}"
                        alt="relationImage" />

                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                @if($custommers->count() > 0)
                <!-- start -->
                @if($solutionTimeLocationOne)
                        <div class="principleRelation">
                            <!-- Start -->
                            <div class="conditionBlock-solution">
                                <div class="solutioone-card">
                                    <div class="location-card">
                                        <div class="location-head text-center">
                                            <h2>My Location</h2>
                                        </div>
                                        <div class="left-side float-left mt-4">
                                            <div class="imgWrp">
                                                <div id="myCarousel" class="carousel slide " data-ride="carousel">

                                                    <div class="carousel-inner" role="listbox">
                                                        @php $index = 1; @endphp
                                                        @foreach($custommers as $entity)
                                                        <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                                            <img src="{{ asset('assets-new/users/'.$entity->file)}}"
                                                                alt="Chania" width="80%" height="128px">
                                                            <div class="carousel-caption">
                                                                <ul style="display:block;list-style:none;">
                                                                        <li>{{ $entity->name }}</li>
                                                                        <li style="color:red">{{ $entity->type }}</li>
                                                                    </ul>
                                                            </div>
                                                        </div>
                                                        @php $index++; @endphp
                                                        @endforeach
                                                    </div>
                                                    <ol class="carousel-indicators">
                                                        @php $index = 0; @endphp
                                                        @foreach($custommers as $entity)
                                                        <li data-target="#myCarousel" data-slide-to="{{ $index  }}"
                                                            class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                        @php $index++; @endphp
                                                        @endforeach
                                                    </ol>


                                                </div>

                                            </div>

                                            <div class="projectList text-center">
                                                <p class="redText" style="color: red;"></p>
                                                <p class="date"></p>
                                                <ul>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-side float-right mt-4 text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto" src="{{ asset('assets-new/problem/'.$problem->file)}}"
                                                    width="100%" height="128px">
                                            </div>
                                            <p class="redText">{{ $problem->name }}</p>
                                            <div class="projectList text-center">
                                                <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                                <ul>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="long-arrow">
                                <p class="transitionPhrase">{{ @$transitionPhrase->name }}</p>
                                    <!-- add arrow Image over here -->
                                    <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                                    <!-- add arrow Image over here -->
                                </div>
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Destination</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solution->file)}}"
                                                    width="100%" height="128px">
                                            </div>
                                            <p class="redText">{{ $solution->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date">{{ date('d/m/Y' , strtotime($solution->created_at))}}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End  conditionBlock-solution-->
                            <div class="questionWrap">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                    tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                    nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                                @if($custommers->count() > 0)
                                <div class="row">
                                    <div class="title">
                                        <h2>Solution time location1 Identification</h2>
                                    </div>
                                    <div class="entity">
                                        <table class="table slp-tbl">
                                            <thead>
                                                <th>Problem</th>
                                                <th>Date</th>
                                                <th>Solution Function</th>
                                                <th>Date</th>
                                                <th>People</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: red;">{{ $problem->name }}</td>
                                                    <td style="color: red;">{{ date('d/m/Y', strtotime($problem->created_at))}}
                                                    </td>
                                                    <td style="color: rgba(0, 161, 76, 0.5)">{{ $Solution_function->name }}</td>
                                                    <td style="color: rgba(0, 161, 76, 0.5)">{{ date('d/m/Y',
                                                        strtotime($Solution_function->created_at))}}</td>
                                                    <td style="color: rgba(0, 161, 76, 0.5)">
                                                        <ul>
                                                            @foreach($custommers as $user)
                                                            <li>{{ $user->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                <h2>Validation Question</h2>
                                <br>
                                <form id="validation_form">
                                    <input type="hidden" name="id" value="{{ @$verification->id }}">
                                    <h5>Have you separated the problem from yourself?</h5>
                                    <ul class="validate_que" style="list-style:none;">

                                        <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{
                                                    (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}
                                                value="1" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;I have separated the problem from myself</label></li>
                                        <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{
                                                    (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}
                                                value="2" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;No, I haven’t separated the problem from myself</label>
                                        </li>

                                    </ul>

                                    <h5>Have you separated the problem from the people?</h5>
                                    <ul class="validate_que" style="list-style:none;">

                                        <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{
                                                    (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}
                                                value="1" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;Yes, I have separated the problem from the people</label>
                                        </li>
                                        <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{
                                                    (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}
                                                value="2" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;No, I haven’t separated the problem from the
                                                people</label></li>

                                    </ul>
                                    @if($VerificationPermission)
                                    <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                                    @endif  
                                </form>

                            </div>
                        </div>
                        <!-- End -->
                    @else
                    @if($VerificationPermission)
                    <div class="col-sm-4">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#commonSolutionModal" id="">+ Identify</button>
                        </div>
                    @endif    
                @endif    
                @else
                <?php $showMsg = true; ?>
                @endif
            </div>
        </div>
    </div>
    <!-- Content Section End -->
    
</div>
@php $verificationName = ($verificationType->id  == 8) ? 'Solution Time Location One' : 'Functions Belong to People Explanation';
  
  @endphp
  @include('adult.verification.view.component.cards' , [$verificationName , $verificationType->id])
@endsection
@section('css')


<style>
    .carousel {
        height: 128px;
        /* overflow: hidden; */
        width: 200px;
        text-align: center;
    }
</style>
@endsection
@section('scripts')


<script>

    $('#verification_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
    });
    $('#verification_users').on('change', function () { 
        var verification_type_id = $('#verification_types').val();
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + verification_type_id + '/' + id;
    });
</script>
<script>
    routes();
    $('.dashboard').click(function () {
        routes();
    })

    $('.validation').on('change', function () {
        var problem = $(this).attr('data-id');
        var validation = $(this).val();
        var name = $(this).attr('name')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('adult.sol-validation')}}",
            data: { data: problem, value: validation, name: name },
            type: 'POST',
            success: function (response) {
                console.log(response)
            }

        })

    })


    

    $('.carousel').carousel({
        interval: 2000
    })

    

    $(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#entityForm')[0]);
        fd.append('table_name', 'solution_time_locations');
        fd.append('type', 1);
        fd.app
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.store-sep-steps')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
                $('#btnSave').attr('disabled', true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled', false);
                $('#btnSave').html('Apply');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Apply');
                    var errors = response.data;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    });
                } else {

                    toastr.success(response.message);
                    location.reload()


                }
            }
        });
    });
    $('#solutio_functio_div').addClass('d-none');
    $('#solution_div').removeClass('d-none')

    var msg = '{{$showMsg}}';
    if(msg) { 
        swal({
            title: "{{@$verificationType->error_title}}",
            text:  "{{@$verificationType->message}}",
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
</script>
@endsection