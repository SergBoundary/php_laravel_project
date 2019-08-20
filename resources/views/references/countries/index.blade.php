@foreach($items as $item)
    <p>{{ $item->id }}. {{ $item->title }}</p>
@endforeach