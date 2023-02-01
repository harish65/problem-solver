@foreach ($solFunctions as $item)
<option value="{{ $item -> id }}">Solution Function: {{ $item -> name }}</option>                                    
@endforeach

@if (count($solFunctions) == 0)
    <script>
        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'The problem you select has no solution function yet. Please create solution function first',
            buttons: true
        });
    </script>
@endif