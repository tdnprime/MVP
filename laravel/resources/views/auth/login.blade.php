@extends('layouts.about')
@section('title', 'Boxeon.com Create Account')
@section('content')
        <div id="login-masthead" class="margin-top-4-em">
            <section class=" card rounded-corners maxw1035 margin-auto bg-yellow">
                <section class="section box-shadow">
                    <div class="center fit-content">
                        <h1 class="primary-color extra-large-font"><span class="material-icons">circle_arrow_right</span>&nbsp;Sign in to continue</h1>
                        <br>
                        <a class="button" href="{{ url('auth/google') }}">
                            Sign in with Google
                        </a>
                        <div class="div-horizontal-rule"></div>
                        <form action="/auth/email" method="post">
                            @csrf
                            <div class="row">
                                <h2>Sign in with your email</h2>
                                @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-red-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                                <div class="col-75">
                                    <input name="email" required type="email" value="" placeholder="Email">
                                    <input name="password" required type="password" placeholder="Password">
                                    <input type="submit" value="Sign In">
                                    <a href="/auth/forgot" class="primary-color one-em-font">
                                        <p class="primary-color">Forgot your password?</p>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="div-horizontal-rule"></div>
                        <form action="/auth/register" method="post">
                            @csrf
                            <input type="submit" class="button" value="CREATE ACCOUNT">
                        </form>
                        <br><br><br>
                </section>
            </section>
        </div>
    </div>

</body>
</html>
@endsection
