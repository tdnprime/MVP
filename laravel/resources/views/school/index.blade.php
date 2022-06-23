@extends('layouts.index')
@section('title', 'Boxeon.com About Subscriptions')
@section('content')

    <main>


        <section class='section maxw1035 rounded-corner card'>
            @include("includes.works")

            <div class="div-horizontal-rule center"></div>
            <h1 class='extra-large-font centered'> Frequently Asked Questions</h1>


            <h2> How does it work?</h2>
            <p> Set up regularly scheduled deliveries and earn savings with Subscribe & Save. Unlock extra savings on
                eligible subscriptions when you receive five or more products in one auto-delivery to one address. From
                diapers to toothpaste to dog treats, you can subscribe to thousands of everyday products.</p>

            <h2>How do I start a subscription?</h2>

            <ol>
                <li>Select "Subscribe and Save" on the
                    detail page for thousands of eligible products.</li>
                <li>Select the quantity and schedule that works for you.</li>
                <li>Skip your deliveries or cancel your subscriptions at any time by visiting Manage Your Subscriptions</li>
                <li>In advance of each delivery, we will send you a reminder email showing the item price and any applicable
                    discount for your upcoming delivery. The price of the item may decrease or increase from delivery to
                    delivery, depending on the Amazon.com price of the item at the time we process your order.</li>
            </ol>
            <h2>How do I save up to 15% on my auto-deliveries?</h2>
            <p>Save up to 15% off when receiving 5 or more products in one auto-delivery to one address.</p>

            <h2>How to skip your next delivery?</h2>
            <ol>
                <li>Go to Manage Your Subscriptions.</li>
                <li>Click on the Skip link, next to the subscription product you want to skip.</li>
                <li>Click Confirm.</li>
            </ol>
            <h2>How to change your Subscribe & Save delivery day?</h2>
            <ol>
                <li>Go to Manage Your Subscriptions.</li>
                <li>At the top of the page you will see three tabs: Deliveries, Subscriptions, and Settings. Click on the
                    Settings tab.</li>
                <li>On the Settings tab, you will see your Arrive by date. Click to edit.</li>
            </ol>
            <h2>
                How to change your Subscribe & Save delivery schedule or quantity?</h2>
            <ol>
                <li>Go to Manage Your Subscriptions.</li>
                <li>On the Deliveries tab you will see a blue link with your auto-delivered frequency (such as,
                    Auto-delivered: Monthly).</li>
                <li>Click on the frequency.</li>
                This opens a page where you can change your quantity, frequency, and next delivery date.</li>
                <li>After you have made changes, click Apply.</li>
            </ol>
            <h2>How to cancel your Subscribe & Save auto-delivery?</h2>
            <ol>
                <li>Go to Manage Your Subscriptions.</li>
                <li>From either the Deliveries or Subscription tab, you can Click on the subscription for the item you'd
                    like to
                    modify.</li>
                <li>Click Cancel subscription, then click Confirm cancellation.</li>
            </ol>
            <h2>How to change your Subscribe & Save payment method?</h2>
            <ol>
                <li>Go to Manage Your Subscriptions. From there you have two options:</li>
                <li>To change your payment method for all subscriptions, click on the Settings tab. Then click Change under
                    Payment Method.</li>
                <li>Or, to change the payment method associated with a single subscription, click on the Deliveries or
                    Subscriptions tabs. Click on the subscription you want to edit and then click Change Payment.</li>
            </ol>
            <h2>Why did the price of my item change?</h2>
            <p>While you will always receive a Subscribe & Save discount, individual product prices can go up or down over
                time. If the price of your subscribed product changes, the new price will be displayed in your order review
                email and will be applied only on future shipments. You can review your subscription price and edit or
                cancel your subscription at any time.</p>

            <h2>Need help?</h2>
            <div>
               <p> Contact customer service at 646-450-4671‬.</p>
            </div>
        </section>

    </main>

@endsection
