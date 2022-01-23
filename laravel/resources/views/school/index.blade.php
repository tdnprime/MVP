@extends('layouts.home')
@section('title', 'Boxeon | Learn')

@section('content')
    <main class='fadein'>
        <section id="left-aside">
            <h2>Learn</h2>
            <a class="message-create" href="/school/home">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">help_center</span>
                        What
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="message-create" href="/school/how">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">quiz</span>
                        How
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="message-create" href="/school/why">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">thumb_up</span>
                        Why
                    </div>
                    <div>
                    </div>
                </div>
            </a>
        </section>

        <aside id='panel'>

            @if (isset($what) && count($what) > 0)


                @foreach ($what as $video)
                    <div id='{{$video}}' class='position-relative margin-bottom-4-em'>
                        <img class='center display-block image-youtube-thumb'
                            src='http://img.youtube.com/vi/{{ $video }}/maxres2.jpg' />
                        <a href="#/" class="play-video" data-video-id="{{ $video }}">
                            <img class="playbtn" src="/assets/images/playbtn.png" alt="Play video"></a>
                    </div>
                @endforeach


            @elseif (isset($how) && count($how) > 0)
                @foreach ($how as $video)
                    <div id='{{$video}}' class='position-relative margin-bottom-4-em'>
                        <img class='center display-block image-youtube-thumb'
                            src='http://img.youtube.com/vi/{{ $video }}/maxres1.jpg' />
                            <a href="#/" class="play-video" data-video-id="{{ $video }}">
                        <img class="playbtn" src="/assets/images/playbtn.png" alt="Play video"></a>
                    </div>
                @endforeach
            @elseif (isset($why) && count($why) > 0)
                @foreach ($why as $video)
                    <div id='{{$video}}' class='position-relative margin-bottom-4-em'>
                        <img class='center display-block image-youtube-thumb'
                            src='http://img.youtube.com/vi/{{ $video }}/maxres1.jpg' />
                            <a href="#/" class="play-video" data-video-id="{{ $video }}">
                        <img class="playbtn" src="/assets/images/playbtn.png" alt="Play video"></a>
                    </div>
                @endforeach
            @endif

        </aside>
        <section id="right-aside"></section>
    </main>
@endsection
