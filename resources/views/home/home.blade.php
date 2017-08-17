@extends('layout.main')

<title>Home - Asoziales Netzwerk</title>

@section('header')
    <h1 class='ui inverted header'>Willkommen beim Asozialen Netzwerk.</h1>
    <script>setNav('home')</script>
    <script src='{{asset('js/quotes.js')}}'></script>

@endsection

@section('content')
<div class="ui container">
    <h4 class="ui horizontal divider header">Aktivitäten</h4>
    @foreach($activities as $activity)
            @include('activity.detail')
    @endforeach 
</div>
@endsection