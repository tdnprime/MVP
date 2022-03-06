@extends('layouts.checkout')
@section('content')
    <div id="m-window">
        @if(isset($due))
            
            <div id='m-content'>
                <div id="mc-header"><a href='{{ url()->previous() }}'><span id="m-close"
                            class="material-icons">x</span></a></div>
                <h2>Checkout</h2>
                <div class="centered margin-bottom-4-em">
                    <p class="centered center">{{ $due['description'] }}</p>
                    <form id="payment-form">
                        <div id="card-container"></div>
                        <button class='button' id="card-button" data-type-total="{{ $due['total'] }}"
                            type="button">Pay&nbsp;{{ $due['total'] }}</button>
                            <input type='hidden' id='route' value='{{ $due['route'] }}'>
                        </form>
                    <div id="payment-status-container"></div>
                </div>
            </div>
        
        @endif
    @endsection
