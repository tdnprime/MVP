<main id="cart-main" class="fadein">

    <section class="cart-section center">

        <div class="cart-header">
            <h2>Shopping cart</h2>
        </div>

        <section class="display-none">
            <div class="card-white-bg">
                <b>
                    <h2 class="cart-subtotal black-font font-size-2-em">Subtotal (# items) $cost</h2>
                </b>
                <button class="button yellowbtn">Proceed to checkout</button>
            </div>

        </section>

        <div class="cart-item">

            <form class="form-cart-item-select"><input checked value='productID' type="checkbox" /></form>
            <img class="w300px" src="../assets/images/medium-product-img.png" alt='products' />

            <div>
                <div>
                    <h3>3-month Reliable Develop Africa Subscription</h3>
                    <p class="stock">In stock</p>
                </div>
                <div class="cart-item-updater">
                    <form><select name="quantity">
                            <option value="1">Qty: 1</option>
                            <option value="2">Qty: 2</option>
                            <option value="3">Qty: 3</option>
                            <option value="4">Qty: 4</option>
                            <option value="5">Qty: 5</option>
                            <option value="6">Qty: 6</option>
                            <option value="7">Qty: 7</option>
                        </select></form>
                    <a class="primary-color" href="#">Delete</a>
                    <a class="primary-color" href="#">Save for later</a>
                </div>
            </div>

            <p class='cart-item-price'>Price</p>
        </div>

        <h2 class="cart-subtotal black-font font-size-2-em">Subtotal (# items) $cost</h2>

    </section>

    <section class="hide">
        <div class="card-white-bg">
            <b>
                <h2 class="cart-subtotal black-font font-size-2-em">Subtotal (# items) $cost</h2>
            </b>
            <form action="/checkout/index" method="post">
                @csrf
                <input type="submit" class="button yellowbtn" value="Proceed to checkout">
            </form>
        </div>
    </section>
</main>
