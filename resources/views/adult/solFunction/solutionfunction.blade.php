@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container">
    <div class="row spl-row">
        <h4>Solution Fuction</h4>
    </div>
    <div class="row spl-row-second">
        <h4>TITLE FOR EXPLANTION</h4>
    </div>
    <div class="row banner">
        <img src="{{ asset('/assets-new/images/solution-function-banner.png') }}" width="666px" height="250px">
    </div>

    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit
        </p>
    </div>

@if(isset($solFunctions->id))
    <div class="row">
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                    <img class="mx-auto" src="http://127.0.0.1:8000/assets-new/problem/1677330282.png" width="300"
                        height="320">
                    <p class="redText">Roof problem</p>
                </div>
                <div class="projectList">
                    <p class="date">25/02/2023</p>
                    <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editProblemBtn" data-id="9" data-name="Roof problem"
                                data-type="0" data-file="1677330282.png" data-cat="3">
                                <img src="http://127.0.0.1:8000/assets-new/images/editIcon.png" alt="">
                            </a>
                        </li>
                        <li><a data-id="9" class="delProblemBtn" title="Delete"><img
                                    src="http://127.0.0.1:8000/assets-new/images/deleteIcon.png" alt=""></a></li>
                        <li><a href="#"><img src="http://127.0.0.1:8000/assets-new/images/uploadIcon.png" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                    <img class="mx-auto" src="http://127.0.0.1:8000/assets-new/problem/1677330282.png" width="300"
                        height="320">
                    <p class="redText">Roof problem</p>
                </div>
                <div class="projectList">
                    <p class="date">25/02/2023</p>
                    <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editProblemBtn" data-id="9" data-name="Roof problem"
                                data-type="0" data-file="1677330282.png" data-cat="3">
                                <img src="http://127.0.0.1:8000/assets-new/images/editIcon.png" alt="">
                            </a>
                        </li>
                        <li><a data-id="9" class="delProblemBtn" title="Delete"><img src="http://127.0.0.1:8000/assets-new/images/deleteIcon.png" alt=""></a></li>
                        <li><a href="#"><img src="http://127.0.0.1:8000/assets-new/images/uploadIcon.png" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                    <img class="mx-auto" src="http://127.0.0.1:8000/assets-new/problem/1677330282.png" width="300"
                        height="320">
                    <p class="redText">Roof problem</p>
                </div>
                <div class="projectList">
                    <p class="date">25/02/2023</p>
                    <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editProblemBtn" data-id="9" data-name="Roof problem"
                                data-type="0" data-file="1677330282.png" data-cat="3">
                                <img src="http://127.0.0.1:8000/assets-new/images/editIcon.png" alt="">
                            </a>
                        </li>
                        <li><a data-id="9" class="delProblemBtn" title="Delete"><img
                                    src="http://127.0.0.1:8000/assets-new/images/deleteIcon.png" alt=""></a></li>
                        <li><a href="#"><img src="http://127.0.0.1:8000/assets-new/images/uploadIcon.png" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit
        </p>
    </div>

    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Does the solution of the actual problem replace the actual problem?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">

                    <input type="radio" value="0" data-id="#" class="form-check-input validation"
                        name="optradio_firts">Yes, the solution of the actual problem replaces the actual problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="1" data-id="#"
                        name="optradio_firts">No, the solution of the actual problem does not replace the actual problem
                </label>
            </div>

        </div>
    </div>

    @else
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6 align-middle">
            <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">Add Solution Function</button>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="row-title">
            <h5>Problem and Solution Identification</h5>
        </div>
        <div class="row-table">
            <table class="table slp-tbl text-center">
                <thead>
                    <th>Problem</th>
                    <th>Solution</th>
                    <th>Solution Function</th>
                </thead>
                <tbody>

                    <tr>
                        <td style="color: red;">Problem</td>
                        <td style="color: #00A14C;">Solution</td>
                        <td style="color: #00A14C;">Solution Function</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@include('adult.solFunction.modal.add-sol-func')
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>


$(".dropify").dropify();

</script>
<script>
    $(".updateSolFunctionType").change(function(){
        var type = $(this).val();
        if(type == 0){
            $("#updateSolFunctionType").val("0");
            $("#updateSolFunctionFileType").css("display", "block");
            $("#updateSolFunctionLinkType").css("display", "none");
        }else if(type == 2){
            $("#updateSolFunctionType").val("2");
            $("#updateSolFunctionFileType").css("display", "none");
            $("#updateSolFunctionLinkType").css("display", "block");
        }
    });
</script>
@endsection