@extends('layouts.index')
@section('title', 'Boxeon.com About Subscriptions')
@section('content')
    <main>
        <section class='section maxw1035 rounded-corner card'>
            @include('includes.category-nav')
            <h2 class=" extra-large-font centered primary-color">Charities our subscriptions support</h2><br>
            <div  class="m-hori-scroll-wrapper">
            <div id="orgs" class="three-col-grid">
                <div>
                    <a href="https://www.timeout4africa.com/stem-camp-for-girls" target="_blank">
                        <img id="img-reminder" class="image-how-it-works h70px" src="../assets/images/stem-girls.jpg"
                            alt="Timeout 4 Africa" />
                    </a>
                    <h2 class="centered">STEM Camp for Girls</h2>
                    <p class="centered">Young girls in Minna, Nigeria, have limited access to science, technology,
                        engineering, and mathematics (STEM) material. STEM Camp for Girls provides them with these resources
                        to broaden their horizons.</p>
                </div>
                <div>
                    <a href="https://wtec.org.ng/" target="_blank">
                        <img id="img-gifts" class="image-how-it-works h70px" src="../assets/images/wtech.jpg" alt="WTEC" />
                    </a>
                    <h2 class="centered">Women's Tech Empowerment Centre</h2>
                    <p class="centered">Women's Tech Empowerment Centre focuses on fostering Nigeria's next generation
                        of female technology creators, entrepreneurs, and leaders. Your monthly Boxeon subscription will
                        supercharge their work.
                    </p>
                </div>
                <div>
                    <a href="https://tabithahome.org/" target="_blank">
                        <img id="img-shopping" class="image-how-it-works h70px" src="../assets/images/tabitha-girl.jpg"
                            alt="Hope Rising" />
                    </a>
                    <h2 class="centered">Tabitha Homes</h2>
                    <p class="centered">Tabitha Home's mission is to rehabilitate and transform former disadvantaged
                        youth so they may live fulfilled lives. Your monthly Boxeon subscription will significantly support
                        this charity.</p>
                </div>
            </div>
        </div>
            <div class="alert-info">
                <p><span class="material-icons">star</span>&nbsp;Our subscribers receive an annual gift card from
                    us, which they use to donate money to the above charities.</p>
            </div>
            <h1 class='extra-large-font centered margin-top-4-em primary-color'> Frequently Asked Questions</h1>
            <h2>Why have a subscription?</h2>
            <p>According to the Time Use Institute, we spend more than 53 hours each year
                just grocery shopping. A Boxeon grocery subscription saves you this precious time so you can take
                back control of your busy schedule - which will inevitably lead to more free time for yourself and
                loved ones.</p>

            <h2> How does it work?</h2>
            <p> Set up regularly scheduled deliveries and earn savings. We'll ship your African groceries to you nationwide so; you no longer have to go hunting for them. You may cancel or pause a delivery at any time.</p>

            <h2>How do I start a subscription?</h2>

            <ol>
                <li>Go to our Shop and find the African foods you want.</li>
                <li>Select the quantity and schedule that works for you.</li>
                <li>Skip your deliveries or cancel your subscriptions at any time by signing in, clicking on your user icon and then clicking on Subscriptions.</li>
                <li>In advance of each delivery, we will send you a reminder email showing the item price and any applicable
                    discount for your upcoming delivery. The price of the item may decrease or increase from delivery to
                    delivery, depending on the Boxeon.com price of the item at the time we process your order.</li>
            </ol>

            <h2>How do I redeem a coupon?</h2>

            <ol>
            <li>Add the African foods you want to your shopping cart.</li> 
            <li>Click on the "Proceed to checkout" button. </li>
            <li>At the top of the checkout page enter your coupon code and click "Apply."</li>
            </ol>

            <h2>How to skip your next delivery?</h2>

            <ol>
                <li>After signing in, click on your user icon.</li>
                <li> In the dropdown, click on Subscriptions.</li>
                <li>On the resulting page, click on the Skip button, next to the product you want to skip.</li>
                <li>Click Confirm.</li>
            </ol>

            <h2>How to change your Boxeon delivery day?</h2>

            <ol>
                <li>After signing in, click on your user icon.</li>
                <li> In the dropdown, click on Subscriptions.</li>
    
                <li>At the top of the page you will see three tabs: Deliveries, Subscriptions, and Settings. Click on the
                    Settings tab.</li>
                <li>On the Settings tab, you will see your Arrive by date. Click to edit.</li>
            </ol>

            <h2>
                How to change your Boxeon delivery schedule or quantity?</h2>

            <ol>
                <li>After signing in, click on your user icon.</li>
                <li> In the dropdown, click on Subscriptions.</li>
                <li>On the Deliveries tab you will see a blue link with your auto-delivered frequency (such as,
                    Auto-delivered: Monthly).</li>
                <li>Click on the frequency.</li>
                This opens a page where you can change your quantity, frequency, and next delivery date.</li>
                <li>After you have made changes, click Apply.</li>
            </ol>
            <h2>How to cancel your Boxeon auto-delivery?</h2>
            <ol>
                <li>After signing in, click on your user icon.</li>
                <li> In the dropdown, click on Subscriptions.</li>
                <li>From either the Deliveries or Subscription tab, you can Click on the subscription for the item you'd
                    like to
                    modify.</li>
                <li>Click Cancel subscription, then click Confirm cancellation.</li>
            </ol>
            <h2>How to change your Boxeon payment method?</h2>
            <ol>
                <li>After signing in, click on your user icon.</li>
                <li> In the dropdown, click on Subscriptions.</li>
                <li> From the resulting page you have two options:</li>
                <li>To change your payment method for all subscriptions, click on the Settings tab. Then click Change under
                    Payment Method.</li>
                <li>Or, to change the payment method associated with a single subscription, click on the Deliveries or
                    Subscriptions tabs. Click on the subscription you want to edit and then click Change Payment.</li>
            </ol>
            <h2>Why did the price of my item change?</h2>
            <p>While you will always receive a Boxeon discount, individual product prices can go up or down over
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
