@extends('layouts.admin')

@section('content')
<section class="overide">
    <div id="panel">

    <p class="centered">Please sign in to continue.</p><br>
    <div class="center fit-content">
    <a class="button" href="{{ url('admin/google') }}">
    Sign in with Google
    </a>
    </div>
    <br><br><br>
    </div>
</section>
@endsection