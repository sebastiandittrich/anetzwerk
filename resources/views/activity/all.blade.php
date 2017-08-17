@extends('layout.main')

<title>Aktivitäten - Asoziales Netzwerk</title>

@section('header')
    <h1 class='ui inverted header left aligned'>Aktivitäten</h1>
    <script>setNav('activities')</script>
    <script src='{{asset('js/quotes.js')}}'></script>
@endsection

@section('content')
    <div class='ui segment'>
    <h4 class="ui horizontal divider header">Optionen</h4>
        <div class='responsive-buttons'>
            <button class="ui fluid labeled icon button"><i class="filter icon"></i>Filtern</button><br class="responsive">
            <button class="ui fluid labeled icon button"><i class="sort icon"></i>Ordnen nach: Datum</button>
            

            @if(Auth::check())
                <br class="responsive"><a href="/activities/new" class="ui fluid blue labeled icon button"><i class="add icon"></i>Etwas hochladen</a>
            @endif
        </div>
        
    </div>
    @if(Auth::check())
        <div class="ui message">
            <i class="info icon"></i>
            Eigene Aktivitäten werden ausgeblendet
        </div>
    @endif
    <h4 class="ui horizontal divider header">Alle Aktivitäten</h4>
    <div class="ui feed">
        @foreach($activities as $activity)
            @include('activity.detail')
        @endforeach
    </div>
@endsection