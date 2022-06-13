@extends('layouts.index')
@section('content')

    <div id="masthead">

        <aside class="centered asides call-out"><br>
            <img id="move-down" class="center" src="../assets/images/logo.png" alt="BOXEON" />
            <h2 id="headline_h1" class="font-size-3-em">Get 16 Free foods + 3 Surprise Gifts</h2>
            <p class="centered center font-1-5-em">Enjoy authentic African foods from home. We'll send you, your choice of foods at a monthly schedule convinient to you.</p><br>
            <a href="/apply/survey" class="button uppercase">Personalize Your Box</a>
        </aside>
        <br><br>
        <section class="wide section padding-top-6-em">
            <h2 class='centered center w600 margin-bottom-0'>Be first to know when we launch. Join our waiting list.</h2>
            <div class="new-section-inner-grid margin-bottom-2-em">
                <span class="hide"></span>
                <div class="w600">
                    <form id="mailing-list-form" action="/pmf/email" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-75 two-col-grid">
                                <input required type="email" placeholder="Primary email" name="email">
                                <input type='submit' value="JOIN NOW">
                            </div>
                        </div>

                    </form>
                </div>
                <span class="hide"></span>
            </div>
        </section>
    </div>
    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>

        </main>

    </div>
 
