@extends("layouts.index")

@section('content')
<main>
<div id="panel">
<h1 class="primary-color centered">Your session has expired</h1>
<p class="centered">Please sign in to continue.</p><br>
<div class="center fit-content">
<a class="button" href="{{ url('auth/google') }}">
Sign in with Google
</a>
</div>
<br><br><br>
</div>
</main>
@endsection
