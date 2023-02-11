@extends('adult.layouts.adult')
@section('title', 'Problem | Adult')   
 
@section('content')
<div class="container">
      <div class="bannerSection">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="bannerLeftSide">
            <h1>Welcome to The Speak Logic</h1>
            <h1><span>Problem Solver</span></h1>
            <h5>Think logically to solve problems </h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bannerImg">
            <img src="{{ url('/') }}/assets-new/images/bannerImage0001.png" alt="Banner Image"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>List of Projects</h4>
        </div>
        <div class="col-md-6">
          
          <div class="text-end">
            <div class="form-check">
              <label class="form-check-label">  Grid View
                <input type="checkbox" class="form-check-input" value="">
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner section End -->
  <div class="projectlist">
    <div class="container">
      <div class="row">
        @foreach ($problems as $item)
        <div class="col">
        <div class="projectBlock text-center">
          <h2>Project 1</h2>
          <div class="projectList">
          <h3>Problem</h3>
          <p class="redText">Dirty Oil</p>
          </div>
          <div class="projectList">
          <h3>Solution</h3>
          <p class="greenText">New Oil</p>
          </div>
          <div class="projectList">
          <p class="date">12:12:2022</p>
          <ul>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/editIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/uploadIcon.png" alt=""/></a></li>
          </ul>
          </div>
        </div>
        </div>
		@endforeach
        <div class="col">
          <div class="projectBlock projectAdd text-center">
            <h2>Add New Project</h2>
            <div class="projectNew">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addprojectModal"><img src="{{ url('/') }}/assets-new/images/addIcon.png" alt=""/></button>
            </div>
         
          </div>
        </div>
      </div>
	  <!-- Row END -->
    </div>
  </div>
  <!-- Footer section start-->
  <footer class="footer">
    <div class="container">
      <div class="row">
      <div class="col-md-8">
        <div class="footerlogo">
          <a href="dashboard.html">
            <img src="{{ url('/') }}/assets-new/images/footerLogo.png" alt="Footer Logo"/>
          </a>
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim</p>
          <ul class="socialMedia">
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/facebookIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/twitterIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/youtubeIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/linkedinIcon.png" alt=""/></a></li>
            <li><a href="#"><img src="{{ url('/') }}/assets-new/images/instagramIcon.png" alt=""/></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="shareEnquries">
          <h4>Feel Free to share your quiries</h4>
          <ul class="feelFree">
            <li><img src="{{ url('/') }}/assets-new/images/phoneIcon.png" alt=""/><a href="tel:8003456398">+1 (800) 3456 – 398</a></li>
            <li><img src="{{ url('/') }}/assets-new/images/messageIcon.png" alt=""/><a href="info@psl.com" target="_blank">info@psl.com</a></li>
            <li><img src="{{ url('/') }}/assets-new/images/messageIcon.png" alt=""/><a href="mailto:support@gmail.com">support@gmail.com</a></li>
            <li><img src="{{ url('/') }}/assets-new/images/whatsapp.png" alt=""/><a href="tel:9123456578769">+912 3456578769</a></li>
          </ul>
        </div>
      </div>
    </div>
    </div>
    <div class="copyright">
      <div class="container">
        <div class="row">
        <div class="col-md-8">
          <p class="mb-0">@ 2022 All Right Reserved </p>
        </div>
        <div class="col-md-4">
          <p class="mb-0 ">Terms and Conditions </p>
        </div>
      </div>
      </div>
    </div>
  </footer>
    <!-- Footer section End-->
</div>

  <!-- The Modal -->
  <div class="modal fade addprojectModal" id="addprojectModal">
    <div class="modal-dialog">
      <div class="modal-content close-btn">
        <div class="crossBtn">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header -->

        
        <div class="modal-header">
          <h4 class="modal-title">Add new proaaject</h4>
          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="usr" placeholder="Name">
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Save</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- add project modal End -->
  <!-- delete modal start -->
  <div class="modal fade deleteModal" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="crossBtn">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header -->
        <div class="modal-header justify-content-center">
          <h4 class="modal-title">Are you sure to delete this ?</h4> 
        </div>        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-success" data-dismiss="modal">Delete</button>
          <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>
    </div>
  </div>
 
	<script>
		$(document).ready(function(){
			$("#createProblemBtn").click(function(){
				$("#createProblemModal").modal("show");
			});

			$(".createProblemType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#createProblemType").val("0");
					$("#createProblemFileType").css("display", "block");
					$("#createProblemLinkType").css("display", "none");
				}else if(type == 2){
					$("#createProblemType").val("2");
					$("#createProblemFileType").css("display", "none");
					$("#createProblemLinkType").css("display", "block");
				}
			});

			$(".updateProblemType").change(function(){
				var type = $(this).val();

				if(type == 0){
					$("#updateProblemType").val("0");
					$("#updateProblemFileType").css("display", "block");
					$("#updateProblemLinkType").css("display", "none");
				}else if(type == 2){
					$("#updateProblemType").val("2");
					$("#updateProblemFileType").css("display", "none");
					$("#updateProblemLinkType").css("display", "block");
				}
			});

			$(".editProblemBtn").click(function(){
				$("#updateProblemId").val($(this).data("id"));
				$("#updateProblemName").val($(this).data("name"));

				if($(this).data("type") == 2){
					$("#updateProblemType").val("2");
					$("#updateProblemFileType").css("display", "none");
					$("#updateProblemLinkType").css("display", "block");
					
					$("#updateProblemFileRadio").attr("checked", false);
					$("#updateProblemLinkRadio").attr("checked", true);

					$("#updateProblemLinkFile").val($(this).data("file"));
				}else{
					$("#updateProblemType").val("0");
					$("#updateProblemFileType").css("display", "block");
					$("#updateProblemLinkType").css("display", "none");

					$("#updateProblemFileRadio").attr("checked", true);
					$("#updateProblemLinkRadio").attr("checked", false);

					if($(this).file != ""){
						var file = $(this).data("file");
						var drEvent = $('#updateProblemFileFile').dropify(
						{
							defaultFile: "/assets/problem/" + file
						});
						drEvent = drEvent.data('dropify');
						drEvent.resetPreview();
						drEvent.clearElement();
						drEvent.settings.defaultFile = "/assets/problem/" + file;
						drEvent.destroy();
						drEvent.init();	
					}
					
				}

				$("#updateProblemModal").modal("show");
			});

			$(".delProblemBtn").click(function(){
				var id = $(this).data("id");

				swal({
					icon: 'warning',
					title: 'Warning',
					text: 'Do you want to delete?',
					buttons: true
				}).then(function(value) {
					if(value.value === true) {
						$("#delProblemId").val(id);
						$("#delProblemModal").submit();
					}
				});
			});

            $(".dropify").dropify();
		})
	</script>
@endsection


