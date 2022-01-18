@extends('layouts.messages')

@section('content')

    <aside id="panel">
        <div class='centered margin-bottom-4-em'>
            <img class='center image-cta' src="{{ '../assets/images/messaging.svg' }}" alt="Messaging">
            <h2 class='centered'>Discuss your boxes</h2>
            <p class='center'>Get in touch with the creators you're subscribed to and discuss your preferences.</p>
            <br><br>
            <a class='button' href='/messages/create'>Send message</a>
        </div>
    </aside>


@stop
