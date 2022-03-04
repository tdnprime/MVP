@extends('layouts.home')
@section('content')
    <main class='fadein'>
        <section></section>
        <aside id="panel">
            <form id='form-search-inline' class='centered' action="/search/creator" method="get">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-75">
                <input type="text" value='' placeholder="Find a creator" name="creator">
                <input class='button' type='submit' value='Search'>
                    </div></div>
            </form>
            <div class='centered margin-bottom-4-em div-search-results-wrapper'>

                @if (isset($results))
                    <table class='margin-top-4-em'>
                        @foreach ($results as $creator)
                       
                         <tr> 
                                <td><a href='/{{$creator->box_url}}'><img class='image-round' src='{{ $creator->profile_photo_path }}' /></a></td>
                                <td>{{ $creator->page_name }} </td>
                                <td>{{ $creator->proddesc }}</td>
                                <td><b>{{ $subscribers }}</b> Subscribers</td>
                            </tr>
                       

                        @endforeach
                    </table>
                @elseif(isset($invite))

                    <div class='centered margin-bottom-4-em'>
                        <img class='center image-cta' src="{{ '../assets/images/congratulations.svg' }}"
                            alt="congratulations">
                        <h2 class='centered'>Congratulations!</h2>
                        <p class='center'>You can be the first to invite <a href='{{route('invitations.home')}}' class='primary-color'>{{ ucwords($invite) }} </a> to
                            Boxeon to
                            receive free shipping on any subscription box they offer.</p>
                        <br><br>
                        <div class="row">
                            <div class="col-75">
                        <a class='button' href='/invitations/home'>Get started</a>
                            </div></div>
                    </div>
                @else
                <br>
                    <svg class="center" width="147.049" height="121.639">
                        <g data-name="Group 107">
                            <path data-name="Path 574"
                                d="M129.164 80.771c15.139 16.742-28.745 40.869-64.2 40.869S4.972 102.946.764 80.771c-10.215-53.765 87.038-87.938 64.2-40.869-33.287 68.61 52.278 27.684 64.2 40.869z"
                                fill="#3f3d56">
                            </path>
                            <circle data-name="Ellipse 129" cx="1.29" cy="1.29" r="1.29"
                                transform="translate(45.687 26.087)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 130" cx="1.29" cy="1.29" r="1.29"
                                transform="translate(28.205 103.323)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 131" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(48.696 45.719)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 132" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(18.604 75.524)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 133" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(93.977 97.018)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 134" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(16.741 46.292)" fill="#d0cde1">
                            </circle>
                            <path data-name="Path 575"
                                d="M52.134 31.676h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 576"
                                d="M30.21 36.405h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 577"
                                d="M15.881 63.345h-.282v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <circle data-name="Ellipse 135" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(55.574 109.342)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 136" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(53.711 80.11)" fill="#d0cde1">
                            </circle>
                            <circle data-name="Ellipse 137" cx="0.573" cy="0.573" r="0.573"
                                transform="translate(121.49 90.714)" fill="#d0cde1">
                            </circle>
                            <path data-name="Path 578"
                                d="M52.851 97.162h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 579"
                                d="M80.65 107.336h-.286v-.286h-.143v.286h-.287v.143h.287v.287h.143v-.287h.286z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 580"
                                d="M10.434 81.83h-.287v-.287h-.143v.287h-.287v.143h.287v.286h.143v-.286h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 581"
                                d="M50.272 61.195h-.287v-.287h-.143v.287h-.284v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 582"
                                d="M32.646 44.286h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 583"
                                d="M44.401 72.515h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 584"
                                d="M27.201 90.284h-.287v-.287h-.143v.287h-.287v.143h.287v.287h.143v-.287h.287z"
                                fill="#d0cde1">
                            </path>
                            <ellipse data-name="Ellipse 138" cx="8.454" cy="1.29" rx="8.454" ry="1.29"
                                transform="translate(24.622 63.487)" fill="#6c63ff">
                            </ellipse>
                            <path data-name="Path 585"
                                d="M33.937 65.203c-3.456 0-8.6-.382-8.6-1.433s5.142-1.433 8.6-1.433 8.6.382 8.6 1.433-5.144 1.433-8.6 1.433zm0-2.579A41.61 41.61 0 0027.98 63c-1.863.284-2.355.628-2.355.77s.492.486 2.355.77a47.349 47.349 0 0011.913 0c1.862-.284 2.355-.628 2.355-.77s-.492-.486-2.355-.77a41.611 41.611 0 00-5.956-.372z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 587"
                                d="M135.711 75.641c-11.927-13.184-97.487 27.741-64.205-40.867C86.342 4.191 50.482 7.906 26.343 29.007c23.375-16.051 51.591-16.513 38.141 11.212-33.282 68.61 52.283 27.684 64.2 40.869 5.547 6.135 3.169 13.261-3.816 19.829 12.011-7.871 17.972-17.392 10.843-25.276z"
                                fill="#e6e6e6">
                            </path>
                            <path data-name="Path 588"
                                d="M65.549 121.377l-.184-.069a10.753 10.753 0 01-6.916-12.825l.044-.192.184.069a10.753 10.753 0 016.915 12.825zm-5.843-5.295a12.047 12.047 0 005.59 4.826 10.37 10.37 0 00-6.551-12.149 12.062 12.062 0 00.961 7.323z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 589"
                                d="M60.847 115.188a12.29 12.29 0 014.7 6.1 10.582 10.582 0 01-12.292-7.4 12.291 12.291 0 017.592 1.3z"
                                fill="#6c63ff">
                            </path>
                            <path data-name="Path 590" d="M108.473 41.035s-7.777 7.622-4.511 8.555 7-7 7-7z" fill="#ffb9b9">
                            </path>
                            <path data-name="Path 591" d="M116.25 66.701l-.933 4.355 7 .311-1.089-4.667z" fill="#ffb9b9">
                            </path>
                            <path data-name="Path 592" d="M138.338 93.611l-.933 4.355 7 .311-1.089-4.667z" fill="#ffb9b9">
                            </path>
                            <path data-name="Path 593"
                                d="M126.05 37.613l.622 2.489s-17.266-3.422-16.333 5.289a60.166 60.166 0 004.978 17.11s-.311 2.8.311 3.267 0 2.022 0 2.022 5.755.778 5.911-.622a9.756 9.756 0 00-.156-2.8s.311 0 0-1.556-1.568-14.1-2.5-15.811c0 0 8.256 6.323 12.612 5.545a40.993 40.993 0 001.867 14.466c2.489 8.244 2.489 9.177 2.489 9.177s2.955 15.711 2.178 17.577l-.156.778h5.755s-.467-8.244 0-9.333.467-10.422-2.178-15.088c-1.873-3.3-1.524-12.886-.5-16.674a19.591 19.591 0 00.573-8.884 10.407 10.407 0 00-4.118-6.952z"
                                fill="#2f2e41">
                            </path>
                            <circle data-name="Ellipse 139" cx="5.6" cy="5.6" r="5.6" transform="translate(125.039 3.003)"
                                fill="#ffb9b9">
                            </circle>
                            <path data-name="Path 594"
                                d="M129.161 12.57s1.711 4.978 1.556 5.911 4.978-1.867 4.978-1.867-2.022-4.978-1.4-6.378z"
                                fill="#ffb9b9">
                            </path>
                            <path data-name="Path 595"
                                d="M135.383 14.899l-5.444 2.178.311 1.867s-.467.622-.311.933-2.022 1.555-1.711 2.022-1.867 2.333-1.711 2.8-4.978 3.267-2.178 8.711a6.676 6.676 0 011.27 4.119q-.01.118-.025.237c-.311 2.333 11.822-.311 11.822-.311v-2.644s1.089-.467.933-2.489-1.089-1.089 0-2.178 1.089-.933.933-1.867c-.062-.373-.075-1.713-.067-3.188a14.154 14.154 0 00-2.888-8.634z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 596"
                                d="M132.428 18.947l-10.111 10.577L107.54 41.19l3.267 2.644 27.221-18.2s2.333-9.954-5.6-6.687z"
                                fill="#d0cde1">
                            </path>
                            <path data-name="Path 597"
                                d="M116.717 69.034s-1.089-1.867-1.867-1.244l-5.444 4.355s-9.644 2.8-.311 4.978c0 0 5.133.778 6.222 0a3.609 3.609 0 013.267-.311c.467.311 6.378-.156 6.378-1.4s-3.26-6.683-3.26-6.683-1.87 2.171-4.985.305z"
                                fill="#2f2e41">
                            </path>
                            <path data-name="Path 598"
                                d="M138.805 95.944s-1.089-1.867-1.867-1.244l-5.444 4.355s-9.644 2.8-.311 4.978c0 0 5.133.778 6.222 0a3.609 3.609 0 013.267-.311c.467.311 6.378-.156 6.378-1.4s-3.26-6.683-3.26-6.683-1.874 2.172-4.985.305z"
                                fill="#2f2e41">
                            </path>
                            <path data-name="Path 599"
                                d="M123.928 6.382s.947-8.323 9.045-5.96c0 0 5.729-1.165 7.752 5.99l2.054 7.5-.94-.489-.416.956-1.5.411-.67-1.268-.282 1.561-10.361 2.095a16.1 16.1 0 003.479-9.867l-1.029 1.135z"
                                fill="#2f2e41">
                            </path>
                            <path data-name="Path 602"
                                d="M41.055 60.267l-5.82-5.82a5.266 5.266 0 10-1.515 1.515l5.82 5.82zm-12.874-6.058a3.748 3.748 0 115.3 0 3.749 3.749 0 01-5.3-.002z"
                                fill="#6c63ff">
                            </path>
                        </g>
                    </svg>
                    <br>
                    <p class='center'>Waiting to search!</p>
            </div>

            @endif

        </aside>
        <section id='right-aside'></section><!-- hack !-->
    </main>
@endsection
