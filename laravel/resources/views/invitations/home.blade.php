@extends('layouts.home')
@section('title', 'Boxeon | Invitations')
@section('content')
    <main class="fadein">
        <section id="left-aside">
            <h2>Invitations</h2>
            <a class="message-create" href="/invitations/home" data-type-id="">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">insert_invitation</span>
                        Invitations
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="message-create" href="/invitations/rewards" data-type-id="">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">emoji_events</span>
                        Rewards
                    </div>
                    <div>
                    </div>
                </div>
            </a>
        </section>
        <aside id="panel">
            <div class='centered margin-bottom-4-em'>
                <img class='center image-cta' src="../assets/images/invite.svg" alt="Messaging">
                <h2 class='centered'>Your invitations</h2>
                <p class='center'>To earn your rewards, share the invitation link below with creators you know and ask them to click on it, sign in, and become a seller.</p>
                <br><br>
                <form>
                    <input class='centered center' type='text' value='https://boxeon.com/{{$user->id}}/accept'>
                </form>
            </div>
        </aside>
        <section id="right-aside"></section>
    </main>
@endsection