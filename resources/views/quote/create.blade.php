@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Neues Falsch zugeordnetes Zitat</h2>
    <script>setNav('quotes');</script>
@endsection

@section('content')

    @include('layout.formerrors')

    <form action="/quotes/new" class="ui form" method='POST'>
        <div class="ui segment">
            <h4 class="ui horizontal divider header">Zitat</h4>
            <div class="field">
                <textarea name="quote" placeholder='Zitat eingeben'></textarea>
            </div>
        </div>
        <div class="ui segment">
            <h4 class="ui horizontal divider header">Autoren</h4>
            <div class="field">
                <div class="ui labeled input">
                    <div class="ui blue label">
                        Falscher (lustiger) Autor
                    </div>
                    <input name='fake_author' type="text">
                </div>
            </div>
            <div class="field">
                <div class="ui labeled input">
                    <div class="ui green label">
                        Echter Autor
                    </div>
                    <input name='real_author' type="text">
                </div>
            </div>
        </div>
        {{csrf_field()}}
        <input type="submit" class="ui positive left aligned button" value='Veröffentlichen'>
    </form>

@endsection
