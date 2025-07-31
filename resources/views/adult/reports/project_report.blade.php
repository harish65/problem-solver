@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')

<div class="container mt-5 min-vh-100">
    
    <div class="row relationshipPage mainTitle">
        <div class="col-md-5">
            <div class="d-flex align-items-center">
                <h3>Projects</h3>
                    <select class="form-control form-select ml-1" id="projects">
                        <option selected="true" disabled="disabled">Select Project..</option>
                            @foreach($projects as $project)
                                <option  value='{{ Crypt::encrypt($project->id) }}'>{{ $project->name }}</option>
                            @endforeach
                    </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="d-flex align-items-center">
                <h3>Users</h3>
                <select class="form-control form-select ml-1" id="userSelect">
                    <option selected="true" disabled="disabled">Select User..</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mt-1">
                <button class="btn btn-success" id="getReport">View Report</button>
            </div>
        </div>
    </div>
<div class="mb-5" id="report_content"></div> 
</div>

@section('css')
<link href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet">
<style>
         
         h1, h2, h3 {
         color: #212529;
         margin: 0 0 10px;
         }
         h1 {
         border-bottom: 3px solid #198754;
         padding-bottom: 8px;
         }
         section {
         margin-bottom: 30px;
         }
         dl {
         display: grid;
         grid-template-columns: max-content 1fr;
         gap: 6px 20px;
         }
         dt {
         font-weight: 600;
         }
         dd {
         margin: 0 0 12px 0;
         }
         ul {
         margin: 0 0 12px 20px;
         }
         .quiz {
         background: #f5f6fa;
         border-left: 5px solid #198754;
         padding: 15px;
         border-radius: 4px;
         }
         table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 10px;
         margin-bottom: 20px;
         }
         th, td {
         border: 1px solid #198754;
         padding: 8px 12px;
         text-align: center;
         }
         th {
         background-color: #198754;
         color: #fff;
         }
         .answer {
            margin-top: 0px;
            margin-left: 0px;
            font-weight: normal;
            color: #333;
            margin-bottom: 10px;
        }
        .ml-20 {
            margin-left: 70px !important;
        }
        section.verification-section {
            border-top: 2px solid #198754;
            padding-top: 15px;
        }
          section.realtionship-section {
            border-top: 2px solid #198754;
            padding-top: 50px;
        }
         p {
            margin: 0 0 10px;
        }
         .answer .yes {
         color: #2e7d32; /* green */
         font-weight: bold;
         }
         .answer .no {
         color: #c62828; /* red */
         font-weight: bold;
         }
         /* Custom keyword colors */
         .danger {
         color: #d62828;
         font-weight: bold;
         }
         .success {
         color: #198754;
         font-weight: bold;
         }
         .form-select{
            border: 1px solid #00A14C;
            border-radius: 10px;
            height: 50px;
            width: 285px;
            width: 50%;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            color: #000000;
            font-family: 'Inter-Regular';
         }
      </style>
@endsection
@section('scripts')
<script>
$(document).on('change' , '#projects', function(e){

    e.preventDefault();
       var projectID =  $(this).val(); 
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.getProjectUsers')}}/" + projectID,
           type: 'GET',
           beforeSend: function(){
             $('#btnUpdate').attr('disabled',true);
             $('#btnUpdate').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#btnUpdate').attr('disabled',false);
               $('#btnUpdate').html('Save changes');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                 $('#btnUpdate').attr('disabled',false);
                 $('#btnUpdate').html('Save changes');
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                let select = $('#userSelect');
                    select.empty().append('<option selected="true" disabled="disabled">Select User..</option>');
                           data = response;
                    data.forEach(function(user) {
                        select.append(`<option value="${user.id}">${user.name}</option>`);
                    });
                //  toastr.success(response.message);
                //  location.reload() 
              }
           }
       });
})

$(document).on('click', '#getReport', function () {
    const projectId = $('#projects').val();
    const userId    = $('#userSelect').val();

    if (!projectId || !userId) {
        return toastr.error('Please select project and user to view report!');
    }
    const url = `{{ route('adult.getReport') }}?user_id=${encodeURIComponent(userId)}&project_id=${encodeURIComponent(projectId)}`;
    fetch(url, {
        headers: { 'Accept': 'application/json' ,"X-CSRF-TOKEN": "{{ csrf_token() }}"}
    })
    .then(r => r.json())
    .then(({ success, html, error }) => {
        success ? $('#report_content').html(html) : console.log(error);
    })
    .catch(err => console.log(err));
});
</script>
@endsection
@endsection