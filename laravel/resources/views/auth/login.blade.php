
<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
    @include('includes.meta')
</head>
<body>

    <div id="container">
        @include('includes.header')
        <span></span><!-- Hack-->
        <div id="login-masthead" class="margin-top-4-em">
        <section class=" card rounded-corners maxw1035 margin-auto bg-yellow">
            <section class="section margin-top-4-em box-shadow">
            <h1 class="primary-color centered extra-large-font">Please sign in to continue</h1>
            <div class="center fit-content">
            <a class="button" href="{{ url('auth/google') }}">
            Sign in with Google
            </a>
            </div>
            <br><br><br>
            </section>
            </section>
        </div>
    </div>
    <footer>
        <div id="footer-content-wrapper" class="margin-top-4-em"> <a>&copy; {{ date('Y') }} Boxeon
                LLC.</a>
            <a href="/terms">Terms Of Use</a>
            <a href="/privacy">Privacy</a>
            <a href="/returns">Returns & Refunds</a>
            <a href="/about">About</a>
    
        </div>
        <br>
        <img id='footer-logo' src='{{ asset('../assets/images/logo-black.png') }}' alt='logo' />
        <p class='centered one-em-font'>
            244 5th Avenue, Suite 7,&nbsp;
            New York, NY 10001<br>
            service@boxeon.com<br>
            <span>646.450.4670‬</span>
        </p>
    </footer>
    
    <dialog id="dialog-feedback">
        <a href="#" class="close-dialog">X</a>
        <form>
            <fieldset class="border-bottom">
                <img class="center display-block" src="../assets/images/b.png" alt="Logo">
                <br>
                <b>
                    <p class="centered">Help us serve you better</p>
                </b>
    
            </fieldset>
            <fieldset id="start">
                <h2>What's your feedback?</h2>
                <label id="thumb_up" class="sentiment"><span class="material-icons">thumb_up</span>I like something
                </label>
                <label id="thumb_down" class="sentiment"><span class="material-icons">thumb_down</span>I don't like
                    something
                </label>
                <label id="lightbulb" class="sentiment"><span class="material-icons">lightbulb</span>I have a
                    suggestion
                </label>
            </fieldset>
            <fieldset id="like">
                <h2>What did you like?</h2>
                <textarea name="message" placeholder="Type your feedback here"></textarea>
                <br>
                <input type="submit" class="send-feedback" value="Send feedback">
            </fieldset>
            <fieldset id="dislike">
                <h2>What didn't you like?</h2>
                <textarea name="message" placeholder="Type your feedback here"></textarea>
                <br>
                <input type="submit" class="send-feedback" value="Send feedback">
            </fieldset>
            <fieldset id="suggestion">
                <h2>What's your suggestion?</h2>
                <textarea name="message" placeholder="Type your feedback here"></textarea>
                <br>
                <input type="submit" class="send-feedback" value="Send feedback">
            </fieldset>
            <fieldset id="nps">
                <h2>On a scale of 1 to 10, how likely are you to recommend Boxeon to someone?</h2>
                <div class="ten-col-grid">
                    <a class="scale" data-type-value="1" href="#">1</a>
                    <a class="scale" data-type-value="2" href="#">2</a>
                    <a class="scale" data-type-value="3" href="#">3</a>
                    <a class="scale" data-type-value="4" href="#">4</a>
                    <a class="scale" data-type-value="5" href="#">5</a>
                    <a class="scale" data-type-value="6" href="#">6</a>
                    <a class="scale" data-type-value="7" href="#">7</a>
                    <a class="scale" data-type-value="8" href="#">8</a>
                    <a class="scale" data-type-value="9" href="#">9</a>
                    <a class="scale" data-type-value="10" href="#">10</a>
                </div>
                <div id="text-nps-scale">
                    <p>Not likely</p>
                    <span></span>
                    <p>Very likely</p>
                </div>
            </fieldset>
        </form>
    </dialog>
    
    <dialog id="m">
        <a href="#" class="close-dialog">X</a><br>
        <a href="/shop/index?c=staple" class="button clearbtn">Staple Essentials</a>
        <a href="/shop/index?c=spice" class="button clearbtn">Seasoning Essentials</a>
        <a href="/shop/index?c=produce" class="button clearbtn">15 Minute Meals</a>
        <a href="/shop/index?c=body" class="button clearbtn">Body Essentials</a>
        <a href="/shop/index?c=snack" class="button clearbtn">Snacks</a>
    </dialog>
    
    <button id="feedback" class="button"><span class="show material-icons">message</span>&nbsp;Feedback</button>
    
    <div id="m-menu" class="three-col-grid">
        <a id="menu-icon" href="#" class="button white"><span class="material-icons">shop</span>&nbsp;Shop</a>
        <a href="/cart/index" class="white button"><span><img class="w30px" src="../assets/images/cart.png"
                    alt="Cart" /></span><span class="cart-count text-cart-count text-yellow"></span></a>
        <button id="m-feedback" class="button m-padding-right-zero"><span
                class=" hide material-icons">message</span>&nbsp;Feedback</button>
    </div>
    
</body>
</html>