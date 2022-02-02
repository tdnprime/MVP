@extends('layouts.shipping')
@section('content')
    <div id='module'>
        <div class="centered margin-bottom-4-em">
        <form action='/checkout/labels' method='post'>
            @csrf
            @method('POST')
            <fieldset id='fieldset-shipping-addresss' class='fieldset-neuromorph'>
                <p>Please confirm your shipping address.</p>
                <legend class='primary-color'>Shipping address</legend>
                @include('includes.address-collection')
            </fieldset>
            <input type='submit' value='Continue'>
        </form>
    </div>
    </div>   
    @endsection
