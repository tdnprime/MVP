@extends('layouts.home')
@section('content')
    <main class="fadein">
        <section id="left-aside"></section>
        <aside id="panel">
            @if (session()->has('message'))
                <dialog class="alert">
                    <p class='centered'> {{ session()->get('message') }}</p>
                </dialog>
            @endif
            @if(isset($api))
            <p>Set API key</p>
            <form action='/entry/set' method='post'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type='text' name='key' value='' required placeholder="API Key">
                <input type='submit' class='clearbtn' value='Set'>
            </form><br><br>
            @endif

            <a id='new-window' class='primary-color underline' href='#' data-type-href='https://youtube.com/channel/{{ $entry[0]->channel_id }}/about'>{{ $entry[0]->channel_name }}</a>
            <form name='entry' method='post' action='/entry/save'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type='email' value='' required name='email' placeholder="Email">
                <input type='hidden' name='id' value='{{ $entry[0]->channel_id }}'>
                <input type='submit' value='Save'>

            </form>
            <form action='/entry/skip' method='post'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type='hidden' name='id' value='{{ $entry[0]->channel_id }}'>
                <input type='submit' class='clearbtn' value='Skip'>
            </form>
            <a class='primary-color underline' href='/entry/update/key'>Update Api Key</a>
        </aside>

        <section id="right-aside"></section>
    </main>
@endsection
