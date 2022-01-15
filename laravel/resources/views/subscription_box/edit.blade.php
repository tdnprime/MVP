@extends('layouts.box')

<div id='text-modes-switch' class='center'>
    <a href='/box/{{ $user->id }}/edit' class='text-edit-mode' class='centered'>
        <span class='material-icons'>preview</span> Preview</a>
    <a href='/box/{{ $user->id }}/edit' class='text-edit-mode' class='centered'>
        <span class='material-icons'>edit</span> Edit</a>
</div>

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if(is_null($box->box_weight))
        <div id="masthead" class="fadein">
            <div id="headline">
                <div>
                    <p class="text-heading-label">PLEASE HOLD</p>
                    <h1 class="ginormous">Your
                        subscription box isn't ready</h1>
                    <p id="pitch">If you started creating a box and chose to have us help you with product
                        curation, we will be
                        contacting you by email to help you finish creating your box. Please ensure our emails are not in
                        your spam folder.</p>
                    <a href="/contact" class="button">Contact us</a>
                    <a href="/box/create" class="button clearnbtn">Create box</a>
                </div>
            </div>
            <div id="masthead-image-construction"></div>
        </div>
    @else

        <div id='masthead'>
            <div id='box-masthead-inner-wrapper'>
                <section id='box-headline'>
                    <h1 class='darkblue'>
                        <span id='page-name' class='ginormous primary-color'>
                            {{ $user->given_name }} {{ $user->family_name }}</span>
                        <span class='break hack-br-1'><br></span> is shipping {{ $box->box_supply }} subscription boxes
                        <br>
                        to loyal fans
                    </h1>
                    <div>
                        <p><span class='highlighted darkblue'>${{ $box->price }}</span></span> per box
                            ({{ $box->shipping }})</p>
                        <p><span class='highlighted darkblue'>{{ $box->box_supply }}</span> boxes left in stock</p>
                        <span class='break hack-br-1'><br></span>
                        <div class='sub-btns'>
                            <a href='#' id='exe-sub' data-version='{{ $box->vid }}'
                                data-product='{{ $box->product_id }}' data-in-stock='{{ $box->in_stock }}'
                                data-total='{{ $box->price }}' data-shipping='{{ $box->shipping_cost }}'
                                data-id='{{ $box->user_id }}' data-url='auth/google' data-video-id='{{ $box->video }}'
                                data-plan-id='1' class='button'>Subscribe</a>
                            <a id='share-box' data-id='{{ $box->user_id }}' data-url='auth/google' href='#whatis'
                                class='button clearbtn'>
                                Learn more</a>
                        </div>
                </section>


                @if (!isset($box->video))
                    <div id='video-place-holder' class='centered'>
                        <h1 class='extra-large-font'>Embed Video</h1>
                        <div class='alert'>
                            <p class='material-icons'>info</p>
                            <p>To publish your page, embed a
                                <a href='#' class='one-em-font underline' id='video-instructions'>call to action YouTube
                                    video</a>.
                                You may complete this step at any time by signing in and clicking
                                on {{ $user->given_name }}'s
                                Boxeon.
                            </p>
                        </div>
                        <form action='/box/{{$user->id}}/edit' method='post' id='embed-form'>

                            @csrf
                            @method('POST')

                            <input required placeholder='Youtube video URL from browser' name='ytembed' type='url'>
                            <div class='buttonHolder'>
                                <input type='submit' value='Embed'>
                            </div>
                        </form>
                    </div>
            </div>

        @else

            <div id='masthead-video-wrapper'>
                <div class='playbtn-wrapper'>
                    <img id='image-youtube-thumb' src='{{ $box->video }}' />
                    {{--<img id='image-video-frame' src='http://127.0.0.1:8000/assets/images/frame.svg'/>--}}
                    <a href='#' id='play-video' data-version='{{ $box->vid }}' data-product='{{ $box->product_id }}'
                        data-in-stock='{{ $box->in_stock }}' data-total='{{ $box->price }}'
                        data-shipping='{{ $box->shipping_cost }}' data-id='{{ $box->user_id }}' data-url='auth/google'
                        data-video-id='{{ $box->video }}' data-plan-id='1'>
                        <img class='playbtn' src='../../assets/images/playbtn.png' alt='Play video' /></a>
                </div>
            </div>
        </div>
    @endif

    </div>
    <main class='fadein'>
        <a id='whatis' href='#whatis'></a>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Enjoy {{ $user->given_name }}</h1>
                    <p>
                        Subscribe to enjoy a curated experience that is uniquely {{ $user->given_name }}.</p>
                </div>
                <img src='../../assets/images/smith.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'> <img src='../../assets/images/freedom.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Give {{ $user->given_name }} freedom</h1>
                    <p>
                        {{ $user->given_name }}'s subscription box is the best way to support
                        {{ $user->given_name }}'s quest
                        for financial freedom to continue making the content you deserve.</p>
                </div>
            </div>
        </section>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Special offer</h1>
                    <p>
                        The first ten fans to <b>pre-order</b> will receive a 30-minute phone call with
                        {{ $user->given_name }}.
                        Pre-order sales end on <span class='primary-color'><b>{{ $box->preenddate }}</b></span>, and
                        boxes
                        will ship within
                        one month after
                        pre-order sales have ended.</p>
                </div>
                <img src='../../assets/images/fireworks.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'><img src='../../assets/images/sleep.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Rest secured</h1>
                    <p>
                        We conduct all financial transactions securely via PayPal. No PayPal account
                        is necessary to subscribe.</p>
                </div>
            </div>
        </section>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'> Save on shipping</h1>
                    <p>
                        Subscribe to {{ $user->given_name }}'s box today to secure {{ $box->discount }} shipping.</p>
                </div>
                <img src='../../assets/images/high-five.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'><img src='../../assets/images/makeitrain.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Money back guarantee</h1>
                    <p>We don't allow products of poor or medium quality on our platform.
                        They don't have to be expensive; they have to be of excellent quality.
                        We will return any fees collected from a customer who successfully proves
                        their seller violated this policy.</p>
                </div>
            </div>
        </section>
        <section class='section margin-bottom-10-em'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Cancel anytime</h1>
                    <p>
                        If you're unsatisfied with {{ $user->given_name }}'s box, you may unsubscribe
                        at anytime without hassle.</p>
                </div>
                <img src='../../assets/images/laptop.svg' alt='subscription box'>
            </div>
        </section>
        <h2 class='centered'>How it works</h2><br>
        <div id='how-it-works' class='three-col-grid'>

            <div> <img src='../../assets/images/computer.svg' alt='Box' />
                <h2>Watch video</h2>
            </div>
            <div> <img src='../../assets/images/card.svg' alt='Card' />
                <h2>Subscribe</h2>
            </div>
            <div> <img src='../../assets/images/present.svg' alt='Box' />
                <h2>Receive boxes</h2>
            </div>
        </div>
        <br>
        <section class='margin-bottom-10-em'>
            <div class='centered'>
                <h1 class='extra-large-font darkblue'>It's that easy</h1>
                <br>
                <a href='#' id='exe-sub-alt' data-version='{{ $box->vid }}' data-product='{{ $box->product_id }}'
                    data-in-stock='{{ $box->in_stock }}' data-total='{{ $box->price }}'
                    data-shipping='{{ $box->shipping_cost }}' data-id='{{ $box->user_id }}' data-url='auth/google'
                    data-video-id='{{ $box->video }}' data-plan-id='1' class='button'> Get started with
                    {{ $user->given_name }} </a>
            </div>
        </section>
    </main>
    @endif
@endsection
