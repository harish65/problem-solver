@extends('layouts.adult')
@section('title', 'Verification | Adult')

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
                    <p class="font-18 max-width-600">This is Verification panel</p>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="dropdown w-100 mb-30">
                <a class="dropdown-toggle w-100" href="#" role="button" data-toggle="dropdown">
                    <span class="user-name">{{ $verificationType -> name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    @foreach ($verificationTypes as $item)
                        <a class="dropdown-item" href="{{ url("adultVerification?type=" . $item -> id) }}"> {{ $item -> name }}</a>
                    @endforeach
                </div>
            </div>
            @if ($verificationType -> id == 1 || $verificationType -> id == 2 || $verificationType -> id == 3)
                @foreach ($verifications as $item)
                    <div class="row clearfix progress-box mt-1">
                        @if ($verificationType -> id == 1 || $verificationType -> id == 2)
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Problem
                                        </span>	
                                        @if($item -> problem -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> problem -> type == 0)
                                                @if(strlen($item -> problem -> file) < 15)
                                                    <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> problem -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> problem -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Problem: {{ $item -> problem -> name }}
                                        </h5>
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> problem -> user -> name }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 text-center px-0" style="margin-top: 20vh">
                                @if($item -> verification_type_id == "1")
                                    @if($item -> type == 1)

                                    @elseif($item -> type == 2)

                                    @elseif($item -> type == 3)

                                    @endif<br>
                                @elseif($item -> verification_type_id == "2")
                                    @if($item -> type == 4)

                                    @elseif($item -> type == 5)

                                    @elseif($item -> type == 6)

                                    @endif<br>
                                @endif
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30 px-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Solution
                                        </span>	
                                        @if($item -> solution -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> solution -> type == 0)
                                                @if(strlen($item -> solution -> file) < 15)
                                                    <img src="{{ asset("assets/solution/" . $item -> solution -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> solution -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/solution/" . $item -> solution -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> solution -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Solution: {{ $item -> solution -> name }}
                                        </h5>
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution -> user -> name }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 px-0 text-center" style="margin-top: 20vh">
                                @if($item -> verification_type_id == "1")
                                    @if($item -> type == 1)
                                    has own
                                    @elseif($item -> type == 2)
                                    given with own
                                    @elseif($item -> type == 3)
                                    provided with own
                                    @endif
                                @elseif($item -> verification_type_id == "2")
                                    @if($item -> type == 4)
                                    <br>
                                    @elseif($item -> type == 5)
                                    given
                                    @elseif($item -> type == 6)
                                    point to
                                    @endif
                                @endif
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 mb-30 pl-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Verification
                                        </span>	
                                        @if($verificationType -> id == 1)
                                        <img src="{{ asset("assets/img/vocabulary.png") }}" class="w-100 fileField">                                
                                        @elseif($verificationType -> id == 2)
                                        <img src="{{ asset("assets/img/info.png") }}" class="w-100 fileField">                                
                                        @endif

                                        <h5 class="text-light-green padding-top-10 h5">
                                            {{ $verificationType -> name }}
                                        </h5>
                                    
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
                                        <div class="btn-group mb-15">
                                            <button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                            data-id="{{ $item -> id }}"
                                            data-type="{{ $item -> type }}"
                                            data-problem="{{ $item -> problem_id }}"
                                            data-solution="{{ $item -> solution_id }}"
                                            data-function="{{ $item -> solution_function_id }}"
                                            ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                            <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationsBtn" data-id="{{ $item -> solution_function_id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-1g-12 col-md-12 col-sm-12 mb-30">
                                <div class="card-box table-responsive p-0" style="border-radius: 0">
                                    <h5 class="d-block text-center list-group-item-success p-2">
                                        {{ $verificationType -> name }}
                                    </h5>	
                                    <table class="table m-0"> 
                                        <thead>
                                            <tr style="text-align: center">
                                                <th scope="col">
                                                    <input type="text" class="form-control" id="verificationTypeKeyInput{{ $item -> id }}_{{ $verificationType -> id }}" value="{{ $verificationType -> key }}" style="display: none">
                                                    <div id="verificationTypeKeyDiv{{ $item -> id }}_{{ $verificationType -> id }}">{{ $verificationType -> key }}</div>
                                                </th>
                                                <th></th>
                                                <th scope="col">
                                                    <input type="text" class="form-control" id="verificationTypeValInput{{ $item -> id }}_{{ $verificationType -> id }}" value="{{ $verificationType -> val }}" style="display: none">
                                                    <div id="verificationTypeValDiv{{ $item -> id }}_{{ $verificationType -> id }}">{{ $verificationType -> val }}</div>
                                                </th>
                                                @if($verificationType -> id == 2)
                                                <th></th>
                                                <th scope="col">
                                                    <input type="text" class="form-control" id="verificationTypeValsInput{{ $item -> id }}_{{ $verificationType -> id }}" value="{{ $verificationType -> vals }}" style="display: none">
                                                    <div id="verificationTypeValsDiv{{ $item -> id }}_{{ $verificationType -> id }}">{{ $verificationType -> vals }}</div>
                                                </th>
                                                @endif
                                                
                                                <th scope="col">
                                                    Action
                                                    {{-- <div class="btn-group">
                                                        <button data-verification="{{ $verificationType -> id }}" data-key="{{ $verificationType -> key }}"data-val="{{ $verificationType -> val }}"  data-item="{{ $item -> solution_function_id }}" data-type="{{ $verificationType -> type }}" type="button" class="btn btn-sm btn-default createVerificationBtn">
                                                            <i class="icon-copy dw dw-add"></i>
                                                        </button->
                                                        <button data-verification="{{ $verificationType -> id }}" data-item="{{ $item -> solution_function_id }}" id="editVerificationTypeBtn{{ $item -> solution_function_id }}_{{ $verificationType -> id }}" type="button" class="btn btn-sm btn-default editVerificationTypeBtn">
                                                            <i class="icon-copy dw dw-edit"></i>
                                                        </button>
                                                        <button data-verification="{{ $verificationType -> id }}" data-item="{{ $item -> solution_function_id }}" type="button" id="checkVerificationTypeBtn{{ $item -> solution_function_id }}_{{ $verificationType -> id }}" class="btn btn-sm btn-default checkVerificationTypeBtn" style="display: none">
                                                            <i class="icon-copy dw dw-check"></i>
                                                        </button>
                                                    </div> --}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="verificationTBodyContainer{{ $item -> id }}">
                                            @forelse ($item -> verification as $verification)
                                                @php
                                                    $k = 0;
                                                @endphp
                                                @if($verification -> verification_type_id == $verificationType -> id)
                                                    @php
                                                        $k ++
                                                    @endphp
                                                    <tr style="text-align: center; align-content: center" id="verificationTR{{ $verification -> id }}">
                                                        <td>
                                                            <div id="verificationKeyDiv{{ $verification -> id }}" class="verificationKeyDiv">{{ $verification -> key }}</div>
                                                            <input type="text" class="form-control verificationKeyInput" id="verificationKeyInput{{ $verification -> id }}" value="{{ $verification -> key }}" style="display: none">
                                                        </td>
                                                        <td style="width: 15%">
                                                            @if($verificationType -> id == 1)
                                                                Point To
                                                            @elseif($verificationType -> id == 2)   

                                                            @endif
                                                            <br>
                                                            <img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">
                                                        </td>
                                                        <td>
                                                            <div id="verificationValDiv{{ $verification -> id }}" class="verificationValDiv">{{ $verification -> val }}</div>
                                                            <input type="text" class="form-control verificationValInput" id="verificationValInput{{ $verification -> id }}" value="{{ $verification -> val }}" style="display: none">
                                                        </td>
                                                        @if($verificationType -> id == 1)
                                                                
                                                        @elseif($verificationType -> id == 2)    
                                                        <td style="width: 15%">
                                                            Point To
                                                            <br>
                                                            <img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">
                                                        </td>
                                                        <td>
                                                            <div id="verificationValsDiv{{ $verification -> id }}" class="verificationValsDiv">{{ $verification -> vals }}</div>
                                                            <input type="text" class="form-control verificationValsInput" id="verificationValsInput{{ $verification -> id }}" value="{{ $verification -> vals }}" style="display: none">
                                                        </td>
                                                        @endif
                                                        <td>
                                                            <div class="btn-group">
                                                                <button 
                                                                data-id="{{ $item -> id }}"
                                                                data-function="{{ $item -> solution_function_id }}" 
                                                                data-type="{{ $verificationType -> id }}" 
                                                                type="button" class="btn btn-sm btn-default createVerificationBtn">
                                                                    <i class="icon-copy dw dw-add"></i>
                                                                </button>
                                                                <button 
                                                                data-id="{{ $verification -> id }}" 
                                                                data-key="{{ $verification -> key }}" 
                                                                data-val="{{ $verification -> val }}"
                                                                @if($verificationType -> id == 2)
                                                                    data-vals="{{ $verification -> vals }}"
                                                                    data-valsname="{{ $verificationType -> vals }}"     
                                                                @endif
                                                                data-type="{{ $verification -> type }}" 
                                                                data-keyname="{{ $verificationType -> key }}" 
                                                                data-valname="{{ $verificationType -> val }}" 
                                                                type="button" class="btn btn-sm btn-default editVerificationBtn">
                                                                    <i class="icon-copy dw dw-edit"></i>
                                                                </button>
                                                                <button data-id="{{ $verification -> id }}" type="button" class="btn btn-sm btn-default delVerificationBtn">
                                                                    <i class="icon-copy dw dw-delete"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                            @empty    
                                                <tr style="text-align: center">
                                                    @if($verificationType -> id == 1)
                                                        <td colspan="4">There is no data to show</td>          
                                                    @elseif($verificationType -> id == 2)
                                                        <td colspan="6">There is no data to show</td>
                                                    @endif
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>

                        @elseif($verificationType -> id == 3)
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Function
                                        </span>	
                                        @if($item -> solution_function -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> solution_function -> type == 0)
                                                @if(strlen($item -> solution_function -> file) < 15)
                                                    <img src="{{ asset("assets/solFunction/" . $item -> solution_function -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> solution_function -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/solFunction/" . $item -> solution_function -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> solution_function -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution_function -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Function: {{ $item -> solution_function -> name }}
                                        </h5>
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution_function -> user -> name }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 text-center px-0" style="margin-top: 20vh">
                                to solve <br>
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30 px-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Problem
                                        </span>	
                                        @if($item -> problem -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> problem -> type == 0)
                                                @if(strlen($item -> problem -> file) < 15)
                                                    <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> problem -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> problem -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Problem: {{ $item -> problem -> name }}
                                        </h5>
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> problem -> user -> name }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 px-0 text-center" style="margin-top: 20vh">
                                @if($item -> verification_type_id == "3")
                                    @if($item -> type == 7)
                                    is excuted by
                                    @elseif($item -> type == 8)
                                    belong to
                                    @endif
                                @endif
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 mb-30 pl-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            @php
                                                $data = App\Models\Verification::where("verification_type_id", $verificationType -> id)
                                                    -> where("solution_id", $item -> solution_id)
                                                    -> get();
                                                $k = -1;
                                                $l = -1;
                                            @endphp
                                            @if (count($data) > 1)
                                                People
                                            @else
                                                Person
                                            @endif
                                        </span>	
                                        <div id="carouselExampleCaptions{{ $item -> id }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <ol class="carousel-indicators">
                                                    @foreach ($data as $carousel)
                                                        @php
                                                            $l ++;
                                                        @endphp
                                                        <li data-target="#carouselExampleCaptions{{ $item -> id }}" data-slide-to="{{ $l }}" class=" {{ $l == 0 ? 'active' : '' }}"></li>     
                                                    @endforeach
                                                </ol>
                                                @foreach ($data as $carousel)
                                                    @php
                                                        $k ++;
                                                    @endphp
                                                    <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset("assets/verification/" . $carousel -> file) }}" class="w-100 fileField">
                                                        <h5 class="text-light-green padding-top-10 h5">
                                                            {{ $carousel -> val }}
                                                            @if ($carousel -> key != "")
                                                                : {{ $carousel -> key }}
                                                            @endif
                                                        </h5>
                                                    
                                                        {{-- <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $carousel -> user -> name }} </span> --}}
                                                        <div class="btn-group mb-15">
                                                            <button type="button" data-toggle="tooltip" title="Edit" 
                                                            class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                                            data-id="{{ $carousel -> id }}"
                                                            data-type="{{ $item -> type }}"
                                                            data-key="{{ $carousel -> key }}"
                                                            data-val="{{ $carousel -> val }}"
                                                            data-problem="{{ $carousel -> problem_id }}"
                                                            data-solution="{{ $carousel -> solution_id }}"
                                                            data-function="{{ $carousel -> solution_function_id }}"
                                                            data-ftype="{{ $carousel -> file_type }}"
                                                            data-file="{{ $carousel -> file }}"
                                                            ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                                            <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationBtn" data-id="{{ $carousel -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-1g-12 col-md-12 col-sm-12 mb-30">
                                <div class="card-box table-responsive p-0" style="border-radius: 0">
                                    <h5 class="d-block text-center list-group-item-success p-2">
                                        People & Function Identification
                                    </h5>	
                                    <table class="table table-striped table-bordered m-0"> 
                                        <thead>
                                            <tr style="text-align: center">
                                                <th scope="col">
                                                    Person Name
                                                </th>
                                                <th scope="col">
                                                    Function Name
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="verificationTBodyContainer{{ $item -> id }}">
                                            @foreach ($item -> verification as $verification)
                                                @if($verification -> verification_type_id == $verificationType -> id)
                                                    <tr style="text-align: center; align-content: center" id="verificationTR{{ $verification -> id }}">
                                                        <td>
                                                           {{ $verification -> val }}
                                                        </td>
                                                        <td>
                                                           {{ $verification -> solution_function -> name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                        @endif
                    </div>
                @endforeach
            @elseif($verificationType -> id == 4)
                <div class="row clearfix progress-box">
                    @foreach ($solFunctions as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pr-0">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        Problem 
                                    </span>	
                                    @if($item -> problem -> file == null)
                                        <div class="fileField"></div>
                                    @else
                                        @if($item -> problem -> type == 0)
                                            @if(strlen($item -> file) < 15)
                                                <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                            @endif
                                        @elseif($item -> type == 1)
                                            <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                            </video>
                                        @elseif($item -> type == 2)
                                            <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                        @endif
                                    @endif			
                                    <h6 class="padding-top-10">Before</h6>		
                                    <h5 class="text-light-green padding-top-10 h5">
                                        Problem: {{ $item -> problem -> name }}
                                    </h5>
                                
                                    <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 p-0 m-0 px-0">
                            <div class="text-center" style="margin-top: 20vh">
                                then
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -50px">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pl-0">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        Solution 
                                    </span>	
                                    @if($item -> solution -> file == null)
                                        <div class="fileField"></div>
                                    @else
                                        @if($item -> type == 0)
                                            @if(strlen($item -> solution -> file) < 15)
                                                <img src="{{ asset("assets/solution/" . $item -> solution -> file) }}" class="w-100 fileField">
                                            @endif
                                        @elseif($item -> solution -> type == 1)
                                            <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                <source src="{{ asset("assets/solution/" . $item -> solution -> file) }}#t=0.1" type="video/mp4">
                                            </video>
                                        @elseif($item -> solution -> type == 2)
                                            <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                        @endif
                                    @endif					
                                    <h6 class="padding-top-10">After</h6>		
                                    <h5 class="text-light-green padding-top-10 h5">
                                        Solution: {{ $item -> solution -> name }}
                                    </h5>
                                
                                    <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution -> user -> name }} </span>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                    @endforeach
                </div>
            @elseif($verificationType -> id == 5)
                <div class="row clearfix progress-box">
                    @foreach ($verifications as $item)
                        @if ($item -> solution_id != null)
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pl-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            @php
                                                $data = App\Models\Verification::where("verification_type_id", 3)
                                                    -> where("solution_id", $item -> solution_id)
                                                    -> get();
                                                $k = -1;
                                                $l = -1;
                                            @endphp
                                            @if (count($data) > 1)
                                                People
                                            @else
                                                Person
                                            @endif
                                        </span>	
                                        <div id="carouselExampleCaptions{{ $item -> id }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <ol class="carousel-indicators">
                                                    @foreach ($data as $carousel)
                                                        @php
                                                            $l ++;
                                                        @endphp
                                                        <li data-target="#carouselExampleCaptions{{ $item -> id }}" data-slide-to="{{ $l }}" class=" {{ $l == 0 ? 'active' : '' }}"></li>     
                                                    @endforeach
                                                </ol>
                                                @foreach ($data as $carousel)
                                                @php
                                                    $k ++;
                                                @endphp
                                                <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                                                    
                                                    <img src="{{ asset("assets/verification/" . $carousel -> file) }}" class="w-100 fileField">

                                                    <h5 class="text-light-green padding-top-10 h5">
                                                        {{ $carousel -> val }}
                                                    </h5>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="d-block text-success">#1 </span>     
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pr-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Problem
                                        </span>	
                                        @if($item -> problem -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> problem -> type == 0)
                                                @if(strlen($item -> problem -> file) < 15)
                                                    <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> problem -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> problem -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Problem: {{ $item -> problem -> name }}
                                        </h5>
                                        <span class="d-block text-success">#2 </span>     
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-30 px-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Solution
                                        </span>	
                                        @if($item -> solution -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> solution -> type == 0)
                                                @if(strlen($item -> solution -> file) < 15)
                                                    <img src="{{ asset("assets/solution/" . $item -> solution -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> solution -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/solution/" . $item -> solution -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> solution -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Solution: {{ $item -> solution -> name }}
                                        </h5>
                                        <span class="d-block text-success">#3 </span>     
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                        @endif
                    @endforeach
                </div>
            @elseif($verificationType -> id == 6)
                <div class="row clearfix progress-box">
                        <div class="col-1g-12 col-md-12 col-sm-12 mb-30">
                            <div class="card-box table-responsive p-0" style="border-radius: 0">
                                <h5 class="d-block text-center list-group-item-success p-2">
                                    Time Verification
                                </h5>	
                                <table class="table table-striped table-bordered m-0"> 
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col">
                                                {{ $verificationType -> key }}
                                            </th>
                                            <th scope="col">
                                                {{ $verificationType -> val }}
                                            </th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($verifications as $item)
                                            <tr style="text-align: center; align-content: center">
                                                <td>
                                                {{ $item -> key }}
                                                </td>
                                                <td>
                                                    @if ($item -> val == 0)
                                                        Yes
                                                    @else
                                                        No                                                        
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-15">
                                                        <button type="button" data-toggle="tooltip" title="Edit" 
                                                        class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                                        data-id="{{ $item -> id }}"
                                                        data-type="{{ $item -> type }}"
                                                        data-key="{{ $item -> key }}"
                                                        data-val="{{ $item -> val }}"
                                                        ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                                        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationBtn" data-id="{{ $item -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr colspan="2" style="text-align: center">
                                                <td colspan="2">There is no data to show</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
               
            @elseif($verificationType -> id == 7)
                <div class="clearfix progress-box mb-30">
                    <div class="card-box table-responsive p-0" style="border-radius: 0">
                        <h5 class="d-block text-center bg-success p-2 text-white">
                        Past Time Present Time
                        </h5>	
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr style="text-align: center">
                                <th scope="col" style="font-weight: 900">Date</th>
                                <th scope="col" style="font-weight: 900">Problem Name</th>
                                <th scope="col" style="font-weight: 900">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($verifications  as $item)
                                <tr style="text-align: center; align-content: center">
                                    <td scope="row">
                                        {{ $item -> key }}
                                    </td>
                                    <td scope="row">
                                        {{ $item -> problem -> name }}
                                    </td>
                                    <td>
                                        <div class="btn-group mb-15">
                                            <button type="button" data-toggle="tooltip" title="Edit" 
                                            class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                            data-id="{{ $item -> id }}"
                                            data-type="{{ $item -> type }}"
                                            data-key="{{ $item -> key }}"
                                            data-problem="{{ $item -> problem_id }}"
                                            ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                            <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationBtn" data-id="{{ $item -> id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr style="text-align: center">
                                    <td colspan="3">There is no data to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            @elseif($verificationType -> id == 8)
                <div class="row clearfix progress-box">
                    @foreach ($verifications as $item)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        {{ $verificationType -> key }}
                                    </span>	
                                    <img src="{{ asset("assets/img/available.webp") }}" class="w-100 fileField">
                                    <h5 class="text-light-green padding-top-10 h5">
                                        {{ $item -> key }}
                                    </h5>
                                    <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 text-center px-0" style="margin-top: 20vh">
                            @if($item -> type == 9 || $item -> type == 12 || $item -> type == 14 || $item -> type == 16 || $item -> type == 19 || $item -> type == 21)
                                <img src="{{ asset("assets/img/plus.png") }}" class="w-100" style="margin-top: -15px">
                            @elseif($item -> type == 10 || $item -> type == 11 || $item -> type == 13 || $item -> type == 15 || $item -> type == 17 || $item -> type == 18 || $item -> type == 20 || $item -> type == 22)
                                plus<br>
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-30 px-0">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        {{ $verificationType -> val }}
                                    </span>	
                                    <img src="{{ asset("assets/img/given.jpg") }}" class="w-100 fileField">                            
                                    <h5 class="text-light-green padding-top-10 h5">
                                        {{ $item -> val }}
                                    </h5>
                                    <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> user -> name }} </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 px-0 text-center" style="margin-top: 20vh">
                            @if($item -> type == 9 || $item -> type == 12 || $item -> type == 14 || $item -> type == 16 || $item -> type == 19 || $item -> type == 21)
                                <br><img src="{{ asset("assets/img/equal.png") }}" class="w-100" style="margin-top: -15px">
                            @elseif($item -> type == 10 || $item -> type == 11 || $item -> type == 13 || $item -> type == 15 || $item -> type == 17 || $item -> type == 18 || $item -> type == 20 || $item -> type == 22)
                                equal<br>
                                <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px">
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 mb-30 pl-0">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        Solution
                                    </span>	
                                    @if($item -> solution -> file == null)
                                        <div class="fileField"></div>
                                    @else
                                        @if($item -> solution -> type == 0)
                                            @if(strlen($item -> solution -> file) < 15)
                                                <img src="{{ asset("assets/solution/" . $item -> solution -> file) }}" class="w-100 fileField">
                                            @endif
                                        @elseif($item -> solution -> type == 1)
                                            <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                <source src="{{ asset("assets/solution/" . $item -> solution -> file) }}#t=0.1" type="video/mp4">
                                            </video>
                                        @elseif($item -> solution -> type == 2)
                                            <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> solution -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                        @endif
                                    @endif					
                                    <h5 class="text-light-green padding-top-10 h5">
                                        Solution: {{ $item -> solution -> name }}
                                    </h5>
                                    <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> solution -> user -> name }} </span>
                                    <div class="btn-group mb-15">
                                        <button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                        data-id="{{ $item -> id }}"
                                        data-type="{{ $item -> type }}"
                                        data-solution="{{ $item -> solution_id }}"
                                        data-key="{{ $item -> key }}"
                                        data-val="{{ $item -> val }}"
                                        ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationsBtn" data-id="{{ $item -> solution_function_id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-1g-12 col-md-12 col-sm-12 mb-30">
                            <div class="card-box table-responsive p-0" style="border-radius: 0">
                                <h5 class="d-block text-center list-group-item-success p-2">
                                    Entity Given Identification
                                </h5>	
                                <table class="table m-0"> 
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col">
                                                Principle Count
                                            </th>
                                            <th>
                                                Actual Principle
                                            </th>
                                            <th scope="col">
                                                Usage
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td>1</td>
                                            <td>The Given Set of Communication Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>2</td>
                                            <td>The Given Set of Information Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>3</td>
                                            <td>The Given Set of Instrumentation Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>4</td>
                                            <td>The Given Set of Education Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>5</td>
                                            <td>The Given Set of Power Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>6</td>
                                            <td>The Given Set of Marketing Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>7</td>
                                            <td>The Given Set of Exchange Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>8</td>
                                            <td>The Given Set of Gaming Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>9</td>
                                            <td>The Give Set of Work Principle</td>
                                            <td>No</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td>10</td>
                                            <td>The Given Set of Reproduction Principle</td>
                                            <td>No</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="card-box table-responsive p-0" style="border-radius: 0">
                                <h5 class="d-block text-center list-group-item-success p-2">
                                    Entity Available Identification
                                </h5>	
                                <table class="table m-0"> 
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col">
                                                Entity Available
                                            </th>
                                            <th>
                                                Antity Given
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td>1</td>
                                            <td>The Given Set of Communication Principle</td>
                                            <select class="form-control">
                                                <option value="0">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                    @endforeach
                </div>
            @elseif($verificationType -> id == 9)
                <div class="row clearfix progress-box mt-1">
                    @foreach ($verifications as $item)
                        @if ($item -> solution_id != null)
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-30 pr-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            My Location
                                        </span>	
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                @php
                                                    $data = App\Models\Verification::where("verification_type_id", 3)
                                                        -> where("solution_id", $item -> solution_id)
                                                        -> get();
                                                    $k = -1;
                                                    $l = -1;
                                                @endphp
                                                <div id="carouselExampleCaptions{{ $item -> id }}" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <ol class="carousel-indicators">
                                                            @foreach ($data as $carousel)
                                                                @php
                                                                    $l ++;
                                                                @endphp
                                                                <li data-target="#carouselExampleCaptions{{ $item -> id }}" data-slide-to="{{ $l }}" class=" {{ $l == 0 ? 'active' : '' }}"></li>     
                                                            @endforeach
                                                        </ol>
                                                        @foreach ($data as $carousel)
                                                            @php
                                                                $k ++;
                                                            @endphp
                                                            <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                                                                <img src="{{ asset("assets/verification/" . $carousel -> file) }}" class="w-100 fileField">
                                                                <h5 class="text-light-green padding-top-10 h5">
                                                                    {{ $carousel -> val }}
                                                                    @if ($carousel -> key != "")
                                                                        : {{ $carousel -> key }}
                                                                    @endif
                                                                </h5>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                @if($item -> problem -> file == null)
                                                    <div class="fileField"></div>
                                                @else
                                                    @if($item -> problem -> type == 0)
                                                        @if(strlen($item -> problem -> file) < 15)
                                                            <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                                        @endif
                                                    @elseif($item -> problem -> type == 1)
                                                        <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                            <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                                        </video>
                                                    @elseif($item -> problem -> type == 2)
                                                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                                    @endif
                                                @endif					
                                                <h5 class="text-light-green padding-top-10 h5">
                                                    Problem: {{ $item -> problem -> name }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 mb-30 p-0 m-0 px-0">
                                <div class="text-center" style="margin-top: 20vh">
                                    <div>
                                        <span class="float-left">Start</span>
                                        <span class="float-right text-success">Finish</span>
                                    </div>
                                    <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -20px">
                                    <div style="margin-top: -20px">
                                        <span class="float-left">Now</span>
                                        <span class="float-right text-success">Later</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pl-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Destination
                                        </span>	
                                        <img src="{{ asset("assets/img/housek.png") }}" class="w-100">	
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Solution: {{ $item -> solution -> name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                        @endif
                        
                    @endforeach
                </div>
            @elseif($verificationType -> id == 10)
                <div class="row clearfix progress-box mt-1">
                    @foreach ($verifications as $item)
                        @if ($item -> solution_id != null)
                            <div class="col-lg-3 col-md-3 col-sm-12 mb-30 pr-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Problem
                                        </span>	
                                        @if($item -> problem -> file == null)
                                            <div class="fileField"></div>
                                        @else
                                            @if($item -> problem -> type == 0)
                                                @if(strlen($item -> problem -> file) < 15)
                                                    <img src="{{ asset("assets/problem/" . $item -> problem -> file) }}" class="w-100 fileField">
                                                @endif
                                            @elseif($item -> problem -> type == 1)
                                                <video controls="controls" preload="metadata" class="w-100 fileField" preload="metadata">
                                                    <source src="{{ asset("assets/problem/" . $item -> problem -> file) }}#t=0.1" type="video/mp4">
                                                </video>
                                            @elseif($item -> problem -> type == 2)
                                                <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $item -> problem -> file)[1])[1] . "/0.jpg" }}" class="w-100 fileField">
                                            @endif
                                        @endif					
                                        <h5 class="text-light-green padding-top-10 h5">
                                            Problem: {{ $item -> problem -> name }}
                                        </h5>
                                        <span class="d-block text-primary"><i class="icon-copy dw dw-support-1"></i> {{ $item -> problem -> user -> name }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 mb-30 p-0 m-0 px-0">
                                <div class="text-center" style="margin-top: 20vh">
                                    <div>
                                        <span class="float-left">Start</span>
                                        <span class="float-right text-success">Finish</span>
                                    </div>
                                    <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -20px">
                                    <div style="margin-top: -20px">
                                        <span class="float-left">Now</span>
                                        <span class="float-right text-success">Later</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-30 pl-0">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            Destination
                                        </span>	
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <img src="{{ asset("assets/img/housek.png") }}" class="w-100">	
                                                <h5 class="text-light-green padding-top-10 h5">
                                                    Solution: {{ $item -> solution -> name }}
                                                </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <span class="d-block">
                                                    @php
                                                        $data = App\Models\Verification::where("verification_type_id", 3)
                                                            -> where("solution_id", $item -> solution_id)
                                                            -> get();
                                                        $k = -1;
                                                        $l = -1;
                                                    @endphp
                                                </span>	
                                                <div id="carouselExampleCaptions{{ $item -> id }}" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <ol class="carousel-indicators">
                                                            @foreach ($data as $carousel)
                                                                @php
                                                                    $l ++;
                                                                @endphp
                                                                <li data-target="#carouselExampleCaptions{{ $item -> id }}" data-slide-to="{{ $l }}" class=" {{ $l == 0 ? 'active' : '' }}"></li>     
                                                            @endforeach
                                                        </ol>
                                                        @foreach ($data as $carousel)
                                                            @php
                                                                $k ++;
                                                            @endphp
                                                            <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                                                                <img src="{{ asset("assets/verification/" . $carousel -> file) }}" class="w-100 fileField">
                                                                <h5 class="text-light-green padding-top-10 h5">
                                                                    {{ $carousel -> val }}
                                                                </h5>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-30" style="border: solid 1px #c9c9c9"></div>
                        @endif
                    @endforeach
                </div>
            @elseif($verificationType -> id == 11)
                <div class="row clearfix progress-box mt-1">
                    @foreach ($verifications as $item)
                        @php
                            $data = App\Models\Verification::where("verification_type_id", 3)
                                -> where("solution_id", $item -> solution_id)
                                -> get();
                        @endphp
                        
                        @foreach ($data as $carousel)
                            
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                                <div class="card-box pd-30 height-100-p">
                                    <div class="progress-box text-center">
                                        <span class="d-block text-success problem-title-bottom-border mb-2">
                                            People
                                        </span>	
                                        <img src="{{ asset("assets/verification/" . $carousel -> file) }}" class="w-100 fileField">
                                        <h5 class="text-light-green padding-top-10 h5">
                                            {{ $carousel -> val }}
                                            @if ($carousel -> key != "")
                                                : {{ $carousel -> key }}
                                            @endif
                                        </h5>
                                        <span class="d-block text-primary">Customer</span>

                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    @endforeach
                </div>
            @elseif($verificationType -> id == 12)
                <div class="row clearfix progress-box mt-1">
                    @foreach ($verifications as $item)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        People
                                    </span>	
                                    <img src="{{ asset("assets/verification/" . $item -> file) }}" class="w-100 fileField">
                                    <h5 class="text-light-green padding-top-10 h5">
                                        {{ $item -> val }}
                                        @if ($item -> key != "")
                                            : {{ $item -> key }}
                                        @endif
                                    </h5>
                                    <span class="d-block text-primary">Customer</span>
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Communication
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item updateVerificationsBtn" 
                                        data-id="{{ $item -> id }}"
                                        data-key="{{ $item -> key }}"
                                        >Text</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($verificationType -> id == 13)
                <div class="row clearfix progress-box mt-1">
                    <div class="col-lg-8 col-md-6 col-sm-12" id="communicationFlowPeopleContainer">
                        @foreach ($verifications as $item)
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card-box pd-30 mb-30">
                                        <div class="progress-box text-center">
                                            <span class="d-block text-success problem-title-bottom-border mb-2">
                                                Person
                                            </span>	
                                            <img src="{{ asset("assets/verification/" . $item -> file) }}" class="w-100 fileField">
                                            <h5 class="text-light-green padding-top-10 h5">
                                                {{ $item -> val }}
                                                @if ($item -> key != "")
                                                    : {{ $item -> key }}
                                                @endif
                                            </h5>
                                            <span class="d-block text-primary">Customer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="mb-30">
                                        <div class="progress-box text-center">
                                            <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: 15vh">             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card-box pd-30 mb-30" id="communicationFlowMixtureContainer" style="display: table; overflow: hidden;">
                            <div class="progress-box text-center">
                                Communication Mixture
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($verificationType -> id == 14)
                <div class="row clearfix progress-box mt-1">
                    @foreach ($verifications as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <span class="d-block text-success problem-title-bottom-border mb-2">
                                        Entity Behind
                                    </span>	
                                    <div style="position: relative;text-align: center;">
                                        <img src="{{ asset("assets/verification/" . $item -> file) }}" class="w-100">
                                        @php
                                            $entities = explode(",", $item -> key)
                                        @endphp
                                        <ul style="position: absolute; left: 50%;top: 50%; transform: translate(-50%, -50%); background-color: rgba(73, 73, 73, 0.356); padding: 10px">
                                            @foreach ($entities as $entity)
                                                @if ($entity != "")
                                                    <li style=" list-style-type: circle;">{{ $entity }}</li>                                            
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div align="center" class="text-center">
                                        <div class="btn-group mb-5 mt-2" align="center">
                                            <button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                            data-id="{{ $item -> id }}"
                                            data-type="{{ $item -> type }}"
                                            data-file="{{ $item -> file }}"
                                            data-key="{{ $item -> key }}"
                                            data-val="{{ $item -> val }}"
                                            ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                            <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationsBtn" data-id="{{ $item -> solution_function_id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-1g-12 col-md-12 col-sm-12 mb-30">
                        <div class="card-box table-responsive p-0" style="border-radius: 0">
                            <h5 class="d-block text-center list-group-item-success p-2">
                                Entity Behind
                            </h5>	
                            <table class="table table-striped table-bordered m-0"> 
                                <thead>
                                    <tr style="text-align: center">
                                        <th scope="col">
                                            Entity Name
                                        </th>
                                        <th scope="col">
                                            Put Behind
                                        </th>
                                        <th scope="col">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="verificationTBodyContainer{{ $item -> id }}">
                                    @foreach ($verifications as $item)
                                        <tr style="text-align: center; align-content: center">
                                            <td>
                                            {{ $item -> key }}
                                            </td>
                                            <td>
                                                @if($item -> val == 0)
                                                    Yes
                                                @elseif($item -> val == 1)
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mb-5 mt-2" align="center">
                                                    <button type="button" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-light float-left updateVerificationsBtn" 
                                                    data-id="{{ $item -> id }}"
                                                    data-type="{{ $item -> type }}"
                                                    data-file="{{ $item -> file }}"
                                                    data-key="{{ $item -> key }}"
                                                    data-val="{{ $item -> val }}"
                                                    ><i class="icon-copy fa fa-edit" aria-hidden="true"></i></button>
                                                    <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-light float-right delVerificationsBtn" data-id="{{ $item -> solution_function_id }}"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @elseif($verificationType -> id == 15)
                @if (count($verifications) > 0)
                    <div class="row clearfix progress-box mt-1">
                        <div class="col-lg-5 col-md-6 pr-0">
                            <div class="card-box py-30 height-100-p" style="padding: 30px 0">
                                <div class="progress-box text-center">
                                    @foreach ($verifications as $item)
                                        <div class="mt-1">
                                            <button class="btn btn-outline-primary btn-block w-100">{{ $item -> key }}</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 px-0">
                            <div class="py-30 height-100-p">
                                <div class="progress-box text-center" style="font-size: 70%">
                                    @foreach ($verifications as $item)
                                        @if ($item -> type == 28)
                                            substututed by
                                        @elseif ($item -> type == 29)
                                            has
                                        @elseif ($item -> type == 30)
                                            has a solution of
                                        @endif
                                        <img src="{{ asset("assets/img/arrow.png") }}" class="w-100" style="margin-top: -15px;">             
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 pl-0">
                            <div class="card-box py-30 height-100-p" style="padding: 30px 0">
                                <div class="progress-box text-center">
                                    @foreach ($verifications as $item)
                                        <div class="mt-1">
                                            <button class="btn btn-outline-primary btn-block w-100">{{ $item -> val }}</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($verificationType -> id == 16)
                <div class="row clearfix progress-box mt-1">

                </div>
            @elseif($verificationType -> id == 17)
                <div class="row clearfix progress-box mt-1">
                    <div class="card-box table-responsive p-0" style="border-radius: 0">
                        <h5 class="d-block text-center list-group-item-success p-2">
                            Principle Identification
                        </h5>	
                        {{-- <table class="table m-0"> 
                            <thead>
                                <tr style="text-align: center">
                                    <th scope="col">
                                        Principle Count
                                    </th>
                                    <th>
                                        Actual Principle
                                    </th>
                                    <th scope="col">
                                        Usage
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $k = 1;
                                @endphp
                                @foreach($verifications as $verification)
                                    <tr style="text-align: center">
                                        <td>{{ $k ++ }}</td>
                                        <td>{{ $verification -> problem -> name }}</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="0">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </td>
                                    </tr>                   
                                @endforeach
                            </tbody>
                        </table> --}}
                        <table class="table m-0"> 
                            <thead>
                                <tr style="text-align: center">
                                    <th scope="col">
                                        Principle Count
                                    </th>
                                    <th>
                                        Actual Principle
                                    </th>
                                    <th scope="col">
                                        Usage
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center">
                                    <td>1</td>
                                    <td>The Given Set of Communication Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>2</td>
                                    <td>The Given Set of Information Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>3</td>
                                    <td>The Given Set of Instrumentation Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>4</td>
                                    <td>The Given Set of Education Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>5</td>
                                    <td>The Given Set of Power Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>6</td>
                                    <td>The Given Set of Marketing Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>7</td>
                                    <td>The Given Set of Exchange Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>8</td>
                                    <td>The Given Set of Gaming Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>9</td>
                                    <td>The Give Set of Work Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td>10</td>
                                    <td>The Given Set of Reproduction Principle</td>
                                    <td>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            
            @if ($verificationType -> id != 4 && $verificationType -> id != 5 && $verificationType -> id != 9 && $verificationType -> id != 10 && $verificationType -> id != 12 && $verificationType -> id != 13 && $verificationType -> id != 16 && $verificationType -> id != 17)
                <div class="row clearfix progress-box mt-1">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-30 pr-0">
                        <div class="card-box pd-30 height-100-p" data-toggle="tooltip" title="Identify Verification">
                            <div class="progress-box text-center" id="createVerificationBtn">
                                <h1 class="text-light-green padding-top-10 h1" style="font-size: 10rem">
                                    <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                </h1>
                                <span class="d-block">Identify Verification </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($verificationType -> id == 4)
                <div class="clearfix progress-box mb-30">
                    <div class="card-box table-responsive p-0" style="border-radius: 0">
                        <h5 class="d-block text-center bg-success p-2 text-white">
                        Before and After Verification
                        </h5>	
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr style="text-align: center">
                                <th scope="col" style="font-weight: 900">Before</th>
                                <th scope="col" style="font-weight: 900">After</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($solFunctions as $item)
                            <tr style="text-align: center; align-content: center">
                                <td scope="row">
                                    {{ $item -> problem -> name }}
                                </td>
                                <td scope="row">
                                    {{ $item -> solution -> name }}
                                </td>
                            </tr>
                            @empty
                                <tr style="text-align: center">
                                    <td colspan="2">There is no data to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ url("createVerification") }}" class="modal fade" id="createVerificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Identify Verification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="custom-select" name="verification_type_id" id="createVerificationSelect">
                            <option value="{{ $verificationType -> id }}" 
                                data-key="{{ $verificationType -> key }}"
                                data-val="{{ $verificationType -> val }}">
                                Verification Type: {{ $verificationType -> name }}
                            </option>
                        </select>
                    </div>
                    @if ($verificationType -> id == 3 || $verificationType -> id == 11 || $verificationType -> id == 13)
                        <input type="hidden" name="type" value="0" id="createVerificationType">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="createVerificationFileRadio" name="file_type" class="custom-control-input createVerificationType" value="0" checked>
                                        <label class="custom-control-label" for="createVerificationFileRadio"> File</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="createVerificationLinkRadio" name="file_type" class="custom-control-input createVerificationType" value="2">
                                        <label class="custom-control-label" for="createVerificationLinkRadio"> Link</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="createVerificationFileType">
                            <input type="file" name="file" id="createVerificationFileFile" class="dropify" accept="image/*, video/*">
                            @error('file')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#createVerificationModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="form-group" id="createVerificationLinkType" style="display: none">
                            <input type="url" name="link" id="createVerificationLinkFile" class="form-control" placeholder="Link">
                            @error('link')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#createVerificationModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>    
                    @endif
                    @if ($verificationType -> id == 7 || $verificationType -> id == 6)
                        <div class="form-group">
                            <input type="text" class="form-control datepickers" name="key" placeholder="Date" value="{{ date("Y-m-d") }}">
                        </div>
                    @endif

                    @if($verificationType -> id == 6)
                        <div class="form-group">
                            <select class="custom-select" name="val" >
                                <option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    @endif
                   
                    @if ($verificationType -> id != 8 && $verificationType -> id != 6 && $verificationType -> id != 11 && $verificationType -> id != 13 && $verificationType -> id != 15)
                        <div class="form-group">
                            <select class="custom-select" name="problem_id" id="createVerificationProblemSelect">
                                @foreach ($solFunctions as $item)
                                    <option value="{{ $item -> problem -> id }}">Problem: {{ $item -> problem -> name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($verificationType -> id != 7 && $verificationType -> id != 8 && $verificationType -> id != 6 && $verificationType -> id != 11 && $verificationType -> id != 13 && $verificationType -> id != 15)
                        <div class="form-group">
                            <select class="custom-select" name="solution_id" id="createVerificationSolutionSelect">
                                @foreach ($solFunctions[0] -> problem -> solution as $item)
                                    <option value="{{ $item -> id }}">Solution: {{ $item -> name }}</option>                                    
                                @endforeach
                            </select>
                            @error('solution_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#createSolFunctionModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="solution_function_id" id="createVerificationSolfunctionSelect">
                                @foreach ($solFunctions[0] -> solution -> solFunction as $item)
                                    <option value="{{ $item -> id }}">Solution Function: {{ $item -> name }}</option>                                    
                                @endforeach
                            </select>
                            @error('solution_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#createSolFunctionModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        @if($verificationType -> id == 3)
                            <div class="form-group">
                                <input type="text" name="key" id="createVerificationKey" class="form-control" placeholder="{{ $verificationType -> key }}">
                                @error('key')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <script>
                                        $(document).ready(function(){
                                            $("#createVerificationModal").modal("show");
                                        })
                                    </script>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="val" id="createVerificationVal" class="form-control" placeholder="{{ $verificationType -> val }}" required>
                                @error('val')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <script>
                                        $(document).ready(function(){
                                            $("#createVerificationModal").modal("show");
                                        })
                                    </script>
                                @enderror
                            </div>
                        @endif
                        @if ($verificationType -> id != 17)
                            <div class="form-group">
                                <select class="custom-select" name="type" id="createVerificationTypeSelect">
                                    @foreach ($verificationType -> verification_type_text as $text)
                                        <option value="{{ $text -> id }}">{{ $text -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                    @elseif($verificationType -> id == 8 || $verificationType -> id == 11 || $verificationType -> id == 13 || $verificationType -> id == 15)
                        @if ($verificationType -> id != 11 && $verificationType -> id != 13 && $verificationType -> id != 15)
                            <div class="form-group">
                                <select class="custom-select" name="solution_id" id="createVerificationSolutionSelect">
                                    @foreach ($solFunctions as $item)
                                        <option value="{{ $item -> solution -> id }}">Solution: {{ $item -> solution -> name }}</option>                                    
                                    @endforeach
                                </select>
                                @error('solution_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <script>
                                        $(document).ready(function(){
                                            $("#createSolFunctionModal").modal("show");
                                        })
                                    </script>
                                @enderror
                            </div>    
                        @endif    
                        <div class="form-group">
                            <input type="text" class="form-control" name="key" placeholder="{{ $verificationType -> key }}" 
                            @if($verificationType -> id != 11)
                                unique
                            @endif
                            >
                        </div>
                        @if($verificationType -> id != 13)
                            <div class="form-group">
                                <input type="text" class="form-control" name="val" placeholder="{{ $verificationType -> val }}" required>
                            </div>
                        @elseif($verificationType -> id == 13)
                            <div class="form-group">
                                <select class="custom-select" name="val">
                                    <option value="0">Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        @endif
                        
                        @if ($verificationType -> id != 11 && $verificationType -> id != 13)
                            <div class="form-group">
                                <select class="custom-select" name="type" id="createVerificationTypeSelect">
                                    @foreach ($verificationType -> verification_type_text as $text)
                                        <option value="{{ $text -> id }}">{{ $text -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif  
                    @if ($verificationType -> id == 17)
                        <div class="form-group">
                            <input type="text" name="type" id="createVerificationTypeSelect" value="{{ $verificationType -> verification_type_text[0] -> name }}" class="form-control" readonly>
                        </div>
                    @endif              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("updateVerifications") }}" class="modal fade" id="updateVerificationsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Verifications</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   
                    @if ($verificationType -> id == 3 || $verificationType -> id == 13)
                        <input type="hidden" name="updateVerificationsFType" id="updateVerificationsFType">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="updateVerificationsFileRadio" name="updateVerificationsFileType" class="custom-control-input updateVerificationsFileType" value="0" checked>
                                        <label class="custom-control-label" for="updateVerificationsFileRadio"> File</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="updateVerificationsLinkRadio" name="updateVerificationsFileType" class="custom-control-input updateVerificationsFileType" value="2">
                                        <label class="custom-control-label" for="updateVerificationsLinkRadio"> Link</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="updateVerificationsFileType">
                            <input type="file" name="updateVerificationsFile" id="updateVerificationsFileFile" class="dropify" accept="image/*, video/*">
                            @error('updateVerificationsFile')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="form-group" id="verificationVerificationsLinkType" style="display: none">
                            <input type="url" name="updateVerificationsLink" id="updateVerificationsLinkFile" class="form-control" placeholder="Link">
                            @error('updateVerificationsLink')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>    
                    @endif
                    <input type="hidden" name="updateVerificationsId" id="updateVerificationsId">
                    <input type="hidden" name="updateVerificationsTypeId" value="{{ $verificationType -> id }}">
					@if($verificationType -> id != 6 && $verificationType -> id != 7 && $verificationType -> id != 8 && $verificationType -> id != 12 && $verificationType -> id != 13)
                        <div class="form-group">
                            <select class="custom-select" name="updateVerificationsProblemId" id="updateVerificationsProblemSelect">
                                @foreach ($solFunctions as $item)
                                    <option value="{{ $item -> problem -> id }}">Problem: {{ $item -> problem -> name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="updateVerificationsSolutionId" id="updateVerificationsSolutionSelect">
                                
                            </select>
                            @error('updateVerificationsSolutionId')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="updateVerificationsSolFunctionId" id="updateVerificationsSolFunctionSelect">
                                
                            </select>
                            @error('updateVerificationsSolFunctionId')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="updateVerificationsTypeId">
                                <option value="{{ $verificationType -> id }}" data-key="{{ $verificationType -> key }}" data-val="{{ $verificationType -> val }}">{{ $verificationType -> name }}</option>
                            </select>
                        </div>
                    @elseif($verificationType -> id != 6 && $verificationType -> id != 7  && $verificationType -> id != 13)
                         <div class="form-group">
                            <select class="custom-select" name="updateVerificationsSolutionId" id="updateVerificationsSolutionSelect">
                                @foreach ($solFunctions as $item)
                                    <option value="{{ $item -> solution -> id }}">Solution: {{ $item -> solution -> name }}</option>                                    
                                @endforeach
                            </select>
                            @error('updateVerificationsSolutionId')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                    @endif
                    
                    @if($verificationType -> id == 3 || $verificationType -> id == 6 || $verificationType -> id == 7 || $verificationType -> id == 8 || $verificationType -> id == 13)
                        <div class="form-group">
                            <input type="text" name="updateVerificationsKey" 
                            id="updateVerificationsKey" 
                            class="form-control 
                            @if($verificationType -> id == 6 || $verificationType -> id == 7)
                            datepickers
                            @endif" 
                            placeholder="{{ $verificationType -> key }}">
                            @error('updateVerificationsKey')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                       
                        @if ($verificationType -> id == 3 || $verificationType -> id == 6)
                            <div class="form-group">
                                @if($verificationType -> id == 6)
                                    <select class="custom-select" name="updateVerificationsVal" id="updateVerificationsVal">
                                        <option value="0">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                @elseif($verificationType -> id != 7)
                                    <input type="text" name="updateVerificationsVal" id="updateVerificationsVal" class="form-control" placeholder="{{ $verificationType -> val }}" required>
                                @endif
                                @error('updateVerificationsVal')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <script>
                                        $(document).ready(function(){
                                            $("#updateVerificationsModal").modal("show");
                                        })
                                    </script>
                                @enderror
                            </div>
                        @elseif($verificationType -> id == 7)
                            <div class="form-group">
                                <select class="custom-select" name="updateVerificationsProblemId" id="updateVerificationsProblemSelect">
                                    @foreach ($solFunctions as $item)
                                        <option value="{{ $item -> problem -> id }}">Problem: {{ $item -> problem -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif($verificationType -> id == 8)
                            <div class="form-group">
                                <input type="text" name="updateVerificationsVal" id="updateVerificationsVal" class="form-control" placeholder="{{ $verificationType -> val }}" required>
                                @error('updateVerificationsVal')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                            </div>
                        @elseif($verificationType -> id == 13)
                            <div class="form-group">
                                <select class="custom-select" name="updateVerificationsVal" id="updateVerificationsVal">
                                    <option value="0">Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        @endif
                    @endif
                    @if($verificationType -> id == 12)
                        <div class="form-group">
                            <textarea class="form-control" name="updateVerificationsKey" id="updateVerificationsKey" placeholder="{{ $verificationType -> key }}"></textarea>
                            @error('updateVerificationsKey')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationsModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div> 
                    @endif
                    @if($verificationType -> id != 6 && $verificationType -> id != 7 && $verificationType -> id != 12 && $verificationType -> id != 13)
                        <div class="form-group">
                            <select class="custom-select" name="updateVerificationsType" id="updateVerificationsTypeSelect">
                                @foreach ($verificationType -> verification_type_text as $item)
                                    <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("updateVerification") }}" class="modal fade" id="updateVerificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Verification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="updateVerificationId" name="updateVerificationId">
                    <div class="form-group">
                        <input type="text" name="updateVerificationKey" id="updateVerificationKey" class="form-control"  required>
                        @error('updateVerificationKey')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#updateVerificationModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="updateVerificationVal" id="updateVerificationVal" class="form-control" required>
                        @error('updateVerificationVal')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <script>
                                $(document).ready(function(){
                                    $("#updateVerificationModal").modal("show");
                                })
                            </script>
                        @enderror
                    </div>
					@if($verificationType -> id == 2)
                        <div class="form-group">
                            <input type="text" name="updateVerificationVals" id="updateVerificationVals" class="form-control" required>
                            @error('updateVerificationVals')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <script>
                                    $(document).ready(function(){
                                        $("#updateVerificationModal").modal("show");
                                    })
                                </script>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ url("updateVerificationType") }}" id="updateVerificationTypeModal">
        @csrf
        <input type="hidden" name="updateVerificationTypeId" id="updateVerificationTypeId">
        <input type="hidden" name="updateVerificationTypeKey" id="updateVerificationTypeKey">
        <input type="hidden" name="updateVerificationTypeVal" id="updateVerificationTypeVal">
    </form>

    <form method="POST" action="{{ url("createVerificationByPlus") }}" id="createVerificationByPlusForm">
        @csrf
        <input type="hidden" id="createVerificationByPlusSolFunctionId" name="createVerificationByPlusSolFunctionId">
        <input type="hidden" id="createVerificationByPlusVerificationTypeId" name="createVerificationByPlusVerificationTypeId">
        <input type="hidden" id="createVerificationByPlusKey" name="createVerificationByPlusKey">
        <input type="hidden" id="createVerificationByPlusVal" name="createVerificationByPlusVal">
        <input type="hidden" id="createVerificationByPlusVals" name="createVerificationByPlusVals">
        <input type="hidden" name="createVerificationByPlusType" value="{{ $verificationType -> id }}">
    </form>

    <form method="POST" action="{{ url("delVerifications") }}" id="delVerificationsModal">
        @csrf
        <input type="hidden" name="solution_function_id" id="delVerificationsId">
    </form>

    <form method="POST" action="{{ url("delVerification") }}" id="delVerificationModal">
        @csrf
        <input type="hidden" name="id" id="delVerificationId">
    </form>

    <script>
        $(document).ready(function(){
            @if($verificationType -> id == 13)
                $("#communicationFlowMixtureContainer").css("height", $("#communicationFlowPeopleContainer").css("height"));
                $("#communicationFlowMixtureContainer div").css("display", "table-cell");
                $("#communicationFlowMixtureContainer div").css("vertical-align", "middle");
            @endif
            $(".datepickers").datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yyyy-mm-dd',
            });

            $("#createVerificationBtn").click(function(){
                @if(count($verificationTypes) > 0)
                    $("#createVerificationModal").modal("show");                
                @else
                    swal({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'There is no verification type. Please wait till admin create verification type first',
                        buttons: true
                    });
                @endif
            });

            $(".createVerificationBtn").click(function(){
                var id = $(this).data("id");
                var solution_function_id = $(this).data("function");
                var verification_type = $(this).data("type");
                const d = new Date();
                var ms = d.getTime();
                @if($verificationType -> id == 1)
                    var content='<tr style="text-align: center; align-content: center" id="verificationTR' + ms + '">' +
                        '<td>' + 
                        '<div id="verificationKeyDiv' + ms + '" class="verificationKeyDiv" style="display: none"></div>' + 
                        '<input type="text" class="form-control input sm verificationKeyInput" id="verificationKeyInput' + ms + '" value="Word">' +
                        '</td>' +
                        '<td style="width: 15%">' +
                        'Point To<br>' +
                        '<img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">' +
                        '</td>' +
                        '<td>' +
                        '<div id="verificationValDiv' + ms + '" class="verificationValDiv" style="display: none"></div>' +
                        '<input type="text" class="form-control input sm verificationValInput" id="verificationValInput' + ms + '" value="Entity">' +
                        '</td>' +
                        '<td>' +
                        '<div class="btn-group pull-right">' +
                        '<button id="checkVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="createVerification(' + ms + ', ' + id + ', ' + solution_function_id + ', ' + verification_type + ');">' +
                        '<i class="icon-copy dw dw-check"></i>' +
                        '</button>' +
                        '<button id="cancelVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="cancelVerification(' + ms + ', 0);">' +
                        '<i class="icon-copy dw dw-cancel"></i>' +
                        '</button>' +
                        '<button id="editVerificationBtn' + ms + '" data-id="' + ms + '"  type="button" class="btn btn-sm btn-default" style="display: none" onclick="editVerification(' + ms + ');">' +
                        '<i class="icon-copy dw dw-edit-2"></i>' +
                        '</button>' +
                        '<button id="delVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" style="display: none" onclick="delVerification(' + ms + ', 0);">' +
                        '<i class="icon-copy dw dw-delete-3"></i>' +
                        '</button>' +
                        '</div></td></tr>';
                @elseif($verificationType -> id == 2)
                    var content='<tr style="text-align: center; align-content: center" id="verificationTR' + ms + '">' +
                        '<td>' + 
                        '<div id="verificationKeyDiv' + ms + '" class="verificationKeyDiv" style="display: none"></div>' + 
                        '<input type="text" class="form-control input sm verificationKeyInput" id="verificationKeyInput' + ms + '" value="Identified Information">' +
                        '</td>' +
                        '<td style="width: 15%">' +
                        '<br>' +
                        '<img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">' +
                        '</td>' +
                        '<td>' +
                        '<div id="verificationValDiv' + ms + '" class="verificationValDiv" style="display: none"></div>' +
                        '<input type="text" class="form-control input sm verificationValInput" id="verificationValInput' + ms + '" value="Given Information">' +
                        '</td>' +
                        '<td style="width: 15%">' +
                        'Point To<br>' +
                        '<img src="{{ asset("assets/img/arrow.png") }}" style="margin-top: -5px; width: 50%">' +
                        '</td>' +
                        '<td>' +
                        '<div id="verificationValsDiv' + ms + '" class="verificationValsDiv" style="display: none"></div>' +
                        '<input type="text" class="form-control input sm verificationValsInput" id="verificationValsInput' + ms + '" value="Entity">' +
                        '</td>' +
                        '<td>' +
                        '<div class="btn-group pull-right">' +
                        '<button id="checkVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="createVerification(' + ms + ', ' + id + ', ' + solution_function_id + ', ' + verification_type + ');">' +
                        '<i class="icon-copy dw dw-check"></i>' +
                        '</button>' +
                        '<button id="cancelVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" onclick="cancelVerification(' + ms + ', 0);">' +
                        '<i class="icon-copy dw dw-cancel"></i>' +
                        '</button>' +
                        '<button id="editVerificationBtn' + ms + '" data-id="' + ms + '"  type="button" class="btn btn-sm btn-default" style="display: none" onclick="editVerification(' + ms + ');">' +
                        '<i class="icon-copy dw dw-edit-2"></i>' +
                        '</button>' +
                        '<button id="delVerificationBtn' + ms + '" data-id="' + ms + '" type="button" class="btn btn-sm btn-default" style="display: none" onclick="delVerification(' + ms + ', 0);">' +
                        '<i class="icon-copy dw dw-delete-3"></i>' +
                        '</button>' +
                        '</div></td></tr>';
                @endif
                $("#verificationTBodyContainer" + id).prepend(content);
            });

            $("#createVerificationProblemSelect").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolutionSelect").html(response);
                    }
                });

                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolfunctionSelect").html(response);
                    }
                });
            });

            $("#createVerificationSolutionSelect").change(function(){
                var id = $(this).val();
 
                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerSolution",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#createVerificationSolfunctionSelect").html(response);
                    }
                });
            });

            $("#createVerificationSelect").change(function(){
                $("#createVerificationKey").attr("placeholder", $(this).find('option[value="' + $(this).val() + '"]').data("key"));
                $("#createVerificationVal").attr("placeholder", $(this).find('option[value="' + $(this).val() + '"]').data("val"));
            });

            $(".editVerificationTypeBtn").click(function(){
                $("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).val($("#verificationTypeKeyDiv" + $(this).data("item") + "_" + $(this).data("verification")).html());
                $("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).val($("#verificationTypeValDiv" + $(this).data("item") + "_" + $(this).data("verification")).html());
           
                $("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");
                $("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");

                $("#verificationTypeKeyDiv" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");
                $("#verificationTypeValDiv" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");

                $("#editVerificationTypeBtn" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "none");
                $("#checkVerificationTypeBtn" + $(this).data("item") + "_" + $(this).data("verification")).css("display", "block");
            });

            $(".checkVerificationTypeBtn").click(function(){
                var key = 0, val = 0;

                if($("#verificationTypeValInput" +  $(this).data("item") + "_" + $(this).data("verification")).val() == ""){
                    swal({
                    title: 'Warning',
                        text: 'Please insert Value.',
                        icon: 'warning',
                    });
                }else{
                    val = 1;
                }

                if($("#verificationTypeKeyInput" +  $(this).data("item") + "_" + $(this).data("verification")).val() == ""){
                    swal({
                    title: 'Warning',
                        text: 'Please insert Key.',
                        icon: 'warning',
                    });
                }else{
                    key = 1;
                }

                if(key == 1 && val == 1){
                    $("#updateVerificationTypeId").val($(this).data("verification"));
                    $("#updateVerificationTypeKey").val($("#verificationTypeKeyInput" + $(this).data("item") + "_" + $(this).data("verification")).val());
                    $("#updateVerificationTypeVal").val($("#verificationTypeValInput" + $(this).data("item") + "_" + $(this).data("verification")).val());
                    
                    $("#updateVerificationTypeModal").submit();   
                }
            });

            $(".editVerificationBtn").click(function(){
                $("#updateVerificationKey").attr("placeholder", $(this).data("keyname"));
                $("#updateVerificationVal").attr("placeholder", $(this).data("valname"));
               

                $("#updateVerificationId").val($(this).data("id"));
                $("#updateVerificationKey").val($(this).data("key"));
                $("#updateVerificationVal").val($(this).data("val"));

                @if($verificationType -> id == 2)
                    $("#updateVerificationVals").attr("placeholder", $(this).data("valsname"));
                    $("#updateVerificationVals").val($(this).data("vals"));  
                @endif
                $("#updateVerificationModal").modal("show");
            });

            $(".delVerificationBtn").click(function(){
                var id = $(this).data("id");
                swal({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Do you want to delete?',
                    buttons: true
                }).then(function(value) {
                    if(value.value === true) {
                        $("#delVerificationId").val(id);
                        $("#delVerificationModal").submit();
                    }
                });
            });

            $(".delVerificationsBtn").click(function(){
                var id = $(this).data("id");
                swal({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Do you want to delete?',
                    buttons: true
                }).then(function(value) {
                    if(value.value === true) {
                        $("#delVerificationsId").val(id);
                        $("#delVerificationsModal").submit();
                    }
                });
            })

            $(".updateVerificationsBtn").click(function(){       
                @if($verificationType -> id == 8)
                    $("#updateVerificationsId").val($(this).data("id"));
                    $("#updateVerificationsSolutionSelect").val($(this).data("solution"));
                    $("#updateVerificationsKey").val($(this).data("key"));  
                    $("#updateVerificationsVal").val($(this).data("val"));  
                @elseif($verificationType -> id == 6)
                    $("#updateVerificationsId").val($(this).data("id"));
                    $("#updateVerificationsKey").val($(this).data("key"));  
                    $("#updateVerificationsVal").val($(this).data("val"));  
                @elseif($verificationType -> id == 7)
                    $("#updateVerificationsId").val($(this).data("id"));
                    $("#updateVerificationsKey").val($(this).data("key"));  
                    $("#updateVerificationsProblemSelect").val($(this).data("problem")); 
                @elseif($verificationType -> id == 12)
                    $("#updateVerificationsKey").val($(this).data("key"));  
                    $("#updateVerificationsId").val($(this).data("id"));
                @else
                    var problem_id = $(this).data("problem");
                    var solution_id = $(this).data("solution");
                    var solution_function_id = $(this).data("function");

                    $("#updateVerificationsId").val($(this).data("id"));
                    $("#updateVerificationsProblemSelect").val($(this).data("problem"));

                    $.ajax({
                        method: "get",
                        url: "getSolutionPerProblem",
                        data: {
                            id: problem_id,
                        },
                        success: function(response){
                            $("#updateVerificationsSolutionSelect").html(response);
                            $("#updateVerificationsSolutionSelect").val(solution_id);
                        }
                    });

                    $.ajax({
                        method: "get",
                        url: "getSolFunctionPerSolution",
                        data: {
                            id: solution_id,
                        },
                        success: function(response){
                            $("#updateVerificationsSolFunctionSelect").html(response);
                            $("#updateVerificationsSolFunctionSelect").val(solution_function_id);
                        }
                    });
                @endif

                $("#updateVerificationsTypeSelect").val($(this).data("type"));

                @if($verificationType -> id == 3 || $verificationType -> id ==13)
                    if($(this).data("ftype") == 2){
                        $("#updateVerificationsFType").val("2");
                        $("#updateVerificationsFileType").css("display", "none");
                        $("#updateVerificationsLinkType").css("display", "block");
                        
                        $("#updateVerificationsFileRadio").attr("checked", false);
                        $("#updateVerificationsLinkRadio").attr("checked", true);

                        $("#updateVerificationsLinkFile").val($(this).data("file"));
                    }else{
                        $("#updateVerificationsFType").val("0");
                        $("#updateVerificationsFileType").css("display", "block");
                        $("#updateVerificationsLinkType").css("display", "none");

                        $("#updateVerificationsFileRadio").attr("checked", true);
                        $("#updateVerificationsLinkRadio").attr("checked", false);

                        if($(this).file != ""){
                            var file = $(this).data("file");
                            var drEvent = $('#updateVerificationsFileFile').dropify(
                            {
                                defaultFile: "/assets/verification/" + file
                            });
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = "/assets/verification/" + file;
                            drEvent.destroy();
                            drEvent.init();	
                        }
                        
                    }

                    $("#updateVerificationsId").val($(this).data("id"));
                    $("#updateVerificationsKey").val($(this).data("key"));  
                    $("#updateVerificationsVal").val($(this).data("val"));  
                @endif

                $("#updateVerificationsModal").modal("show");
            });

            $("#updateVerificationsProblemSelect").change(function(){
                var id = $(this).val();

                $.ajax({
                    method: "get",
                    url: "getSolutionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#updateVerificationsSolutionSelect").html(response);
                    }
                });

                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerProblem",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#updateVerificationsSolfunctionSelect").html(response);
                    }
                });
            });

            $("#updateVerificationsSolutionSelect").change(function(){
                var id = $(this).val();
 
                $.ajax({
                    method: "get",
                    url: "getSolFunctionPerSolution",
                    data: {
                        id: id,
                    },
                    success: function(response){
                        $("#updateVerificationsSolfunctionSelect").html(response);
                    }
                });
            });

            $(".createVerificationType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#createVerificationType").val("0");
					$("#createVerificationFileType").css("display", "block");
					$("#createVerificationLinkType").css("display", "none");
				}else if(type == 2){
					$("#createVerificationType").val("2");
					$("#createVerificationFileType").css("display", "none");
					$("#createVerificationLinkType").css("display", "block");
				}
			});

            $(".updateVerificationsFileType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#updateVerificationsFType").val("0");
					$("#updateVerificationsFileType").css("display", "block");
					$("#updateVerificationsLinkType").css("display", "none");
				}else if(type == 2){
					$("#updateVerificationsFType").val("2");
					$("#updateVerificationsFileType").css("display", "none");
					$("#updateVerificationsLinkType").css("display", "block");
				}
			});

            $(".dropify").dropify();

            $(".carousel").carousel();
        });

        function createVerification(ms, id, solution_function_id, verification_type){
            @if($verificationType -> i == 1)
                var key = 0, val = 0;

                if($("#verificationValInput" + ms).val() == ""){
                    swal({
                        title: 'Warning',
                        text: 'Please insert Actual Entity.',
                        icon: 'warning',
                    });
                }else{
                    val = 1;
                }

                if($("#verificationKeyInput" + ms).val() == ""){
                    swal({
                        title: 'Warning',
                        text: 'Please insert Word.',
                        icon: 'warning',
                    });
                }else{
                    key = 1;
                }

                if(key == 1 && val == 1){
                    $("#createVerificationByPlusSolFunctionId").val(solution_function_id);
                    $("#createVerificationByPlusVerificationTypeId").val(verification_type);
                    $("#createVerificationByPlusKey").val($("#verificationKeyInput" + ms).val());
                    $("#createVerificationByPlusVal").val($("#verificationValInput" + ms).val());

                    $("#createVerificationByPlusForm").submit();
                }
            @elseif($verificationType -> id == 2)
                var key = 0, val = 0, vals;

                if($("#verificationValsInput" + ms).val() == ""){
                    swal({
                        title: 'Warning',
                        text: 'Please insert Entity.',
                        icon: 'warning',
                    });
                }else{
                    vals = 1;
                }

                if($("#verificationValInput" + ms).val() == ""){
                    swal({
                        title: 'Warning',
                        text: 'Please insert Given Information.',
                        icon: 'warning',
                    });
                }else{
                    val = 1;
                }

                if($("#verificationKeyInput" + ms).val() == ""){
                    swal({
                        title: 'Warning',
                        text: 'Please insert Identified Information.',
                        icon: 'warning',
                    });
                }else{
                    key = 1;
                }

                if(key == 1 && val == 1 && vals == 1){
                    $("#createVerificationByPlusSolFunctionId").val(solution_function_id);
                    $("#createVerificationByPlusVerificationTypeId").val(verification_type);
                    $("#createVerificationByPlusKey").val($("#verificationKeyInput" + ms).val());
                    $("#createVerificationByPlusVal").val($("#verificationValInput" + ms).val());
                    $("#createVerificationByPlusVals").val($("#verificationValsInput" + ms).val());

                    $("#createVerificationByPlusForm").submit();
                }
            @endif
        }

        function cancelVerification(ms, state){
            if(state == 0){
                $("#verificationTR" + ms).remove();
            }
        }


    </script>
@endsection
