@extends('layouts.home')
@section('content')
    <main class='fadein'>
        <section id='left-aside'></section>
        <aside id="panel">
            <form id='form-search-inline' class='centered' action="/search/creator" method="get">
                {{ csrf_field() }}
                <input type="text" value='' placeholder="Find a creator you love" name="creator">
                <input class='button' type='submit' value='Search'>
            </form>
            @if (isset($results))
                <table class='margin-top-4-em'>
                    @foreach ($results as $creator)
                        <tr>
                            <td><img class='image-round' src='{{ $creator->profile_photo_path }}' /></td>
                            <td>{{ $creator->given_name }}&nbsp;{{ $creator->family_name }} </td>
                            <td> Shipping {{ $creator->proddesc }}</td>
                            <td><b>{{ $subscribers }} Subscribers</b></td>
                            <td></td>
                        </tr>

                    @endforeach
                </table>
            @elseif(isset($invite))

                <div class='centered margin-bottom-4-em'>
                    <img class='center image-cta' src="{{ '../assets/images/congratulations.svg' }}" alt="congratulations">
                    <h2 class='centered'>Congratulations!</h2>
                    <p class='center'>You can invite <span class='primary-color'>{{ucwords($invite)}} </span> to Boxeon to receive free shipping on any subscription box they offer.</p>
                    <br><br>
                    <a class='button' href='/invitations/home'>Get started</a>
                </div>
            @endif

        </aside>
        <section id='right-aside'></section>
    </main>
@endsection
