@extends('layouts.home')

@section('content')

    <main class="fadein">
        <section id="left-aside"></section>
        @include('includes.ship-nav')
        <div id="incoming-stream">
            <div class="alert">
                <p class="material-icons">info</p>
                <p>You don't have any new subscriptions.</p>
            </div>
        </div>
        </aside><!-- THIS WAS OPENED ON LINE 5 !-->
        <section id="right-aside"></section>
    </main>


@endsection
