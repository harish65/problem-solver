@extends('layouts.adult')
@section('title', 'Setting | Adult')

@section('content')
    <div class="min-height-200px">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="assets/vendors/images/banner-img.png" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back <div class="weight-600 font-30 text-blue" style="display: inline-block">{{ Auth::user() -> name}}</div>
                    </h4>
                    <p class="font-18 max-width-600">This is Setting panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix progress-box">
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input"
                    @if (count($setting) > 0)
                        @if ($setting[0] -> single_solution == 1)
                            checked
                        @endif        
                    @endif
                    id="singleSolutionCheck">
                    <label class="custom-control-label" for="singleSolutionCheck">Allow one/solution or single solution per problem? yes/no</label>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $("#singleSolutionCheck").change(function(){
                    var state = 0;

                    if($(this).prop("checked") == true){
                        state = 1;
                    }

                    $.ajax({
                        method: "get",
                        url: "settingAdminSingleSoultin",
                        data: {
                            state: state,
                        },
                        success: function(respose){
                            swal({
                                icon: 'success',
                                title: 'Success',
                                text: 'Your action has been set successfully.',
                            })
                        }
                    })
                })
            })
        </script>
    @endsection