@extends('layouts.shipping')
@section('title', 'Boxeon | Confirm Address')
@section('content')
    <div id='module'>
        <div class="centered margin-bottom-4-em">
        <form class='centered' action='/checkout/labels' method='post'>
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-75">
                <h3 class='centered'>Confirm shipping address to continue</h3>
                @include('includes.address-collection')
                </div></div>
                <div class="row">
                    <div class="col-75">
            <input type='submit' value='Continue'>
                </div></div>
        </form>
    </div>
    </div>   
    @endsection
