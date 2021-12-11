@extends('layouts.home')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Youtube Subscription Box</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>video_id</th>
            <th>price</th>
            <th>page_name</th>
            <th>box_supply</th>
            <th>curation</th>
            <th>Actions</th>
        </tr>
        @foreach ($boxes as $box)
            <tr>
                <td>{{$box->vid}}</td>
                <td>{{$box->price}}</td>
                <td>{{$box->page_name}}</td>
                <td>{{$box->box_supply}}</td>
                <td>{{$box->curation}}</td>
                <td>
                    <form action="" method="POST">

                        <a href="" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $boxes->links() !!}

@endsection
