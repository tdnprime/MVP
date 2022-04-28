@extends('layouts.box')
@section('title', 'Boxeon | Edit Box')
@section('content')

@if (session()->has('message'))
<dialog class="alert">
   <p class='centered'> {{ session()->get('message') }} Share&nbsp;<a class='one-em-font primary-color' href='/{{$box->box_url}}'> boxeon.com/{{$box->box_url}}</a></p>
</dialog>  
@endif

    @if(empty($box) || is_null($box->box_weight))
        <div id="masthead" class="fadein">
            <div id="headline">
                <div>
                    <p class="text-heading-label">PLEASE HOLD</p>
                    <h1 class="ginormous">Your
                        subscription box isn't ready</h1>
                    <p id="pitch">If you are in the Boxeon Partner Program, we will be
                        contacting you by email to help you finish creating your box. Please ensure our emails are not in
                        your spam folder.</p>
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
                            {{ $box->page_name }}</span>
                        <span class='break hack-br-1'><br></span> is curating {{ $box->box_supply }} subscription boxes
                        <br>
                        for loyal fans
                    </h1>
                    <div>
                        <p class='margin-auto-no-important'><span class='highlighted darkblue'>${{ $box->price }}</span> <span class="break"><br></span>per box
                            ({{ $box->shipping }})</p>
                        <p class='margin-auto-no-important'><span class='highlighted darkblue'>{{ $box->box_supply }}</span> <span class="break"><br></span>boxes left in stock</p>
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
                        <div class='alert-info'>
                            <p>To publish your page, embed a
                                <a href='#' class='one-em-font underline' id='video-instructions'>call to action YouTube
                                    video</a>.
                                You may complete this step at any time by signing in and clicking
                                on your user icon at the top right-hand corner of any page.
                            </p>
                        </div>
                        <form action='/box/embed' method='post' id='embed-form'>

                            @csrf
                            @method('POST')

                            <input class='centered' required placeholder='Youtube video URL from browser' name='ytembed' type='url'>
                            <div class='buttonHolder'>
                                <input type='submit' value='Embed'>
                            </div>
                        </form>
                    </div>
            </div>

        @else

            <div id='masthead-video-wrapper'>
                <div class='playbtn-wrapper'>
                    <img id='image-youtube-thumb' src='{{ $box->image }}' />
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
        <aside class="asides">
            <h1 class="extra-large-font darkblue">How it works</h1>
            <p class="centered center font-1-5-em">Subscribers will receive a recurring shipment of products to try. If they like any product enough, they can choose to have it included in their box going forward.</p>
          <br></aside>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Limited boxes available</h1>
                    <p>
                    {{ $box->page_name }} is curating a limited number of boxes per month. Subscribe while supplies last.</p>
                </div>
                <img src='../../assets/images/logistics.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'> <img src='../../assets/images/freedom.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Subscribe and save</h1>
                    <p>
                        Subscribe to receive $54 worth of products for only $20 per box.</p>
                </div>
            </div>
        </section>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Build your box</h1>
                    <p> In your home page, you may customize the products you receive, change your shipping address, and much more at any time.</p>

                </div>
                <img src='../../assets/images/under-construction.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'><img src='../../assets/images/sleep.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Rest secured</h1>
                    <p>
                        We conduct all financial transactions securely via Square. No Square account
                        is necessary.</p>
                </div>
            </div>
        </section>
        <section class='section'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'> Save on shipping</h1>
                    <p>
                        Subscribe to {{ $box->page_name }}'s box today to secure up to 90% off on shipping.</p>
                </div>
                <img src='../../assets/images/high-five.svg' alt='subscription box'>
            </div>
        </section>
        <section class='section'>
            <div class='section-inner-grid'><img src='../../assets/images/makeitrain.svg' alt='subscription box'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Money back guarantee</h1>
                    <p>We'll issue full refunds to any subscriber who successfully prove they didn't receive a box.</p>

                </div>
            </div>
        </section>
        <section class='section margin-bottom-10-em'>
            <div class='alt-section-inner-grid'>
                <div class='secinner'>
                    <h1 class='extra-large-font'>Cancel anytime</h1>
                    <p>
                        If you're unsatisfied with {{ $user->page_name }}'s box, you may unsubscribe
                        at anytime without hassle.</p>
                </div>
                <img src='../../assets/images/laptop.svg' alt='subscription box'>
            </div>
        </section>
        
     
        <br>
        <section class='margin-bottom-10-em'>
            <div class='centered'>
                <h1 class='extra-large-font darkblue'>Subscribe and save!</h1>
                <br>
                <a href='#' id='exe-sub-alt' data-version='{{ $box->vid }}' data-product='{{ $box->product_id }}'
                    data-in-stock='{{ $box->in_stock }}' data-total='{{ $box->price }}'
                    data-shipping='{{ $box->shipping_cost }}' data-id='{{ $box->user_id }}' data-url='auth/google'
                    data-video-id='{{ $box->video }}' data-plan-id='1' class='button'> Get started</a>
            </div>
        </section>
    </main>
    @endif
@endsection
