@extends('layouts.shipping')
@section('content')

    @if (isset($due))
        <div id='module'>
            <div class="centered margin-bottom-4-em">
                <h2 class='red'>Due today</h2>
                <h3 class="centered center red">${{ $due['total'] }} for {{ $due['count'] }} shipping
                    label(s)
                </h3>
                <br>
                <img class="center service-provider-logo" src='{{ $due['provider_logo'] }}' alt='Provider'/>
                <h3 class="centered">{{ $due['description'] }}</h3>
                <br>
                <br>
                <iframe id='iframe-square-payment' src='http://localhost:8000/web-payments-quickstart/public/examples/card.html?total={{ $due['total'] }}&csrf={{csrf_token()}}'></iframe>

            </div>
        </div>

    @endif


@endsection
