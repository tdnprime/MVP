<main class="fadein">
    <section id="left-aside">
        <h2>Home</h2>
        <a class="message-create" href="/home/subscribers" data-type-id="">
            <div class='recipients-grid'>
                <div class='position-relative'><span class="material-icons">people_alt</span>
                    Subscribers
                </div>
                <div>
                </div>
            </div>
        </a>
        <a class="message-create" href="/home/subscriptions" data-type-id="">
            <div class='recipients-grid'>
                <div class='position-relative'><span class="material-icons">inventory_2</span>
                    Subscriptions
                </div>
                <div>
                </div>
            </div>
        </a>
    </section>

    <aside id="panel">

        @if (session()->has('message'))
            <dialog id='alert' class="alert">
                <p class='centered'> {{ session()->get('message') }}</p>
            </dialog>
        @endif

        @if (isset($subscriptions) && count($subscriptions) > 0)
            <div class='subscriptions-stream'>
                @foreach ($subscriptions as $box)
                    @php
                        if ($box->frequency == 1) {
                            $box->cadence = 'monthly';
                        } elseif ($box->frequency == 2) {
                            $box->cadence = 'every two months';
                        } elseif ($box->frequency == 3) {
                            $box->cadence = 'every ninety days';
                        }
                    @endphp
                    <div class="center">
                        <div class='subscription-card'>
                            <a href='/{{ $box->box_url }}'><img id='image-youtube-thumb'
                                    src='http://img.youtube.com/vi/{{ $box->video }}/mqdefault.jpg' /></a>
                            <div class=''>
                                <div>
                                    <b> <a href='/{{ $box->box_url }}'>
                                            <h3>{{ $box->given_name }}&nbsp;{{ $box->family_name }}</h3>
                                        </a></b>
                                    <p>Ships to you {{ $box->cadence }}.</p>

                                </div>
                                <div id='subscriptions-btns'>
                                    <button class='clearbtn' idata-version='{{ $box->version }}'
                                        data-id='{{ $box->creator_id }}' data-plan-id='{{ $box->sub_id }}'
                                        id='btn-update-subscription'>Update</button>
                                    <button class='exe-unsub clearbtn' data-version='{{ $box->version }}'
                                        data-id='{{ $box->creator_id }}'
                                        data-plan-id='{{ $box->sub_id }}'>Unsubscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
           
        @endforeach

    </div>
    
    @elseif (isset($subscribers) && count($subscribers) > 0)
        <table class='subscriber'>
            <tr>
                <th></th>
                <th>Paying</th>
                <th>Interval</th>
                <th>Location</th>
                <th>Started</th>
            </tr>

            @foreach ($subscribers as $sub)
                @php
                    if ($sub->frequency == 1) {
                        $sub->cadence = 'Monthly';
                    } elseif ($box->frequency == 2) {
                        $sub->cadence = 'Every two months';
                    } elseif ($box->frequency == 3) {
                        $sub->cadence = 'Every ninety days';
                    }
                @endphp
                <tr>
                    <td><img class='image-user-icon' src='{{ $sub->profile_photo_path }}' />
                        {{ $sub->given_name }}&nbsp;{{ $sub->family_name }}</td>
                    <td> ${{ $sub->price }}</td>
                    <td> {{ $sub->cadence }}</td>
                    <td> {{ $sub->admin_area_1 }}, {{ $sub->country_code }}</td>
                    <td>{{ $sub->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @else

        @include('includes.home-default')
        @endif

    </aside>
    <aside></aside>
    <section id="right-aside"></section>
</main>
