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
            <div class="alert alert-info">
                <p class='centered'> {{ session()->get('message') }}</p>
            </div>
        @endif
        <div class='tab-content margin-top-4-em' data-id='anchor-tab-subscriptionscriptions'
            id='subscriptionscriptions-stream'>

            @if (isset($subscriptions) && count($subscriptions) > 0)
                @foreach ($subscriptions as $box)

                    <div>
                        <a href='/{{ $box->box_url }}'><img id='image-youtube-thumb'
                                src='http://img.youtube.com/vi/{{ $box->video }}/mqdefault.jpg' /></a>
                        <div class=''>
                            <div>
                                <b> <a href='/{{ $box->box_url }}'>
                                        <h3>{{ $box->given_name }}&nbsp;{{ $box->family_name }}</h3>
                                    </a></b>
                                <p>Ships to you in {{ $box->frequency }} month intervals</p>

                            </div>
                            <div id='subscriptions-btns'>
                                <button class='clearbtn' idata-version='{{ $box->version }}'
                                    data-id='{{ $box->creator_id }}' data-plan-id='{{ $box->sub_id }}'
                                    id='btn-update-subscription'>Update</button>
                                <button id='exe-unsub' class='clearbtn' data-version='{{ $box->version }}'
                                    data-id='{{ $box->creator_id }}'
                                    data-plan-id='{{ $box->sub_id }}'>Unsubscribe</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            @elseif (isset($subscribers) && count($subscribers) > 0)

                @foreach ($subscribers as $sub)
                    <table class='subscriber'>
                        <tr>
                            <th></th>
                            <th>Paying</th>
                            <th>Interval</th>
                            <th>Location</th>
                            <th>Started</th>
                        </tr>
                        <tr>
                            <td><img class='image-user-icon' src='{{ $sub->profile_photo_path }}' />
                                {{ $sub->given_name }}&nbsp;{{ $sub->family_name }}</td>
                            <td> ${{ $sub->price }}</td>
                            <td> Every {{ $sub->frequency }} month(s)</td>
                            <td> {{ $sub->admin_area_1 }}, {{ $sub->country_code }}</td>
                            <td>{{ $sub->created_at }}</td>
                        </tr>
                    </table>
                @endforeach

            @else

                @include('includes.home-default')
            @endif
        </div>
    </aside>
    <aside></aside>
    <section id="right-aside"></section>
</main>
