@foreach ($solutions as $item)
<option value="{{ $item -> id }}">Solution: {{ $item -> name }}</option>                                    
@endforeach

@if (count($solutions) == 0)
    <script>
        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'The problem you select has no solution yet. Please create solution first',
            buttons: true
        });
    </script>
@endif