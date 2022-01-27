<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')

</head>

<body id='home'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')

        <main class="fadein">
            <section id="left-aside">
                <h2>Shipping</h2>
                <a class="message-create" href="/box/labels" data-type-id="">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">label</span>
                            Generate labels
                        </div>
                        <div>
                        </div>
                    </div>
                </a>
                <a class="message-create" href="/labels/purchase" data-type-id="">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">new_label</span>
                            Purchase labels
                        </div>
                        <div>
                        </div>
                    </div>
                </a>
                <a class="message-create" href="/box/addresses">
                    <div class='recipients-grid'>
                        <div class='position-relative'><span class="material-icons">print</span>
                            Print addresses
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
