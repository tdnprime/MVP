
const appId = 'sandbox-sq0idb-FrLggaZMvpJBc2UDN3zKlg';
const locationId = 'LABQBPRYSFTE8';

async function initializeCard(payments) {

    const card = await payments.card();
    await card.attach('#card-container');

    return card;
}

async function removeLoader() {

    if (document.getElementsByClassName("loader")[0]) {

        var loader = document.getElementsByClassName("loader")[0];

        loader.remove();

    }
}

async function loader() {

    if (!window.top.document.getElementsByClassName("loader")[0]) {

        let div = window.top.document.createElement("div");

        div.className = "loader";

        if (window.top.document.getElementById("container")) {

            let container = window.top.document.getElementById("container");

        } else if (window.top.document.getElementById("m-window")) {

            let container = window.top.document.getElementById("m-window");
        }

        container.prepend(div);
        div.style.position = "absolute";
    }
}


async function ajax(data, back) {

    var xhttp = new XMLHttpRequest();
    xhttp.open(data.method, data.action, true);
    xhttp.setRequestHeader('Content-type', data.contentType);
    xhttp.setRequestHeader(data.customHeader, data.payload, false);
    xhttp.send();
    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            var response = JSON.parse(this.responseText);

            if (response.redirectTo) {

                localStorage.setItem('celebrate', 'true');

                window.top.location.assign(response.redirectTo);

            } else if (response.status == 'FAILURE') {

                back(this.responseText);
            }
        }
    }
}

async function createPayment(token, total) {


    const body = JSON.stringify({
        locationId,
        sourceId: token,
        amount: total,

    });

    const route = document.getElementById('route').value;

    const data = {
        method: "POST",
        action: route + body,
        contentType: "application/json; charset=utf-8",
        customHeader: "X-CSRF-TOKEN",
        payload: document.querySelector('meta[name="csrf-token"]').content
    };

    function callback(re) {

        var res = JSON.parse(re);

        if (res.status == 'FAILURE') {

            displayPaymentResults('FAILURE');

            cardButton.disabled = false;


        } else if (res.status == 'SUCCESS') {

            displayPaymentResults('SUCCESS');

            cardButton.disabled = true;

        }

    }

    return await ajax(data, callback);

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

// After DOM

document.addEventListener('DOMContentLoaded', async function () {

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
    async function handlePaymentMethodSubmission(event, paymentMethod, total) {
        event.preventDefault();

        try {
            // disable the submit button as we await tokenization 
            // and make a payment request.
            const token = await tokenize(paymentMethod);
            const paymentResults = await createPayment(token, total);

            console.debug('Payment Success', paymentResults);
        } catch (e) {
            cardButton.disabled = false;

        }
    }

    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async function (event) {

        const total = cardButton.getAttribute('data-type-total');
        await handlePaymentMethodSubmission(event, card, total);
    });
}



);