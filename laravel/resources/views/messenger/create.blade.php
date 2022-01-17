@extends('layouts.messages')

@section('content')
    <h2>Create a new message</h2>
    <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">

            <!-- Message Form Input -->
            <div class="form-group">
                <textarea cols="80" rows="6" maxlegth="280" name="message" placeholder="Type message (max 280 characters)"
                    class="form-control">{{ old('message') }}</textarea>
            </div>

            @if ($users->count() > 0)
                <div class="checkbox hiden">
                    @foreach ($users as $user)
                        <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]"
                                value="{{ $user->id }}">{!! $user->name !!}</label>
                    @endforeach
                </div>
            @endif

            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Send</button>
            </div>
        </div>
    </form>
@stop
