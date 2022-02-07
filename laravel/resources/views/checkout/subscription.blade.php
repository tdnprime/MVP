@extends('layouts.checkout')
@section('content')
    <div id="m-window">

        {{--<div>
            <div ><div id="renderedCheckoutButtonHTML" style="
            overflow: auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            width: 258.96px;
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: -2px 10px 5px rgba(0, 0, 0, 0);
            border-radius: 10px;
            font-family: SQ Market, Helvetica, Arial, sans-serif;
            ">
            <div style="padding: 20px;">
            <a id="embedded-checkout-modal-checkout-button" target="_blank" data-url="https://square.link/u/ZDWwyxRo?src=embd" href="https://square.link/u/ZDWwyxRo?src=embed" style="
              display: inline-block;
              font-size: 18px;
              line-height: 48px;
              height: 48px;
              color: #ffffff;
              min-width: 212px;
              background-color: #000000;
              text-align: center;
              box-shadow: 0 0 0 1px rgba(0,0,0,.1) inset;
              
            ">Pay now</a>
            </div>
          </div>
          <textarea class="checkout-button-html-hidden-textarea embedded-checkout-link"></textarea></div>
          
            <style>
              .embedded-checkout-link-html-hidden-textarea,
              .checkout-button-html-hidden-textarea {
                opacity: 0;
                position: absolute;
              }
            </style>
          
            <script>
              function showCheckoutWindow(e) {
                e.preventDefault();
          
                const url = document.getElementById('embedded-checkout-modal-checkout-button').getAttribute('data-url');
                const title = 'Square Online Checkout';
          
                // Some platforms embed in an iframe, so we want to top window to calculate sizes correctly
                const topWindow = window.top ? window.top : window;
          
                // Fixes dual-screen position                                Most browsers          Firefox
                const dualScreenLeft = topWindow.screenLeft !==  undefined ? topWindow.screenLeft : topWindow.screenX;
                const dualScreenTop = topWindow.screenTop !==  undefined   ? topWindow.screenTop  : topWindow.screenY;
          
                const width = topWindow.innerWidth ? topWindow.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                const height = topWindow.innerHeight ? topWindow.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
          
                const h = height * .75;
                const w = 500;
          
                const systemZoom = width / topWindow.screen.availWidth;
                const left = (width - w) / 2 / systemZoom + dualScreenLeft;
                const top = (height - h) / 2 / systemZoom + dualScreenTop;
                const newWindow = window.open(url, title, `scrollbars=yes, width=${w / systemZoom}, height=${h / systemZoom}, top=${top}, left=${left}`);
          
                if (window.focus) newWindow.focus();
              }
          
              // This overrides the default checkout button click handler to show the embed modal
              // instead of opening a new tab with the given link url
              document.getElementById('embedded-checkout-modal-checkout-button').addEventListener('click', function (e) {
                showCheckoutWindow(e);
              });
            </script>
          </div>--}}
@section('content')
    @if(isset($subscription))
            
            <div id='m-content'>
                <div id="mc-header"><a href='{{ url()->previous() }}'><span id="m-close"
                            class="material-icons">×</span></a></div>
                <h2>Checkout</h2>
                <div class="centered margin-bottom-4-em">
                    <p class="centered center">{{ $subscription['description'] }}</p>
                    <form id="payment-form">
                        <div id="card-container"></div>
                        <button class='button' id="card-button" data-type-total="{{ $subscription['total'] }}"
                            type="button">Pay&nbsp;{{ $subscription['total'] }}</button>
                    <input type='hidden' id='route' value='{{ $subscription['route'] }}'>
                          </form>
                    <div id="payment-status-container"></div>
                    <img id='image-square-logo' class='center' src='../../../assets/images/square-logo.png' alt='Square' />
                </div>
            </div>
        
        @endif

@endsection