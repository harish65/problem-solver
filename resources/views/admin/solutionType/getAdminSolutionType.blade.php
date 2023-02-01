<div class="table-responsive">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Name</th>
	      <th scope="col">Creator Photo</th>
	      <th scope="col">Creator Name</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($solutions as $solution)
          <tr>
            <td scope="row">{{ $solution -> name }}</td>
            <td scope="row">
                <span class="user-icon">
                    <img class="mCS_img_loaded" src="{{ asset("assets/vendors/images/avatar/" . $solution -> user -> avatar ) }}">
                </span>
            </td>
            <td scope="row">{{ $solution -> user -> name }}</td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button
                    data-id="{{ $solution -> id }}"
                    data-name="{{ $solution -> name }}"
                     class="btn btn-outline-primary editSolutionTypeBtn">Edit</button>
                    <button type="button" class="btn btn-outline-primary delSolutionTypeBtn" data-id="{{ $solution -> id }}">Delete</button>
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
        getAdminSolutionType(page, $("#search").val());
    });

    $(".editSolutionTypeBtn").click(function(){
        $("#updateSolutionTypeId").val($(this).data("id"));
        $("#updateSolutionTypeName").val($(this).data("name"));

        $("#updateAdminSolutionTypeModal").modal("show");
    });

    $(".delSolutionTypeBtn").click(function(){
        var id = $(this).data("id");

        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'Do you want to delete?',
            buttons: true
        }).then(function(value) {
            if(value.value === true) {
                $("#delAdminSolutionTypeId").val(id);
                $("#delAdminSolutionTypeModal").submit();
            }
        });
    })
</script>