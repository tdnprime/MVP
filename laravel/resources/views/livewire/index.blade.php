@extends('layouts.home')
@section('content')
    <main class='fadein'>
        <section>
        </section>
        <aside id="panel">
            <div>
                @livewireScripts
                
                <input wire:model="products" type="text" placeholder="Search products"/>
             
                <ul>
                    @if(isset($products))
                    @foreach($products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class='centered margin-bottom-4-em'>

                @if (isset($results))
                    <div class='row margin-top-4-em'>
                        @foreach ($results as $creator)
                            <div class='div-search-results-wrapper'>
                                <a href='/{{ $creator->box_url }}'><img class='image-round'
                                        src='{{ $creator->profile_photo_path }}' /></a>
                            <a class='margin-auto search-result-page-name' href='/{{ $creator->box_url }}'>{{ $creator->page_name }}</a>

                            </div>
                        @endforeach
                    </div>
                @elseif(isset($invite))
                    <div class='centered margin-bottom-4-em'>
                        <img class='center image-cta' src="{{ '../assets/images/congratulations.svg' }}"
                            alt="congratulations">
                        <h2 class='centered'>Congratulations!</h2>
                        <p class='center'>You can be the first to invite <a href='{{ route('invitations.home') }}'
                                class='primary-color'>{{ ucwords($invite) }} </a> to
                            Boxeon to
                            receive free shipping on any subscription box they offer.</p>
                        <br><br>
                        <div class="row">
                            <div class="col-75">
                                <a class='button' href='/invitations/home'>Get started</a>
                            </div>
                        </div>
                    </div>
            @endif

        </aside>
        <section id='right-aside'></section><!-- hack !-->
    </main>
@endsection
