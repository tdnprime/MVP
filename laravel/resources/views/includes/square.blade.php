<!DOCTYPE html>
<html>

<head>
@include('includes.meta')
@section('title', 'Boxeon | Checkout')
    <link href="https://boxeon.com/assets/css/square.css" rel="stylesheet" />
    <script defer type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>


    <script nonce='
    @php
    echo $_COOKIE['no'];
    setCookie('no', '', time() - 3900);
    @endphp
    '>

        const appId = 'sandbox-sq0idb-FrLggaZMvpJBc2UDN3zKlg';
        const locationId = 'LABQBPRYSFTE8';

        async function initializeCard(payments) {

            const card = await payments.card();
            await card.attach('#card-container');

            return card;
        }

        async function createPayment(token) {

            const body = JSON.stringify({
                locationId,
                sourceId: token,
                amount: 100,

            });
            

        const data = {
                method: "GET",
                action: "/labels/charge/?charge=" + body + "",
                contentType: "application/json; charset=utf-8",
                customHeader: "X-CSRF-TOKEN",
                payload: document.querySelector('meta[name="csrf-token"]').content
            };

            function callback(re) {
                return re;

            }
            Boxeon.loader();
            Boxeon.sendAjax(data, callback);
            
        }

        async function tokenize(paymentMethod) {
            const tokenResult = await paymentMethod.tokenize();
            if (tokenResult.status === 'OK') {
                return tokenResult.token;
            } else {
                let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
                if (tokenResult.errors) {
                    errorMessage += ` and errors: ${JSON.stringify(
            tokenResult.errors
          )}`;
                }

                throw new Error(errorMessage);
            }
        }

        // status is either SUCCESS or FAILURE;
        function displayPaymentResults(status) {
            const statusContainer = document.getElementById(
                'payment-status-container'
            );
            if (status === 'SUCCESS') {
                statusContainer.classList.remove('is-failure');
                statusContainer.classList.add('is-success');
            } else {
                statusContainer.classList.remove('is-success');
                statusContainer.classList.add('is-failure');
            }

            statusContainer.style.visibility = 'visible';
        }

        document.addEventListener('DOMContentLoaded', async function() {
            if (!window.Square) {
                throw new Error('Square.js failed to load properly');
            }

            let payments;
            try {
                payments = window.Square.payments(appId, locationId);
            } catch {
                const statusContainer = document.getElementById(
                    'payment-status-container'
                );
                statusContainer.className = 'missing-credentials';
                statusContainer.style.visibility = 'visible';
                return;
            }

            let card;
            try {
                card = await initializeCard(payments);
            } catch (e) {
                console.error('Initializing Card failed', e);
                return;
            }

            // Checkpoint 2.
            async function handlePaymentMethodSubmission(event, paymentMethod) {
                event.preventDefault();

                try {
                    // disable the submit button as we await tokenization and make a payment request.
                    cardButton.disabled = true;
                    const token = await tokenize(paymentMethod);
                    const paymentResults = await createPayment(token);
                    displayPaymentResults('SUCCESS');

                    console.debug('Payment Success', paymentResults);
                } catch (e) {
                    cardButton.disabled = false;
                    displayPaymentResults('FAILURE');
                    console.error(e.message);
                }
            }

            const cardButton = document.getElementById('card-button');
            cardButton.addEventListener('click', async function(event) {
                await handlePaymentMethodSubmission(event, card);
            });
        });
    </script>
</head>

<body id='index'>
    <div id="container">
        <span></span><!-- Hack-->

        @if (isset($due))
        <div id='module'>
            <div class="centered margin-bottom-4-em">
                <h2>Due today</h2>
                <p class="centered center">${{ $due['total'] }} for {{ $due['count'] }} shipping
                    label(s) via USPS {{ $due['description'] }}</p>
                <form id="payment-form">
                    <div id="card-container"></div>
                    <button class='button' id="card-button" type="button">Pay&nbsp;{{$due['total']}}</button>
                </form>
                <div id="payment-status-container"></div>
                <img style='width:100px; height:auto; margin:auto; display:block;position:relative; bottom:10em;'
                    id='image-square-logo' class='center' src='../../../assets/images/square-logo.png' alt='Square' />
            </div>
        </div>
        @endif
</body>


</html>
