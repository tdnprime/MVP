@extends('layouts.home')
@section('title', 'Boxeon | Privacy')
@section('content')
    <main>
        <section class='section rounded-corners card maxw1036'>
            @include('includes.category-nav')
            <h2 class="font-size-2-em margin-bottom-zero">Returns & refunds</h2>
            <div class="div-horizontal-rule"></div>
            <p>
                When you return an item, your refund amount and refund method may vary. Check the payment method refunded
                and the status of your refund in <a class="one-em-font primary-color" href="/home/index">Subscriptions</a>.
            </p>

            <h2>Where is my refund? </h2>
            <p>Check the status of your refund in <a class="one-em-font primary-color" href="/home/index">Subscriptions</a>
            </p>

            <h2>How Long Do Refunds Take? </h2>
            <p>When returning an item, you have the option to choose your preferred refund method in <a
                    class="one-em-font primary-color" href="/home/index">Subscriptions</a>.</p>

            <p>After the carrier receives your item, it can take up to two weeks for us to receive and process your return.
                We typically process returns within 3-5 business days after the carrier delivers the item to our Returns
                Center. When we complete processing your return, we issue a refund to the selected payment method.</p>

            <h2>Refund Times</h2>
            <p>Once we issue your refund, it takes additional time for your financial institution to make funds available in
                your account. Refer to following table for more details.</p>


            <table>
                <tr>
                    <th>Refund Method</th>
                    <th>Refund Time (After Refund Is Processed)</th>
                </tr>
                <tr>
                    <td>Credit card</td>
                    <td>Three to five business days</td>
                </tr>
                <tr>
                    <td>Debit card</td>
                    <td>Up to 10 business days</td>
                </tr>
                <tr>
                    <td>Checking account</td>
                    <td>Up to 10 business days</td>
                </tr>
                <tr>
                    <td>SNAP EBT card</td>
                    <td>Up to 10 business days</td>
                </tr>
                <tr>
                    <td>Promotional Certificate</td>
                    <td>No refund issued</td>
                </tr>
                <tr>
                    <td>Pay in Cash (at a participating location)</td>
                    <td>Up to 10 business days</td>
                </tr>
                <tr>
                    <td>Pre-paid credit card</td>
                    <td>Up to 30 days (depending on the issuer of the card)</td>
                </tr>
            </table>
            <h2>Partial Refunds or Restocking Fees</h2>
            <table>
                <tr>
                    <th> Item</th>
                    <th>Refund</th>
                </tr>

                <tr>
                    <td> Items in original condition past the return window*</td>
                    <td>80% of item price</td>
                </tr>
            </table>
            <p>*For most items, the return window is 30 days after delivery. To check the return window for an item you've
                ordered, go to <a class="one-em-font primary-color" href="/home/index">Subscriptions</a> and select Return or
                Replace Items.</p>
        </section>

    </main>

@endsection
