@extends('layouts.messages')

@section('content')

<img class='center image-cta' src="{{'../assets/images/messaging.svg'}}" alt="Messaging">
<h2 class='centered'>Your messages</h2>
<p class='center'>Talk with your subscribers.</p>
<br><br>
<a class='button' href='/direct/create'>Send message</a>

@stop
