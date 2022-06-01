<footer>

    <div id="footer-content-wrapper"> <a>&copy; {{ date('Y') }} Boxeon LLC.&nbsp;&nbsp;&nbsp;<span
                class="display-inline">Made For The Diaspora&nbsp;<img class="display-inline" src="../assets/images/heart.svg"
                    alt="Heart"></span></span></a>
        <a href="#">Terms Of Use</a>
        <a href="#">Privacy</a>
        <a href="#">Returns & Refunds</a>
        <a href="#">About</a>

    </div>
    <br>
    <img id='footer-logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
    <p class='centered one-em-font'>
        244 5th Avenue, Suite 7<br>
        New York, NY 10001<br>
        service@boxeon.com<br>
        <span>Text 646.450.4670‬</span></p>
</footer>
<!--
<dialog id="dialog-feedback" open>
    <form action="/feedback/Send feedback" method="post">
        @csrf
        <fieldset>
            <img class="center" src="../assets/images/logo.svg" alt="logo">
            <br>
            <b>
                <p class="centered">Help us improve our business</p>
            </b>
            <div class="div-horizontal-rule center"></div>
        </fieldset>
        <fieldset id="start">
            <label><span class="material-icons">thumb_up</span>I like something
            </label>
            <label><span class="material-icons">thumb_down</span>I don't like something
            </label>
            <label><span class="material-icons">lightbulb</span>I have a suggestion
            </label>
        </fieldset>
        <fieldset id="like">
            <label>What did you like?</label>
            <textarea name="message" placeholder="Type your feedback here"></textarea>
            <br>
            <input type="submit" value="Send feedback">
        </fieldset>
        <fieldset id="dislike">
            <label>What didn't you like?</label>
            <textarea name="message" placeholder="Type your feedback here"></textarea>
            <br>
            <input type="submit" value="Send feedback">
        </fieldset>
        <fieldset id="suggestion">
            <label>What's your suggestion?</label>
            <textarea name="message" placeholder="Type your feedback here"></textarea>
            <br>
            <input type="submit" value="Send feedback">
        </fieldset>
        <fieldset id="nps">
            <label>On a scale of 1 to 10, how likely are you to recommend Boxeon to someone?</label>
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


<button id="feedback"><span class="material-icons">message</span>&nbsp;Feedback</button>
!-->