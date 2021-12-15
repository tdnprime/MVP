<!DOCTYPE html>
<html>
<head>
    @include('includes.meta');
</head>
<body id='home'>
    <div id="progress">
      <div id="bar"></div>
    </div>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header');
        @include('includes.menu');

        {{-- #FEEDBACK
	/*This is the first point of contact in getting feedback from users.
	We present them with an easy to-do first step and once they submit their
	answer, we ask them if they care to tell us why they chose that answers. At this point, their options are "yes" and "no". If they chose "yes" then we show them the feedback form in a modal window. We submit all responses via Ajax.*/ --}}
        <main>
            <section id='left-aside'></section>
            <aside id='panel'>
                <div id='sentiment-survey' class='bg-yellow'>
                    <h1 class='secondary-color'>How do you feel about Boxeon?</h1>
                    <div class='four-col-grid'>
                        <span class='material-icons'>sentiment_neutral</span>
                        <span class='material-icons'>sentiment_satisfied</span>
                        <span class='material-icons'>sentiment_very_satisfied</span>
                        <span class='material-icons'>sentiment_dissatisfied</span>
                    </div>
                </div>

                @yield('content');

            </aside>
            <section id='right-aside'>
            </section>
        </main>
    </div>
    @include('includes.footer');

    </div>
</body>
</html>
