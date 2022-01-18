@extends('layouts.messages')

@section('content')
 
    <aside id="panel">
        <h2>Create new message</h2>
        <form id="form-message-store" action="/messages/store" method="post">
            {{ csrf_field() }}
            <div class="col-md-6">
                <!-- Subject Form Input -->
                <div class="form-group">
                 
                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                           value="{{ old('subject') }}">
                </div>
            <div class="col-md-6">

                <!-- Message Form Input -->
                <div class="form-group">
                    <textarea cols="80" rows="6" maxlegth="280" name="message"
                        placeholder="Type message (max 280 characters)"
                        class="form-control">{{ old('message') }}</textarea>
                </div>
                    
                    <input id='recipient' type="hidden" value="" name="recipients[]">
                     
                <!-- Submit Form Input -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Send</button>
                </div>
            </div>
        </form>
    </aside>
   
@stop
