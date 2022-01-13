@extends('layouts.home')

@section('content')

    <main class="fadein">
        <section id="left-aside"></section>
        <aside id="panel">
            @include('includes.ship-nav')

            <div class="lift">
         
                @if ($outgoing > 0)
                <?php
                $box = DB::select('select created_at from boxes where user_id= ?', [$user->id]);
                ?>
               
                    <div class="centered margin-bottom-4-em">
                        <img class="image-ego-boost" src="../assets/images/fly.svg" alt="Soaring" />
                        <h2>You're flying high, {{ $user->given_name }}!</h2>
                        <p>You have &nbsp;<span class="highlighted">{{$outgoing}}</span> &nbsp;boxes to ship for month ending {{gmdate("F d", $box[0]->created_at + 2629743)}}. If ready, generate their shipping
                            labels. </p>
                        <br>
                        <a class="button" href="#" id="generate-labels">Generate labels</a>
                    </div>
                @else
                    <div class="alert">
                        <p class="material-icons">info</p>
                        <p>Sorry {{ $user->given_name }}, you don't have any outgoing boxes.</p>
                    </div>
                @endif

            </div>
        </aside>
        <section id="right-aside"></section>
    </main>

@endsection
