@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ChatHolla
                    <span class="badge pull-right">@{{ usersInRoom.length }}</span>
                </div>
                <div class="panel-body">
                    <chat-log :messages="messages"></chat-log>
                    <chat-composer @messagesent="addMessage" user-name="{{ Auth::user()->name }}"></chat-composer>
                </div>
            </div>
        </div>
    </div>
@endsection