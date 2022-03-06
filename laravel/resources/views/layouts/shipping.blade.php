<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')

</head>

<body id='home'>
    <div id="container">
        @if (session()->has('message'))
        <dialog class="alert">
            <p class='centered'> {{ session()->get('message') }}</p>
        </dialog>
        @php session()->forget('message'); @endphp
    @endif
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.app')
        <div class='margin-auto'>
            <div id='main-wrapper'>
                <main class="fadein">
                    <section id="left-aside">
                        <h2>Labels</h2>
                        <a class="anchor-sub-menu clearbtn" href="{{ route('labels.generate') }}">
                            <div class='recipients-grid'>
                                <div class='position-relative'><span class="material-icons">label</span>
                                    Generate
                                </div>
                                <div>
                                </div>
                            </div>
                        </a>
                        <a class="anchor-sub-menu clearbtn" href="{{ route('checkout.address') }}">
                            <div class='recipients-grid'>
                                <div class='position-relative'><span class="material-icons">new_label</span>
                                    Purchase
                                </div>
                                <div>
                                </div>
                            </div>
                        </a>
                        <a class="anchor-sub-menu clearbtn" href="{{ route('shipping.addresses') }}">
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
        </div>

    </div>
    @include('includes.footer')
</body>

</html>
