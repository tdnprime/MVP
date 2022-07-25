@extends('layouts.about')
@section('title', 'Boxeon.com Password Recovery')
@section('content')
    <div id="login-masthead" class="margin-top-4-em">
        <section class=" card rounded-corners maxw1035 margin-auto bg-yellow">
            <section class="section box-shadow">
                <div class="center fit-content">
                    <h2 class="extra-large-font primary-color"><span class="material-icons">circle_arrow_right</span>&nbsp;Forgot your password?</h2>
                    <p>
                        {{ __(' No problem! Enter your account\'s email and we\'ll email you a password reset link.') }}
                    </p>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <input id="email" type="email" name="email"
                                :value="old('email')" required autofocus placeholder="Email"/>
                
                            <button>
                                {{ __('EMAIL RESET LINK') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </section>
    </div>
@endsection
