<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    @include('includes.meta')
</head>

<body id='index'>

    <div id='container' class="display-block">
        <div id='masthead'>
        
            <div id="banner" class="center"></div>
            <aside class="centered asides call-out">
                <h2 class="font-size-3-em">Develop Africa without leaving your couch</h2>
                <p class="centered center font-1-5-em">An effortless, simple way to build Africa. We’ll send your choice
                    of 7 products produced in Africa to help you spark industrial revolutions on the continent. It’s
                    really that easy, we promise.</p>
            </aside>
            <br>
            <br>
        </div>

        <main id='margin-top-45-e'> <a id='whatis' href='#whatis'></a>

            <section class="wide section padding-top-6-em">
                <h2 class='centered white margin-bottom-0'>Be first to know when we launch.</h2>
                <h2 class='centered white margin-bottom-0'>Join our mailing list.</h2>
                <div class="new-section-inner-grid margin-bottom-2-em">
                    <span class="503-hide"></span>
                    <img class="hide" src="../assets/images/mouse.svg" alt='Mouse' />
                    <div>
                        <form id="mailing-list-form" action="pmf/email" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-75 two-col-grid">
                                    <input type="email" placeholder="Primary email" name="email">
                                    <input type='submit' value="JOIN NOW">
                                </div>
                            </div>

                        </form>
                    </div>
                    <span class="hide"></span>
                </div>
            </section>
        </main>

    </div>
    @include('includes.footer')
