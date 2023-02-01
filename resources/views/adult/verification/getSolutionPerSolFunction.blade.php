@foreach ($solutions as $item)
<option value="{{ $item -> id }}">Solution: {{ $item -> name }}</option>                                    
@endforeach
