@extends('layouts.checkout')
@section('content')
    <div id="m-window">
        @if (isset($due))
            <div id='m-content'>
                <div id="mc-header"><a href='{{ url()->previous() }}'><span id="m-close"
                            class="material-icons">×</span></a></div>
                <h2>Checkout</h2>
                <div class="centered margin-bottom-4-em">
                    <p class="centered center">${{ $due['total'] }} for {{ $due['count'] }} shipping
                        label(s) via USPS {{ $due['description'] }}</p>
                    <form id="payment-form">
                        <div id="card-container"></div>
                        <button class='button' id="card-button" data-type-total="{{ $due['total'] }}"
                            type="button">Pay&nbsp;{{ $due['total'] }}</button>
                        <input id='appId' type='hidden' value='{{ $due['appId'] }}'
                            data-type-location='{{ $due['locationId'] }}'>
                    </form>
                    <div id="payment-status-container"></div>
                    <img id='image-square-logo' class='center' src='../../../assets/images/square-logo.png' alt='Square' />
                </div>
            </div>
        @endif
    @endsection
