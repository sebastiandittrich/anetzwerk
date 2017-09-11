@foreach($object->elements() as $element)
    @if(View::exists('activity.detailed.'.str_slug(get_class($element), '-')))
        @include('activity.detailed.'.str_slug(get_class($element), '-'), ['object' => $element])
    @endif
@endforeach