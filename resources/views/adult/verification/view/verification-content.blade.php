<div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset("assets-new/verification_types/" . @$verificationType->banner)}}" alt="relationImage" />
                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                            <div class="principleRelation">
                                <div class="conditionBlock">
                                    <div class="blockProblem">
                                        <div class="projectBlock text-center">
                                            <h2>Problem</h2>
                                            <div class="projectList text-center">
                                                <div class="imgWrp">
                                                    <img class="mx-auto"
                                                        src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%"
                                                        height="128px">
                                                </div>
                                                <p class="redText" style="color:red">{{ $problem->name }}</p>
                                            </div>
                                            <div class="projectList">
                                                <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="long-arrow">
                                        <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                                        <!-- add arrow Image over here -->
                                        <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                                        <!-- add arrow Image over here -->
                                    </div>
                                    <div class="blockProblem">
                                        <div class="projectBlock text-center">
                                            <h2>Solution</h2>
                                            <div class="projectList text-center">
                                                <div class="imgWrp">
                                                    <img class="mx-auto"
                                                        src=" {{ asset('assets-new/solution/'.$solution->file)}}" width="100%"
                                                        height="128px">
                                                </div>
                                                <p class="redText" style="color:#00A14C">{{ $solution->name }}</p>
                                            </div>
                                            <div class="projectList">
                                                <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="long-arrow">
                                        <!-- <p style="position:relative; top:35px;left:25px;">through</p> -->
                                        <!-- add arrow Image over here -->
                                        <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                                        <!-- add arrow Image over here -->
                                    </div>
                                    <div class="blockProblem">
                                        <div class="projectBlock text-center">
                                            <h2>Verification</h2>
                                            <div class="projectList text-center">
                                                <div class="imgWrp">
                                                    <img class="mx-auto" src="{{ asset('assets-new/verifications/'.$verification->file)}}"
                                                        width="100%" height="128px">
                                                </div>
                                                <p class="redText"> {{ $verification->name }} </p>
                                            </div>
                                            <div class="projectList">
                                                <p class="date">{{ date('d/m/Y', strtotime($verification->created_at))}}</p>
                                                <ul>
                                                    <li> 
                                                        <a href="javaScript:Void(0)" class="editverBtn" data-name="{{ $verification->name }}" data-verification_type_text_id="{{ $verification->verification_type_text_id }}" data-type="{{ $verification->type }}"  data-id="{{ $verification->id }}" data-file="{{ $verification->file }}">
                                                            <img src="{{ asset('assets-new/images//editIcon.png') }}" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-id="1" href class="delverBtn" title="Delete">
                                                            <img src="{{ asset('assets-new/images/deleteIcon.png') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><img
                                                                src="{{ asset('assets-new/images/uploadIcon.png') }}"
                                                                alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="questionWrap">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                        tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                        nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                        Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                                    <div class="row">
                                       
                                            <div class="col">
                                                        <h2>Vacabulary</h2>
                                            </div>
                                            <div class="col text-end">
                                                   <button style="margin-top:20px;" type="button" class="btn btn-success add-new-btn"  >+ Add New</button>
                                            </div>
                                        

                                        <div class="entity">
                                            <table class="table slp-tbl text-center">
                                                <thead>
                                                    <th>Word</th>
                                                    <th>Actual Entity</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Wrod</td>
                                                        <td>Entity</td>
                                                        <td>
                                                            <a href="javaScript:Void(0)" class="editSolFunBtn">
                                                                <img src="{{ asset('assets-new/images/add-verification.png')}}"
                                                                    alt="">
                                                            </a>
                                                            <a href="javaScript:Void(0)" class="editSolFunBtn">
                                                                <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                            </a>
                                                            <a href="javaScript:Void(0)" class="editSolFunBtn">
                                                                <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                            </a>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <h2>Validation Question</h2>

                                    @php $pre = null; @endphp

                                    @foreach($validationQuestions as $key=>$Questions)
                                        @if($pre != $Questions->question || $pre == null)
                                        <h3>{{ $Questions->question }}</h3>
                                        @endif
                                        <ul>
                                            <li><input type="radio"  name="validation_{{ $key }}">  {{ $Questions->answer }}</li>
                                            
                                        </ul>
                                        @php $pre = $Questions->question; @endphp
                                    @endforeach
                                   
                                </div>
                            </div>
                <!-- End -->
               
            </div>