@extends('layouts.shipping')
@section('content')
    @if (isset($due))
        <div id='module'>
            <div class="centered margin-bottom-4-em">
                <h2>Due today</h2>
                <h3 class="centered center red">${{ $due['total'] }} for {{ $due['count'] }} shipping
                    label(s).
                </h3>
                <br><br>
                <form action='/labels/charge' method='post'>
                    @csrf
                    @method('POST')
                    <fieldset class='fieldset-neuromorph'>
                        <legend class='primary-color'>Credit card</legend>

                        <input type='text' value='' name='name' required placeholder="Name on card">

                        <input type='number' value='' name='card' required placeholder="Card number">

                        <select required name='expireMM' id='expireMM'>
                            <option value=''>Expiration month</option>
                            <option value='01'>January</option>
                            <option value='02'>February</option>
                            <option value='03'>March</option>
                            <option value='04'>April</option>
                            <option value='05'>May</option>
                            <option value='06'>June</option>
                            <option value='07'>July</option>
                            <option value='08'>August</option>
                            <option value='09'>September</option>
                            <option value='10'>October</option>
                            <option value='11'>November</option>
                            <option value='12'>December</option>
                        </select>

                        <select required name='expireYY' id='expireYY'>
                            <option value=''>Expiration year</option>
                            <option value='22'>2022</option>
                            <option value='23'>2023</option>
                            <option value='24'>2024</option>
                            <option value='25'>2025
                            <option>
                            <option value='26'>2026</option>
                        </select>

                        <input value='' required type='number' max="999" placeholder="Security code">
                    </fieldset>
                    <fieldset class='fieldset-neuromorph'>
                        <legend class='primary-color'>Billing address</legend>
                        @include('includes.address-collection')
                    </fieldset>

                    <input type='submit' value='Purchase' />

                </form>
            </div>
        </div>

    @endif


@endsection
