<div class="table-responsive">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">File</th>
	      <th scope="col">Name</th>
	      <th scope="col">Creator</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($problems as $problem)
          <tr>
            <td scope="row">
                @if($problem -> file == null)
                    <div class="fileFieldAdmin"></div>
                @else
                    @if($problem -> type == 0)
                        @if(strlen($problem -> file) < 15)
                            <img src="{{ asset("assets/problem/" . $problem -> file) }}" class="w-50 fileFieldAdmin">
                        @endif
                    @elseif($problem -> type == 1)
                        <video width="400" controls="controls" preload="metadata" class="w-50 fileFieldAdmin" preload="metadata">
                            <source src="{{ asset("assets/problem/" . $problem -> file) }}#t=0.1" type="video/mp4">
                        </video>
                    @elseif($problem -> type == 2)
                        <img src="{{ "http://img.youtube.com/vi/" . explode("=", explode("watch?", $problem -> file)[1])[1] . "/0.jpg" }}" class="w-50 fileFieldAdmin">
                    @endif
                @endif
            </td>
            <td scope="row">{{ $problem -> name }}</td>
            <td scope="row">
                <span class="user-icon">
                    <img class="mCS_img_loaded" src="{{ asset("assets/vendors/images/avatar/" . $problem -> user -> avatar ) }}">
                </span>
                <span class="ml-2">{{ $problem -> user -> name }}</span>
            </td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button
                    data-id="{{ $problem -> id }}"
                    data-type="{{ $problem -> type }}"
                    data-file="{{ $problem -> file }}"
                    data-name="{{ $problem -> name }}"
                     class="btn btn-outline-primary editProblemBtn">Edit</button>
                    <button type="button" class="btn btn-outline-primary delProblemBtn" data-id="{{ $problem -> id }}">Delete</button>
                </div>
            </td>
          </tr>
          @empty
              <tr style="text-align: center">
                  <td colspan="4">There is no data to show</td>
              </tr>
          @endforelse
	  </tbody>
	</table>
</div>

@if ($problems->hasPages())
    <ul class="pagination float-right" role="navigation">
        {{-- Previous Page Link --}}
        @if ($problems->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $problems->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        <?php
            $start = $problems->currentPage() - 2; // show 3 pagination links before current
            $end = $problems->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $problems->lastPage() ) $end = $problems->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $problems->url(1) }}">{{1}}</a>
            </li>
            @if($problems->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($problems->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $problems->url($i) }}">{{$i}}</a>
                </li>
            @endfor
        @if($end < $problems->lastPage())
            @if($problems->currentPage() + 3 != $problems->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $problems->url($problems->lastPage()) }}">{{$problems->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($problems->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $problems->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
        getAdminProblem(page, $("#search").val());
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
                $("#delAdminProblemId").val(id);
                $("#delAdminProblemModal").submit();
            }
        });
    })
</script>