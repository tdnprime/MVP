@extends('layouts.print')

@section('content')

    <div class='label'>
        <p> <span class='fullname'>{{ $print[0]->given_name }} {{ $print[0]->family_name }}</span><br>
            {{ $print[0]->address_line_1 }}<br>
            {{ $print[0]->admin_area_2 }}<br>
            {{ $print[0]->admin_area_1 }},
            {{ $print[0]->country_code }},
            {{ $print[0]->postal_code }}</p>
    </div>

@endsection
