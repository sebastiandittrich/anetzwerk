@extends('layout.main')

@section('header')
    <h2 class='ui header inverted'>Suche nach "{{$meta['query']}}"</h2>
    <h3 class="ui inverted header">({{$meta['counter']}} Treffer)</h3>
    <script>setNav('searchicon')</script>
@endsection

@section('content')
    @if(count($results['user']))
        <h4 class="ui horizontal divider header">Benutzer</h4>
        <div class="ui segment">
            @foreach($results['user'] as $user)
                @include('user.preview', ['user' => $user])
            @endforeach
        </div>
    @endif
    @if(count($results['activities']))
        <h4 class="ui horizontal divider header">Aktivitäten</h4>
        @include('activity.manydetailed', ['activities' => $results['activities']])
    @endif
    {{--  @foreach($results as $typename => $result)
        <h4 class="ui horizontal divider header">{{trans_choice('model_names.'.$typename, 2)}}</h4>
        @foreach($result as $object)
                @include('overview.frame', ['object' => $object])
        @endforeach
    @endforeach  --}}
    @if(!$meta['counter'])
        <div class="ui center aligned red segment">
            <div class="ui center aligned icon header">
                <i class="red meh icon"></i>
                Wir haben leider nichts gefunden...
            </div>
            <p>Versuche es doch noch einmal mit einem anderen Suchbegriff!<br>Falls es dennoch nicht funktionieren sollte, warte einfach noch ein bisschen ab. Die Suchfunktion ist noch in der Entwicklung und es kann noch ein bisschen dauern, bis sie perfekt funktioniert.</p>
        </div>
    @endif
@endsection