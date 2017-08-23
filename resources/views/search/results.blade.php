@extends('layout.main')

@section('header')
    <h2 class='ui header inverted'>Suche nach "{{request('query')}}"</h2>
    <h3 class="ui inverted header">({{$results['meta']['counter']}} Treffer)</h3>
    <script>setNav('searchicon')</script>
@endsection

@section('content')
    @foreach($results as $result)
        @if(View::exists('activity.preview.'.str_slug($activity->object_name, '-')))
            @include('activity.preview.'.str_slug($activity->object_name, '-'))
        @endif
    @endforeach
@endsection