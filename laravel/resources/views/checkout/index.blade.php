@extends('layouts.checkout')
@section('title', 'Boxeon.com Checkout')
@section('content')
    <main id="checkout-main">
        <span></span>
        <div id="">
            <section id="checkout-content" class="margin-top-6-em max-width-1035 three-rows-grid">
                <div class="step-wrapper">
                    <h3>1.&nbsp;&nbsp;&nbsp;Shipping address</h3>
                    <div>
                        <form action='/checkout/address' method='post'>
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-75">
                                    @include('includes.address-collection')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <input type='submit' value='Save'>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div></div>
                </div>
                <div class="step-wrapper">
                    <div>
                        <h3>2.&nbsp;&nbsp;&nbsp;Payment method</h3>
                    </div>
                    <div id="payment-method">
                        <form action='/checkout/address' method='post'>
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-75">
                                    @include('includes.address-collection')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <input type='submit' value='Add'>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div></div>
                </div>
                <div class="step-wrapper">
                    <div class="two-col-grid">

                        <form action="/checkout/index" method="post">
                            @csrf
        
                            <input type="submit" class="yellowbtn" value="Place your order">
                        </form>
                        <div>
                            <h3 class="text-red">Order total</h3>
                            <p class="one-em-font">By placing your order, you agree to Boxeon's <a href="/terms"
                                    class="one-em-font underline primary-color">Terms of Use</a></p>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        <div>
            <section class="hide margin-top-6-em sticky">
                <div id="order-summary" class="card-white-bg">
                    <form action="/checkout/index" method="post">
                        @csrf
                        <input type="submit" class="yellowbtn" value="Place your order">
                    </form>
                    <p class="one-em-font move-up centered">By placing your order, you agree to Boxeon's <a href="/privacy"
                        class="one-em-font underline primary-color">Privacy Policy</a> and <a href="/terms"
                            class="one-em-font underline primary-color">Terms of Use</a></p>
                    <h3>Order Summary</h3>
                    <div>
                        <div class="two-col-grid">
                            <p>item(s):</p>
                            <p>total</p>
                        </div>
                        <div class="two-col-grid">
                            <p>Shipping & handling:</p>
                            <div>
                            <p>total</p>
                            <hr>
                            </div>
                        </div>
                        <div class="two-col-grid">
                            <p>Total before tax:</p>
                            <p>total</p>
                        </div>
                        <div class="two-col-grid">
                            <p>Estimated tax:</p>
                            <p>total</p>
                        </div>
                        <hr>
                        <div class="two-col-grid">
                            <h3 class="text-red">Order total:</h3>
                            <h3 class="text-red">total</h3>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        </section>
        </div>
    </main>
@endsection
