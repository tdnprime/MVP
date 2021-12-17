@extends("layouts.index")

@section('content')
<div id="panel">
<h1 class="centered">Your session has expired</h1>
<p class="centered">Please sign in to continue</p>
<a class="centered" href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: green;color: #ffffff;padding: 5px;border-radius:7px;" class="ml-2">
<strong>Google Login</strong>
</a>
</div>
@endsection
