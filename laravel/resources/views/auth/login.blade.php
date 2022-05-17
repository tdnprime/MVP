@extends("layouts.index")

@section('content')
<section class="overide">
<section class="section margin-top-4-em">
<h1 class="primary-color centered extra-large-font">Please sign in to continue</h1>
<div class="center fit-content">
<a class="button" href="{{ url('auth/google') }}">
Sign in with Google
</a>
</div>
<br><br><br>
</section>
</section>
@endsection
