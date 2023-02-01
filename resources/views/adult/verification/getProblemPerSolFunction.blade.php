@foreach ($problems as $item)
<option value="{{ $item -> id }}">Problem: {{ $item -> name }}</option>                                    
@endforeach
