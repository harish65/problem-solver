@extends('adult.layouts.adult')
@section('title', 'Adult | Verification')

@section('content')
<div class="container">

<div class="row">
    <form method="POST" enctype="multipart/form-data" id="verification-type-form">
        @csrf
        <div class="card mt-5 mb-5">
            <div class="card-header">
                <h4>Add Verification Type</h4>
            </div>

            <div class="card-body form-row">
                
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="updateVerificationTypeName"
                                placeholder="Name">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="page_main_title" class="form-control" id="page_main_title"
                                placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="banner" class="form-control" id="banner">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" name="explanation" id="explanation"
                                placeholder="Explanation Text....."></textarea>
                        </div>
                    </div>
                    <div class="long_box col-md-12">
                        
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="validation[question][]" placeholder="Add Question">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="long_add_more btn btn-success" name="Submit" value="Add more" />                                   
                                </div>
                            </div>
                           
                            <div class="row mt-3 long_box_inner">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="validation[question][option][]" placeholder="Add Option">
                                </div>
                                <div class="col-md-2">                                        
                                    <input type="submit" class="long_add_more_inner btn btn-success" name="Submit" value="+" />
                                </div>
                            </div>
                    </div>
                    <div class="col-md-10 mt-5 text-left">
                        <button class="btn btn-success" type="button" id="btnSave">Save</button>
                    </div>  
                
            </div>
        </div>
    </form>
</div>

</div>

@endsection
@section('scripts')

<script>
     $(document).ready(function () {
            // Add More Box
            var long_max_fields = 10000;         
            var lng = 1;
            var lng_counter = 0;
            var main_counter = 1;

            $(document).on("click", ".long_add_more", function (e) {
                e.preventDefault();
                if (lng < long_max_fields) {
                    lng++;
                    lng_counter++;
                    htmloutputlng = "";
                    if(lng_counter == 0){
                    htmloutputlng += `
                                    <div class="long_box col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="validation[question][]" placeholder="Add Question">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="submit" class="long_remove_button btn btn-danger" value="Remove"/>
                                                </div>
                                            </div>
                                            <div class="row mt-3 long_box_inner">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="validation[question][option][]" placeholder="Add Option">
                                                </div>
                                                <div class="col-md-2">                                        
                                                    <input type="submit" class="long_add_more_inner btn btn-success" name="Submit" value="+" />
                                                </div>
                                            
                                            </div>
                                    </div>
                                    <hr>
                                `;
                            }else{
                                htmloutputlng += `
                                    <div class="long_box col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="validation[question`+ lng_counter +`][]" placeholder="Add Question">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="submit" class="long_remove_button btn btn-danger" value="Remove"/>
                                                </div>
                                            </div>
                                            <div class="row mt-3 long_box_inner">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="validation[question`+ lng_counter +`][option][]" placeholder="Add Option">
                                                </div>
                                                <div class="col-md-2">                                        
                                                    <input type="submit" class="long_add_more_inner btn btn-success" name="Submit" value="+" />
                                                </div>
                                            
                                            </div>
                                    </div>
                                    <hr>
                                `;
                            }
                    $('.long_box:last').after(htmloutputlng);
                    
                }
            });
            $(document).on('click', '.long_remove_button' ,function (e) {
                
                e.preventDefault();
                $(this).closest("div.long_box").remove();
                lng--;
            });

            // Add More Box Inner
            var long_inner_max_fields = 10;
            var long_inner_wrapper = $(".long_box_inner");
            var long_inner_add_button = $(".long_add_more_inner");

            var lng_inner = 1;
            var lng_inner_counter = 0;
            var input =null;
            $(document).on("click", ".long_add_more_inner", function (e) {
                if(lng_counter > 0){
                     input = `<input type="text" class="form-control" name="validation[question`+ lng_counter +`][option][`+ lng_inner +`]" placeholder="Add Option">`
                }else{
                    input = `<input type="text" class="form-control" name="validation[question][option][]" placeholder="Add Option">`
                }
                e.preventDefault();
                    lng_inner++;
                    htmloutputlng_inner = "";


                    htmloutputlng_inner += `
                                    <div class="row mt-3 long_box_inner">
                                        <div class="col-md-10">
                                            `+ input +`
                                        </div>
                                        <div class="col-md-2">                                        
                                            <input type="submit" class="long_inner_remove_button btn btn-danger" value="-">
                                        </div>                               
                                    </div>  
                                `;
                    var html = $(this).closest('.long_box_inner').last().after(htmloutputlng_inner);

                
            });

            $(document).on("click", ".long_inner_remove_button", function (e) {
                e.preventDefault();
                $(this).closest("div.long_box_inner").remove();
                lng_inner--;
            });
        });
</script>

<script>
    $(document).on('click','#btnSave',function(e){
          e.preventDefault();
          var fd = new FormData($('#verification-type-form')[0]);
          $.ajaxSetup({
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
          });
          
          $.ajax({
              url: "{{route('adult.store-verification-type')}}",
              data: fd,
              processData: false,
              contentType: false,
              dataType: 'json',
              type: 'POST',
              beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
              },
              error: function (xhr, status, error) {
                  $('#btnSave').attr('disabled',false);
                  $('#btnSave').html('Submit');
                  $.each(xhr.responseJSON.data, function (key, item) {
                      toastr.error(item);
                  });
              },
              success: function (response){
                if(response.success == false)
                {
                    $('#btnSave').attr('disabled',false);
                    $('#btnSave').html('Login');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
                        toastr.error(value)
                    });
                } else {
                    toastr.success('Record saved successfully!');
                    window.location.href = "{{route('adult.varification')}}";
                }
              }
          });
      });
  </script>



@endsection