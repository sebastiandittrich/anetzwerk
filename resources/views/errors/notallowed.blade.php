@extends('layout.main')

<title>Home - Asoziales Netzwerk</title>

@section('header')
    <h2 class='ui header inverted left aligned'>Keine Berechtigung</h2>
    <script>setNav('home')</script>
@endsection

@section('content')

    <div class="ui segment">
        Um diese Seite zu besuchen hast du leider nicht die Berechtigung. Eventuell bist du nicht der Besitzer dieses Posts oder kein Administrator.
    </div>

@endsection