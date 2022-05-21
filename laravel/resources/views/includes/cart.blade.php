<main id="cart-main" class="fadein">

    <section class="cart-section">
        <div class="cart-banner">
            
            <div>
                <a href="/shop/item?id=productID"><img src="../assets/images/medium-product-img.png"></a>
                <a class="one-em-font" href="/shop/item?id=productID">
                    <h3 class="">Product name</h3>
                </a>
                <form action="/cart" method="post">
                    @csrf
                    <select class="margin-top-zero">
                        <option>$22/month - billed monthly for 1 month</option>
                    </select>
                    <input type="submit" value="ADD TO CART">
                </form>
            </div>
            <div>
                <a href="/shop/item?id=productID"><img src="../assets/images/medium-product-img.png"></a>
                <a class="one-em-font" href="/shop/item?id=productID">
                    <h3 class="">Product name</h3>
                </a>
                <p class="">$15</p>
                <button class="clearbtn">BUY</button>
            </div>
            <div>
                <a href="/shop/item?id=productID"><img src="../assets/images/medium-product-img.png"></a>
                <a class="one-em-font" href="/shop/item?id=productID">
                    <h3 class="">Product name</h3>
                </a>
                <p class="">$15</p>
                <button class="clearbtn">BUY</button>
                <button class="clearbtn">ADD TO BOX</button>
            </div>
            <div>
                <a href="/shop/item?id=productID"><img src="../assets/images/medium-product-img.png"></a>
                <a class="one-em-font" href="/shop/item?id=productID">
                    <h3 class="">Product name</h3>
                </a>
                <p class="">$15</p>
                <button class="clearbtn">BUY</button>
                <button class="clearbtn">ADD TO BOX</button>
            </div>

        </div>
        <div class="cart-header">
            <h2>Shopping cart</h2>
        </div>

        <section class="display-none">
            <div class="card-white-bg">
                <b>
                    <p>Subtotal (# items) $cost</p>
                </b>
                <button class="button yellowbtn">Proceed to checkout</button>
            </div>

        </section>

        <div class="cart-item">

            <form class="form-cart-item-select"><input checked value='productID' type="checkbox" /></form>
            <img class="w300px" src="../assets/images/medium-product-img.png" alt='products' />

            <div>
                <div>
                    <h3>Africa to the world</h3>
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


        <p class="cart-subtotal">Subtotal (# items) $cost</p>

    </section>

    <section class="hide">
        <div class="card-white-bg">
            <b>
                <p>Subtotal (# items) $cost</p>
            </b><form action="/checkout/index" method="post">
                @csrf
            <input type="submit" class="button yellowbtn" value="Proceed to checkout">
            </form>
        </div>
        <div class="card-white-bg">
            <h3>Add these items</h3>
            <div class="sidebar-prducts-stream">
            <div>
                <img src="../assets/images/thumb.jpg" alt=""/>
                <a href="#">Product name</a>
                <p>Price</p>
                <button class="clearbtn">ADD TO BOX</button>
            </div>
            </div>

        </div>
    </section>
</main>
