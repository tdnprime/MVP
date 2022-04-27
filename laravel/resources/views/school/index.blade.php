@extends('layouts.home')
@section('title', 'Boxeon | Learn')

@section('content')
    <main class='fadein' id="podcast">
        <section>

            <div class='grid-gap margin-bottom-10-em'>
                <img class='w300' src='../assets/images/{{$article[0]->img}}' alt='Youtube creator'>
              
                <div class='display-grid'>
                    <span></span>

                    <div>
                        <h1 class='w300'>{{$article[0]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>

                </div>
            </div>

            <div class='grid-gap margin-bottom-10-em'>
                <img class='w300' src='../assets/images/{{$article[1]->img}}' alt='Youtube creator'>
                <div class='display-grid'>
                    <span></span>

                   <div>

                        <h1 class='w300'>{{$article[1]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                   </div>
                </div>
            </div>
        </section>

        <aside id='panel'>


            <div class='grid-gap margin-bottom-10-em'>
                <img class='w600' src='../assets/images/{{$article[2]->img}}' alt='Youtube creator'>
                <div class='display-grid'>
                    <span></span>

                    <div>

                        <h2 class='w600'>{{$article[2]->title}}</h2>
                        <audio  class='w600' controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
            </div>

            <br>

            <div class='two-col-grid grid-gap margin-bottom-10-em'>
                <img class='w300' src='../assets/images/{{$article[3]->img}}' alt='Youtube creator'>
                <div class='display-grid'>
                    <span></span>

                    <div>

                        <h1 class='w300'>{{$article[3]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
            </div>

            <div class=' two-col-grid grid-gap margin-bottom-10-em'>
                <div class='display-grid'>
                    <span></span>

                    <div>

                        <h1 class='w300'>{{$article[4]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
                    <img class='w300' src='../assets/images/{{$article[4]->img}}' alt='Youtube creator'>

                
            </div>
            <div class='two-col-grid grid-gap margin-bottom-10-em'>
                <img class='w300' src='../assets/images/{{$article[5]->img}}' alt='Youtube creator'>
                <div class='display-grid'>
                    <span></span>
                    <div>
                        <h1 class='w300'>{{$article[5]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
            </div>


            <div class='two-col-grid grid-gap margin-bottom-10-em'>
                <div class='display-grid'>
                    <span></span>
                    <div>
                        <h1 class='w300'>{{$article[6]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
                    <img class='w300' src='../assets/images/{{$article[6]->img}}' alt='Youtube creator'>
            </div>


        </aside>
        <section id="right-aside">
            <div class='grid-gap margin-bottom-10-em'>
                <img class='w300' src='../assets/images/{{$article[7]->img}}' alt='Youtube creator'>
                <div class='display-grid'>
                    <span></span>
                    <div>
                        <h1 class='w300'>{{$article[7]->title}}</h1>
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                </div>
            </div>

                <div class='grid-gap margin-bottom-10-em'>
                    <img class='w300' src='../assets/images/{{$article[8]->img}}' alt='Youtube creator'>
                    <div class='display-grid'>
                        <span></span>
                        <div>
                            <h1 class='w300'>{{$article[8]->title}}</h1>
                            <audio controls>
                                <source src="horse.ogg" type="audio/ogg">
                                <source src="horse.mp3" type="audio/mpeg">
                              Your browser does not support the audio element.
                              </audio>
                        </div>
                    </div>
                </div>
        </section>

    </main>
    <span class='display-block margin-bottom-10-em'></span>
    
    <h2 class="centered">How it works</h2>
    <div id="how-it-works" class="four-col-grid">
      <div> <img src="../assets/images/computer.svg" alt="Computer"/> <h2>Survey fans</h2></div>
      <div> <img src="../assets/images/box.svg" alt="Box"/> <h2>Create box</h2></div>
      <div> <img src="../assets/images/camera.svg" alt="Camera"/> <h2>Share box</h2></div>
      <div> <img src="../assets/images/growth.svg" alt="Growth"/> <h2>Earn</h2></div>
    </div>
    <section class='section'> <br>
      <div class="centered margin-bottom-10-em">
        <h1 class="extra-large-font darkblue">It's that simple</h1>
        <br>
        <a class="button" href="{{ url('auth/google') }}"> Apply now </a> </div>
    </section>
@endsection
