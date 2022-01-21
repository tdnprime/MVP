@extends('layouts.home')
@section('title', 'Boxeon | Commission')
@section('content')
<main class="fadein">
    <section id="left-aside">
        <h2>Commission</h2>
        <a class="message-create" href="/home/subscribers" data-type-id="">
            <div class='recipients-grid'>
                <div class='position-relative'><span class="material-icons">people_alt</span>
                    Subscribers
                </div>
                <div>
                </div>
            </div>
        </a>
        <a class="message-create" href="/home/subscriptions" data-type-id="">
            <div class='recipients-grid'>
                <div class='position-relative'><span class="material-icons">inventory_2</span>
                    Subscriptions
                </div>
                <div>
                </div>
            </div>
        </a>
    </section>
    <aside id="panel">

    </aside>
    <section id="right-aside"></section>
</main>
@endsection