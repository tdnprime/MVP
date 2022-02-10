@extends('layouts.checkout')
@section('content')

        @if (isset($subscription))
             
                <div class="centered margin-bottom-4-em">
                    <p class="centered center">{{ $subscription['description'] }}</p>
                    <form id="payment-form">
                        <div id="card-container"></div>
                        <button class='button' id="card-button" data-type-total="{{ $subscription['total'] }}"
                            type="button">Pay&nbsp;{{ $subscription['total'] }}</button>
                        <input type='hidden' id='route' value='{{ $subscription['route'] }}'>
                    </form>
                   
                    <div id="payment-status-container"></div>
                </div>
            </div>

        @endif

    @endsection
