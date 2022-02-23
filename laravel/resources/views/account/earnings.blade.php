@extends("layouts.home")
@section('title', 'Boxeon | Earnings')
@section('content')

    <main class='fadein'>
        <section id="left-aside">
            <h2>Account</h2>
            <a class="anchor-sub-menu clearbtn" href="/account/home">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">settings</span>
                        Settings
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="anchor-sub-menu clearbtn" href="/account/earnings">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">money</span>
                        Earnings
                    </div>
                    <div>
                    </div>
                </div>
            </a>
        </section>

        <aside id='panel' class="fit-content">
            @if (session()->has('message'))
                <dialog class="alert">
                    <p class='centered'> {{ session()->get('message') }}</p>
                </dialog>
            @endif
            <div id='module'>
                <img class='center image-cta' src="{{ '../assets/images/wallet.svg' }}" alt="wallet">
                <br>
                <table>

                    <thead>
                        <th>Net income</th>
                        <th>Widthdrawn</th>
                        <th>Pending clearance</th>
                        <th>Available for withdrawl</th>
                    </thead>
                    <tr>
                        <td>$0</td>
                        <td>$0</td>
                        <td>$0</td>
                        <td>$0</td>

                    </tr>
                </table>
                <form class="margin-top-4-em" action="/account/earnings" method="get">

                    <button type="submit" class="clearbtn">Widthdraw</button>
                </form>
            </div>

        </aside>

        <section id="right-aside"></section>
    </main>

@endsection
