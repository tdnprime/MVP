@extends('layouts.messages')

@section('content')

    <aside id="panel">

        

        <div class="messages-panel">

          <div id="header-messages"> <h3> Participant</h3></div>

            <p class="message">Message body</p>

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
