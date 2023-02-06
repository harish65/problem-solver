<div class="table-responsive">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">File</th>
	      <th scope="col">Name</th>
	      <th scope="col">Problem</th>
	      <th scope="col">Solution</th>
	      <th scope="col">Creator</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($solFunctions as $solFunction)
          <tr>
            <td scope="row">
                @if($solFunction -> file == null)
                    <div class="fileFieldAdmin"></div>
                @else
                    @if($solFunction -> type == 0)
                        @if(strlen($solFunction -> file) < 15)
                            <img src="{{ asset("assets/solFunction/" . $solFunction -> file) }}" class="w-50 fileFieldAdmin">
                        @endif
                    @elseif($solFunction -> type == 1)
                        <video width="400" controls="controls" preload="metadata" class="w-50 fileFieldAdmin" preload="metadata">
                            <source src="{{ asset("assets/solFunction/" . $solFunction -> file) }}#t=0.1" type="video/mp4">
                        </video>
                    @elseif($solFunction -> type == 2)
                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solFunction -> file)[1])[1] . "/0.jpg" }}" class="w-50 fileFieldAdmin">
                    @endif
                @endif
            </td>
            <td scope="row">{{ $solFunction -> name }}</td>
            <td scope="row">{{ $solFunction -> problem -> name }}</td>
            <td scope="row">{{ $solFunction -> solution -> name }}</td>
            <td scope="row">
                <span class="user-icon">
                    <img class="mCS_img_loaded" src="{{ asset("assets/vendors/images/avatar/" . $solFunction -> user -> avatar ) }}">
                </span>
                <span class="ml-2">{{ $solFunction -> user -> name }}</span>
            </td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button
                    data-id="{{ $solFunction -> id }}"
                    data-type="{{ $solFunction -> type }}"
                    data-file="{{ $solFunction -> file }}"
                    data-problem="{{ $solFunction -> problem_id }}"
                    data-solution="{{ $solFunction -> solution_id }}"
                    data-name="{{ $solFunction -> name }}"
                     class="btn btn-outline-primary editsolFunctionBtn">Edit</button>
                    <button type="button" class="btn btn-outline-primary delsolFunctionBtn" data-id="{{ $solFunction -> id }}">Delete</button>
                </div>
            </td>
          </tr>
          @empty
              <tr style="text-align: center">
                  <td colspan="6">There is no data to show</td>
              </tr>
          @endforelse
	  </tbody>
	</table>
</div>

@if ($solFunctions->hasPages())
    <ul class="pagination float-right" role="navigation">
        {{-- Previous Page Link --}}
        @if ($solFunctions->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $solFunctions->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        <?php
            $start = $solFunctions->currentPage() - 2; // show 3 pagination links before current
            $end = $solFunctions->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $solFunctions->lastPage() ) $end = $solFunctions->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $solFunctions->url(1) }}">{{1}}</a>
            </li>
            @if($solFunctions->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($solFunctions->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $solFunctions->url($i) }}">{{$i}}</a>
                </li>
            @endfor
        @if($end < $solFunctions->lastPage())
            @if($solFunctions->currentPage() + 3 != $solFunctions->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $solFunctions->url($solFunctions->lastPage()) }}">{{$solFunctions->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($solFunctions->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $solFunctions->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
<script src = https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js></script>

<script>
    $(".pagination").on("click", "li a", function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getAdminsolFunction(page, $("#search").val());
    });

    $(".editsolFunctionBtn").click(function(){
        var id = $(this).data("id");
        var problem_id = $(this).data("problem");
        var solution_id = $(this).data("solution");
        var file = $(this).data("file");
        var name = $(this).data("name");

        $.ajax({
            method: "get",
            url: "getSolutionPerProblemForUpdate",
            data: {
                problem_id: problem_id,
                solution_id: solution_id,
            },
            success: function(response){

                $("#updateSolFunctionSolutionSelect").html(response);
                $("#updateSolFunctionId").val(id);
                $("#updateSolFunctionProblemId").val(problem_id);
                $("#updateSolFunctionName").val(name);

                if($(this).data("type") == 2){
                    $("#updateSolFunctionType").val("2");
                    $("#updateSolFunctionFileType").css("display", "none");
                    $("#updateSolFuncitonLinkType").css("display", "block");
                    
                    $("#updateSolFunctionFileRadio").attr("checked", false);
                    $("#updateSolFunctionLinkRadio").attr("checked", true);

                    $("#updateSolFunctionLinkFile").val(file);
                }else{
                    $("#updateSolFunctionType").val("0");
                    $("#updateSolFunctionFileType").css("display", "block");
                    $("#updateSolFunctionLinkType").css("display", "none");

                    $("#updateSolFunctionFileRadio").attr("checked", true);
                    $("#updateSolFunctionLinkRadio").attr("checked", false);

                    if(file != ""){
                        var drEvent = $('#updateSolFunctionFileFile').dropify(
                        {
                            defaultFile: "/assets/solFunction/" + file
                        });
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = "/assets/solFunction/" + file;
                        drEvent.destroy();
                        drEvent.init();	
                    }
                    
                }
                $(".dropify").dropify();

                $("#updateSolFunctionModal").modal("show");
            }
        });
    });

    $(".delSolFunctionBtn").click(function(){
        var id = $(this).data("id");

        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'Do you want to delete?',
            buttons: true
        }).then(function(value) {
            if(value.value === true) {
                $("#delSolFunctionId").val(id);
                $("#delSolFunctionModal").submit();
            }
        });
    });

</script>
