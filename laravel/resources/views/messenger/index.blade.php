@extends('layouts.messages')

@section('content')

    <aside id="panel">
        <div class='centered margin-bottom-4-em'>

            <img class='center image-cta' src="{{ '../assets/images/messaging.svg' }}" alt="Messaging">
            <h2 class='centered'>Your messages</h2>
            <p class='center'>Talk with creators you're subscribed to and discuss preferences.</p>
            <br><br>
            <a class='button' href='/messages/create'>Send message</a>
        </div>
    </aside>


@stop
