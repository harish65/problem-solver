<div class="table-responsive">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">File</th>
	      <th scope="col">Name</th>
	      <th scope="col">Problem</th>
	      <th scope="col">Solution Type</th>
	      <th scope="col">Creator</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($solutions as $solution)
          <tr>
            <td scope="row">
                @if($solution -> file == null)
                    <div class="fileFieldAdmin"></div>
                @else
                    @if($solution -> type == 0)
                        @if(strlen($solution -> file) < 15)
                            <img src="{{ asset("assets/solution/" . $solution -> file) }}" class="w-50 fileFieldAdmin">
                        @endif
                    @elseif($solution -> type == 1)
                        <video width="400" controls="controls" preload="metadata" class="w-50 fileFieldAdmin" preload="metadata">
                            <source src="{{ asset("assets/solution/" . $solution -> file) }}#t=0.1" type="video/mp4">
                        </video>
                    @elseif($solution -> type == 2)
                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $solution -> file)[1])[1] . "/0.jpg" }}" class="w-50 fileFieldAdmin">
                    @endif
                @endif
            </td>
            <td scope="row">{{ $solution -> name }}</td>
            <td scope="row">{{ $solution -> problem -> name }}</td>
            <td scope="row">{{ $solution -> solutionType -> name }}</td>
            <td scope="row">
                <span class="user-icon">
                    <img class="mCS_img_loaded" src="{{ asset("assets/vendors/images/avatar/" . $solution -> user -> avatar ) }}">
                </span>
                <span class="ml-2">{{ $solution -> user -> name }}</span>
            </td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button
                    data-id="{{ $solution -> id }}"
                    data-type="{{ $solution -> type }}"
                    data-file="{{ $solution -> file }}"
                    data-problem="{{ $solution -> problem_id }}"
                    data-stype="{{ $solution -> solution_type_id }}"
                    data-name="{{ $solution -> name }}"
                    data-state="{{ $solution -> state }}"
                     class="btn btn-outline-primary editsolutionBtn">Edit</button>
                    <button type="button" class="btn btn-outline-primary delsolutionBtn" data-id="{{ $solution -> id }}">Delete</button>
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

@if ($solutions->hasPages())
    <ul class="pagination float-right" role="navigation">
        {{-- Previous Page Link --}}
        @if ($solutions->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $solutions->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        <?php
            $start = $solutions->currentPage() - 2; // show 3 pagination links before current
            $end = $solutions->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $solutions->lastPage() ) $end = $solutions->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $solutions->url(1) }}">{{1}}</a>
            </li>
            @if($solutions->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($solutions->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $solutions->url($i) }}">{{$i}}</a>
                </li>
            @endfor
        @if($end < $solutions->lastPage())
            @if($solutions->currentPage() + 3 != $solutions->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $solutions->url($solutions->lastPage()) }}">{{$solutions->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($solutions->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $solutions->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif

<script>
    $(".pagination").on("click", "li a", function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getAdminSolution(page, $("#search").val());
    });

    $(".editsolutionBtn").click(function(){
        $("#updateSolutionId").val($(this).data("id"));
        $("#updateSolutionProblemId").val($(this).data("problem"));
        $("#updateSolutionTypeId").val($(this).data("stype"));
        $("#updateSolutionName").val($(this).data("name"));

        if($(this).data("state") == 0){
            $("#updateSolutionStateRadioTrue").attr("checked", false);
            $("#updateSolutionStateRadioFalse").attr("checked", true);
        }else{
            $("#updateSolutionStateRadioTrue").attr("checked", true);
            $("#updateSolutionStateRadioFalse").attr("checked", false);
        }

        if($(this).data("type") == 2){
            $("#updateSolutionType").val("2");
            $("#updateSolutionFileType").css("display", "none");
            $("#updateSolutionLinkType").css("display", "block");
            
            $("#updateSolutionFileRadio").attr("checked", false);
            $("#updateSolutionLinkRadio").attr("checked", true);

            $("#updateSolutionLinkFile").val($(this).data("file"));
        }else{
            $("#updateSolutionType").val("0");
            $("#updateSolutionFileType").css("display", "block");
            $("#updateSolutionLinkType").css("display", "none");

            $("#updateSolutionFileRadio").attr("checked", true);
            $("#updateSolutionLinkRadio").attr("checked", false);

            if($(this).file != ""){
                var file = $(this).data("file");
                var drEvent = $('#updateSolutionFileFile').dropify(
                {
                    defaultFile: "/assets/solution/" + file
                });
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = "/assets/solution/" + file;
                drEvent.destroy();
                drEvent.init();	
            }
            
        }

        $("#updateSolutionModal").modal("show");
    });

    $(".delsolutionBtn").click(function(){
        var id = $(this).data("id");

        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'Do you want to delete?',
            buttons: true
        }).then(function(value) {
            if(value.value === true) {
                $("#delAdminSolutionId").val(id);
                $("#delAdminSolutionModal").submit();
            }
        });
    });

    $(".dropify").dropify();

</script>