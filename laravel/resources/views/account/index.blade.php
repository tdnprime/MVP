@extends('layouts.home')
@section('title', 'Boxeon Account')
@section('content')
    <main class='fadein'>
        <section id="left-aside">
        </section>
        @if (session()->has('message'))
            <dialog class="alert">
                <p class='centered'> {{ session()->get('message') }}</p>
            </dialog>
        @endif
        <section class="section rounded-corners card maxw1035">
            @include('includes.category-nav')
            <h2 class="margin-bottom-zero font-size-2-em">Manage your account</h2>
            <div class="div-horizontal-rule"></div>
            <div class="card step-wrapper">
                <h2>Shipping address</h2>
                <p><span class="material-icons">pin_drop</span><span data-type-id="shipping-address"
                        class="preview">{{ $address->address_line_1 ?? 'Edit your shipping address.' }}</span></p>
                <button data-type-id="shipping-address" class="button edit-btn">EDIT</button>
                <div>
                    <form id="shipping-address" class="display-none-unimportant">
                        <div class="row">
                            <div class="col-75">
                                @include('includes.address-collection')
                                <p>Are your billing and shipping address the same?</p>
                                <label> Yes
                                    <input required type="radio" name="same" value="1">
                                </label>
                                <label>No
                                    <input required type="radio" name="same" value="0">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type='submit' value='CONTINUE'>
                            </div>
                        </div>
                    </form>
                </div>
                <div></div>
            </div>
            <div class="card step-wrapper">
                <h2>Billing address</h2>
                <p><span class="material-icons">pin_drop</span><span data-type-id="billing-address"
                        class="preview">{{ $address->billing_address_line_1 ?? 'Edit your billing address.' }}</span></p>
                <button data-type-id="billing-address" class="button edit-btn">EDIT</button>
                <div>
                    <form id="billing-address" class="display-none-unimportant">
                        <div class="row">
                            <div class="col-75">
                                @php $billing = "billing_";@endphp
                                @include('includes.address-collection')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type='submit' value='CONTINUE'>
                            </div>
                        </div>
                    </form>
                </div>
                <div></div>
            </div>
            <div class="card step-wrapper">
                <div>
                    <h2>Payment method</h2>
                    <p><span class="material-icons">credit_card</span>&nbsp;<span data-type-id="payment"
                            class="preview">Edit payment method and details.</span></p>
                    <button data-type-id="payment" class="button edit-btn">EDIT</button>
                </div>
                <div id="payment" class="display-none-unimportant">
                    <form>
                        <div id="card-container"></div>
                        <div class='sub-btns'>
                            <button class='button' id="card-button" data-type-total="1" type="button">&nbsp;SAVE</button>
                        </div>
                        <input type='hidden' id='route' value='route'>
                    </form>
                    <div id="payment-status-container"></div>
                </div>
                <div></div>
            </div>
            <div class="div-horizontal-rule"></div>
            <a href="#" class="button clearbtn primary-color">Delete account</a>
        </section>
        <section id="right-aside"></section>
    </main>
@endsection
