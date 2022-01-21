@extends('layouts.index')
@section('title', 'Boxeon | Blog')
@endextends
@section('content')
    <main class='fadein'>
        <section id="left-aside"></section>
        <aside id='panel'>
        @foreach ($feed as $item)

        <a href="{{$item['link']}}" target="_blank"><b>{{ $item['title']}}</b></a><br />
        <small><b>{{ $item['source']}}</b> :: {{ $item['time']}}</small><br />
        {{ $item['text']}}</a>
       
        @endforeach
        </aside>
        <section id="right-aside"></section>
    </main>
@endsection
