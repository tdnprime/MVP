<dialog id="popup" class="exit-intent-popup">
    <a href="#" class="close-dialog">X</a>
    <form action="/apply/preorder" method="post">
        @csrf
        <div class="preorder-wrapper">
            <h3 class="ginormous">Can't find it?</h3>
            <div id="preorder-grid" class="three-col-grid">
                <p class="p-large">Pre-order it&nbsp;<span class="material-icons">arrow_forward</span></p>
                <input required class="margin-top-zero" type="text" name="product" placeholder="Product name" />
                <input type="submit" value="PRE ORDER" />
            </div>
        </div>
    </form>
</dialog>
