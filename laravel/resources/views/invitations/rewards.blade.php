@extends('layouts.home')
@section('title', 'Boxeon | Rewards')
@section('content')
    <main class="fadein">
        <section id="left-aside">
            <h2>Invitations</h2>
            <a class="anchor-sub-menu clearbtn" href="/invitations/home">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">insert_invitation</span>
                        Send
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="anchor-sub-menu clearbtn" href="/invitations/rewards">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">money_off</span>
                        Rewards
                    </div>
                    <div>
                    </div>
                </div>
            </a>
        </section>
        <aside id="panel">
            <div class='centered margin-bottom-4-em'>
                <img class='center image-cta' src="../assets/images/discount.svg" alt="Messaging">
                <h2 class='centered'>Your Rewards</h2>
                <p class='center'>You don't have any rewards to show. Get started by sharing the invitation link below with creators. Otherwise, please check back later.</p>
                <br><br>
                <form>
                    <input class='centered center' type='text' value='https://boxeon.com/{{$user->id}}/accept'>
                </form>
            </div>
        </aside>
        <section id="right-aside"></section>
    </main>
@endsection
