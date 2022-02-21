<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')

</head>

<body id='home'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.app')

        <main class="fadein">
            <section id="left-aside">
                <h2>Labels</h2>
                <a class="anchor-sub-menu clearbtn" href="{{route('labels.generate')}}">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">label</span>
                            Generate
                        </div>
                        <div>
                        </div>
                    </div>
                </a>
                <a class="anchor-sub-menu clearbtn" href="{{route('checkout.address')}}">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">new_label</span>
                            Purchase
                        </div>
                        <div>
                        </div>
                    </div>
                </a>
                <a class="anchor-sub-menu clearbtn" href="{{route('shipping.addresses')}}">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">print</span>
                            Addresses
                        </div>
                        <div>
                        </div>
                    </div>
                </a>
            </section>
            <div id='panel'>
                @yield('content')
            </div>
            <section id="right-aside"></section>
        </main>


    </div>
    @include('includes.footer')
</body>

</html>
