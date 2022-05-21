@extends('layouts.checkout')
@section('content')

        @if (isset($subscription))
             
                <div class="centered margin-bottom-4-em">
                    <form id="">
                        <div id="card-container"></div>
                     <div class='sub-btns'>
                        <button class='button' id="card-button" data-type-total="{{ $subscription['total'] }}"
                            type="button">Pay&nbsp;${{ $subscription['total'] }}</button>
                     </div>
                         
                        <input type='hidden' id='route' value='{{ $subscription['route'] }}'>
                    </form>
                   
                    <div id="payment-status-container"></div>
                
                </div>
            </div>

        @endif

    @endsection
