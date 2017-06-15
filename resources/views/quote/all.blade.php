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
        <div class="ui vertical buttons" class='option-buttons'>
            <button class="ui labeled icon button"><i class="filter icon"></i>Filtern</button>
            <button class="ui labeled icon button"><i class="sort icon"></i>Ordnen nach: Datum</button>
        </div>

        @if(Auth::check())
            <a href='/quotes/new' class="ui right floated labeled icon button"><i class="add icon"></i>Neues Zitat</a>
        @endif
        
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