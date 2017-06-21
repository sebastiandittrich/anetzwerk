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
                <div class="event">
                    <div class="label">
                        <i class="circular blue user icon"></i>
                    </div>
                    <div class="content">
                        <div class="summary">
                            <a href="/users/{{$activity->user->id}}" class="user">{{$activity->user->username}}</a>
                            @lang('activities.'.$activity->object_name.'.'.$activity->action)
                            <i class=" 
                                @if($activity->action == 'delete')
                                    red erase
                                @elseif($activity->action == 'create')
                                    blue add
                                @elseif($activity->action == 'update')
                                    orange refresh
                                @endif
                            icon corner"></i>
                            <div class="date">{{$activity->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="extra text">
                                @if($activity->action != 'delete')
                                    @if($activity->object_name == 'App\\Post')
                                        @include('activity.post')
                                    @elseif($activity->object_name == 'App\\Quote')
                                        @include('activity.quote')
                                    @endif
                                @endif
                            </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection