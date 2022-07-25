@extends('layouts.about')
@section('title', 'Boxeon.com Create Account')
@section('content')
    <div id="login-masthead" class="margin-top-4-em">

        <section class=" card rounded-corners maxw1035 margin-auto bg-yellow">
           
            <section class="section box-shadow">
                <div class="center fit-content">
                    <h2 class="extra-large-font primary-color"><span class="material-icons">circle_arrow_right</span>&nbsp;Register new account</h2>

                    <form method="POST" action="{{ route('register.account') }}">
                        @csrf
                        <div>
                            <input id="name" type="text" name="given_name" :value="old('given_name')" required
                                autofocus autocomplete="name" placeholder="Given name" />
                            <input id="name" type="text" name="family_name" :value="old('family_name')" required
                                autofocus autocomplete="name" placeholder="Family name" />

                        </div>
                        <div>
                            <input id="email" type="email" name="email" :value="old('email')" required
                                placeholder="Email" />
                        </div>
                        <div>
                            <input id="password" type="password" minlength="8" name="password" required autocomplete="new-password"
                                placeholder="Password" />
                        </div>
                        <div>
                            <input id="password_confirmation" minlength="8" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="Confirm password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div>
                                <label for="terms">
                                    <div class="flex items-center">
                                        <input type="checkbox" required name="terms" id="terms" />

                                        <div>
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('privacy') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button class="ml-4">
                                {{ __('REGISTER') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
      
    </section>
</div>

@endsection
