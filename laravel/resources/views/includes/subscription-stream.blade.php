<main class="fadein">

    <div>

        @if (session()->has('message'))
            <dialog class="alert">
                <p class='centered'> {{ session()->get('message') }}</p>
            </dialog>
        @endif

        @if (isset($subscriptions) && count($subscriptions) > 0)

            <section class='section card maxw1036'>
              
                <div class="alert-info">
                    <h3 class="primary-color">Delivery Details</h3>
                    <p>Expected to arrive<span class="material-icons text-red">arrow_forward</span>
                        @php
                            
                            $date = date('Y-m-j');
                            echo $add = date('d M Y', strtotime($date . '+1 week')) . " - "; 
                            echo $add = date('d M Y', strtotime($date . '+2 week'));
                      
                            
                        @endphp</p>
                        <p>USPS tracking number<span class="material-icons text-red">arrow_forward</span> <span>Pending...</span></p>
                </div>
                <br>
                <div class="products-stream">
                    @for ($i = 0; $i < count($subscriptions); $i++)
                        @php
                            // HACK
                            $name = explode('.', $subscriptions[$i]->img);
                            $img = $name[0] . '.jpeg';
                            
                        @endphp

                        <div class="fit-content margin-auto">
                            <a href="/shop/item?id={{ $subscriptions[$i]->id }}"><img
                                    src="../assets/images/products/medium/{{ $img }}"
                                    alt="{{ $subscriptions[$i]->name }}"></a>
                            <a class="" href="/shop/item?id={{ $subscriptions[$i]->id }}">
                                <p>{{ $subscriptions[$i]->name }}</p>
                            </a>

                            {{-- UPDATE FORM --}}

                            <h4 class="uppercase">Subscription details</h4>
                            <p>Delivery: Every&nbsp;{{ $subscriptions[$i]->frequency }}&nbsp;month(s)</p>
                            <p>Weight: {{ $subscriptions[$i]->weight }} pound(s)</p>
                            <p>Quantity: {{ $subscriptions[$i]->quantity }}</p>
                            <p>Total: ${{ $subscriptions[$i]->total }}</p>
                            <hr>
                            <p class="text-red">Original price: ${{ $subscriptions[$i]->price + 3 }}</p>
                            <form class="form-plan">
                                <select class="select-plan margin-top-zero" name="quantity">
                                    <option invalid>Select Quantity</option>
                                    <option selected value="1">Qty: 1</option>
                                    <option value="2">Qty: 2</option>
                                    <option value="3">Qty: 3</option>
                                    <option value="4">Qty: 4</option>
                                    <option value="5">Qty: 5</option>
                                    <option value="6">Qty: 6</option>
                                    <option value="7">Qty: 7</option>
                                </select>
                                <select class="select-plan margin-top-zero"
                                    data-product="{{ $subscriptions[$i]->product_id }}"
                                    data-price={{ $subscriptions[$i]->price }} name="plan">
                                    <option invalid>Select Subscription</option>
                                    <option value="1" selected>${{ $subscriptions[$i]->price }} - Every month
                                    </option>
                                    <option value="2">${{ $subscriptions[$i]->price + 1 }} - Every 2 months
                                    </option>
                                    <option value="3">${{ $subscriptions[$i]->price + 2 }} - Every 3 months
                                    </option>
                                    <option value="0">${{ $subscriptions[$i]->price + 3 }} - One-time purchase
                                    </option>
                                    <option value="-1">PAUSE subscription</option>
                                    <option value="-2">Remove subscription</option>
                                </select>

                            </form>
                            <button data-quantity="1" data-name="{{ $subscriptions[$i]->name }}" data-plan="1"
                                data-img="{{ $subscriptions[$i]->img }}" data-id="{{ $subscriptions[$i]->id }}"
                                data-basePrice="{{ $subscriptions[$i]->price }}"
                                data-price="{{ $subscriptions[$i]->price }}"
                                class="sub-update button uppercase">Update Subscription</button>

                        </div>
                    @endfor

                </div>
            </section>
        @else
            <section class="section maxw1035">
                <div class="alert-info w100per">
                    <p><span class="material-icons">star</span>&nbsp;You don't have subscriptions.</p>
                </div>
                <br>
            </section>

            @include('includes.shop-products')

        @endif

    </div>

</main>
