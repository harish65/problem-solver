<div class="table-responsive">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Verification Type</th>
	      <th scope="col">Verification Type Text</th>
	      <th scope="col">Creator Name</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($types as $type)
          <tr>
            <td scope="row">{{ $type -> verificationType -> name }}</td>
            <td scope="row">{{ $type -> name }}</td>
            <td scope="row">{{ $type -> user -> name }}</td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button
                    data-id="{{ $type -> id }}"
                    data-type="{{ $type -> verificationType -> name }}"
                    data-name="{{ $type -> name }}"
                     class="btn btn-outline-primary editVerificationTypeTextBtn">Edit</button>
                    <button type="button" class="btn btn-outline-primary delVerificationTypeTextBtn" data-id="{{ $type -> id }}">Delete</button>
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

@if ($types->hasPages())
    <ul class="pagination float-right" role="navigation">
        {{-- Previous Page Link --}}
        @if ($types->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $types->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        <?php
            $start = $types->currentPage() - 2; // show 3 pagination links before current
            $end = $types->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $types->lastPage() ) $end = $types->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $types->url(1) }}">{{1}}</a>
            </li>
            @if($types->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($types->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $types->url($i) }}">{{$i}}</a>
                </li>
            @endfor
        @if($end < $types->lastPage())
            @if($types->currentPage() + 3 != $types->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $types->url($types->lastPage()) }}">{{$types->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($types->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $types->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
        getAdminVerificationTypeText(page, $("#search").val());
    });

    $(".editVerificationTypeTextBtn").click(function(){
        $("#updateVerificationTypeTextId").val($(this).data("id"));
        $("#updateVerificationTypeTextVerificationTypeId").val($(this).data("type"));
        $("#updateVerificationTypeTextName").val($(this).data("name"));

        $("#updateAdminVerificationTypeTextModal").modal("show");
    });

    $(".delVerificationTypeTextBtn").click(function(){
        var id = $(this).data("id");

        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'Do you want to delete?',
            buttons: true
        }).then(function(value) {
            if(value.value === true) {
                $("#delAdminVerificationTypeTextId").val(id);
                $("#delAdminVerificationTypeTextModal").submit();
            }
        });
    })
</script>