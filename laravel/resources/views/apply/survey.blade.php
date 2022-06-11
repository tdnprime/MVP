@extends('layouts.home')
@section('title', 'Boxeon .com User Survey')
@section('content')
    <main>
        <section id="left-aside"></section>
        @if (session()->has('message'))
            <dialog class="alert">
                <p class='centered'> {{ session()->get('message') }}</p>
            </dialog>
        @endif
        <aside id="panel">
            <div id="module">
                <span></span>
                <div class="masthead-forms">
                    <div class="row">
                        <div class="col-75">
                            <h2 id='apply' href='#apply'>
                                @php
                                    if (isset($email)) {
                                        echo 'Finish Your Enrollment';
                                    } else {
                                        echo 'Be the first to know when we launch. Join Our Waiting List!';
                                    }
                                @endphp
                            </h2>

                        </div>
                    </div>
                    <form id='form-partner-apply' action="/apply/survey" method="post">
                        @csrf
                        @php
                            if (!isset($email)) {
                                echo "<fieldset><p>Please enter your email address</p><input required type='email' name='email' placeHolder='Your primary email'/> </fieldset><br>";
                            }
                        @endphp



                        <fieldset>
                            <p>What African food products are you having issues finding in your area?
                            </p>
                            <div class="row">
                                <div class="col-75">
                                    <textarea required name="message" placeholder="List products"></textarea>

                                    @if(isset($email))
                                 
                                            <input name="email" type="hidden" value="{{ $email ?? ""}}" />

                                            @endif
                                        
                    

                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-75">
                                <input id="survey" type='submit' value='SUBMIT'>
                            </div>
                        </div>
                    </form>
                </div>
        </aside>
        <section id="right-aside"></section>
    </main>
@endsection
