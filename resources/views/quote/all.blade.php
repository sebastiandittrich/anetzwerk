@extends('layout.main')

@section('header')
    <script>setNav('quotes')</script>
    <script src='{{asset('js/quotes.js')}}'></script>
    <script>

    </script>
@endsection

@section('content')
    {{csrf_field()}}
    <div class='ui segment'>
        <h4 class="ui horizontal divider header">Optionen</h4>        
        <div class="responsive-buttons">
            <button class="ui fluid labeled icon button"><i class="filter icon"></i>Filtern</button><br class="responsive">
            <button class="ui fluid labeled icon button"><i class="sort icon"></i>Ordnen nach: Datum</button>

            @if(Auth::check())
                <br class="responsive"><a href='/quotes/new' class="ui fluid blue labeled icon button"><i class="add icon"></i>Neues Zitat</a>
            @endif
        </div>
        
    </div>
    <h4 class='ui horizontal divider header'>Alle Zitate</h4>

    <div class='ui grid'>
        @foreach($quotes as $quote)
            <div class="row">
                <div class='column'>
                    @include('layout.quoteoverview')
                </div>
            </div>
        @endforeach
    </div>

@endsection