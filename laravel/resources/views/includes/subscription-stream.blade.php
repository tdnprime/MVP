<main class="fadein">
   
    <div class="contaner">

        @if (session()->has('message'))
            <dialog class="alert">
                <p class='centered'> {{ session()->get('message') }}</p>
            </dialog>
        @endif

        @if (isset($subscriptions) && count($subscriptions) > 0)
        @include('includes.shop-products')
        @else
        <section class="section maxw1035">
            <div class="alert-info w100per">
                <p><span class="material-icons text-red">info</span>&nbsp;You don't have any subscriptions.</p>
            </div>
            <br>
        </section>

        @include('includes.shop-products')

        @endif

</div>
   
</main>
