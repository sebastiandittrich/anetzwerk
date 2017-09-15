@foreach($object->elements() as $element)
    @if(View::exists('overview.'.str_slug(get_class($element), '-')) && $element != null)
        @include('overview.'.str_slug(get_class($element), '-'), ['object' => $element])
    @endif
@endforeach