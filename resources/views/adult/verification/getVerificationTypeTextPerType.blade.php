@forelse ($texts as $item)
    <option value="{{ $item -> id }}">{{ $item -> name }}</option>
@empty
    
@endforelse