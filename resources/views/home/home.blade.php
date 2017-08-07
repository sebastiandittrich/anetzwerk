@extends('layout.main')

<title>Home - Asoziales Netzwerk</title>

@section('header')
    <h1 class='ui inverted header'>Willkommen beim Asozialen Netzwerk.</h1>
    <script>setNav('home')</script>
@endsection

@section('content')
    <div class="ui segment">
        <h4 class="ui horizontal divider header">Aktivitäten</h4>

        <div class="ui feed">
            @foreach($activities as $activity)
                @include('activity.overview')
            @endforeach
        </div>

    </div>
@endsection