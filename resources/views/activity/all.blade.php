@extends('layout.main')

<title>Aktivitäten - Asoziales Netzwerk</title>

@section('header')
    <h1 class='ui inverted header left aligned'>Aktivitäten</h1>
    <script>setNav('activities')</script>
@endsection

@section('content')
    @if(Auth::check())
        <div class="ui top attached message">
            <i class="info icon"></i>
            Eigene Aktivitäten werden ausgeblendet
        </div>
        <div class="ui bottom attached segment">
    @else
        <div class="ui segment">
    @endif
        <h4 class="ui horizontal divider header">Alle Aktivitäten</h4>
        <div class="ui feed">
            @foreach($activities as $activity)
                @include('activity.overview')
            @endforeach
        </div>
    </div>
@endsection