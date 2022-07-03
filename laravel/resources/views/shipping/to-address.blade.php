
        <form class='centered' action='/checkout/labels' method='post'>
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-75">
                
                @include('includes.address-collection')
                </div></div>
                <div class="row">
                    <div class="col-75">
            <input type='submit' value='Continue'>
                </div></div>
        </form>
