@extends('layout.main')

@section('header')
    <h2 class='ui header inverted'>Suche nach "{{request('query')}}"</h2>
    <h3 class="ui inverted header">({{count($results)}} Treffer)</h3>
    <script>setNav('searchicon')</script>
@endsection

@section('content')
    @include('activity.manydetailed', ['activities' => $results])
    @if(!count($results))
        <div class="ui center aligned red segment">
            <div class="ui center aligned icon header">
                <i class="red meh icon"></i>
                Wir haben leider nichts gefunden...
            </div>
            <p>Versuche es doch noch einmal mit einem anderen Suchbegriff!<br>Falls es dennoch nicht funktionieren sollte, warte einfach noch ein bisschen ab. Die Suchfunktion ist noch in der Entwicklung und es kann noch ein bisschen dauern, bis sie perfekt funktioniert.</p>
        </div>
    @endif
@endsection