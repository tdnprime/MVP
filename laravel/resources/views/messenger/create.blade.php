@extends('layouts.messages')

@section('content')

    <aside id="panel">
        <h3> {{ $thread->participantsString(Auth::id()) }}</h3>
        <div class="messages-panel">


            <p class="message">{{ $thread->latestMessage->body }}
            </p>
    
           
            <form id="form-message-store" action="/messages/store" method="post">
                {{ csrf_field() }}

                <input type="hidden" class="form-control" name="subject" placeholder="Subject" value="0">

                <textarea id="textarea-wide" cols="40" rows="6" maxlegth="280" name="message"
                    placeholder="Type message (max 280 characters)" class="form-control">{{ old('message') }}</textarea>

                <input id='recipient' type="hidden" value="" name="recipients[]">

                <button type="submit" class="btn btn-primary form-control">Send</button>

            </form>
        </div>
    </aside>

@stop
