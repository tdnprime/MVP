@extends('layouts.box')
<?php    echo "<div id='text-modes-switch' class='center'>
    <a href='/box/$user->id/edit'class='text-edit-mode' class='centered'><span class='material-icons'>preview</span> Preview</a>
   <a href='/box/$user->id/edit' class='text-edit-mode' class='centered'><span class='material-icons'>edit</span> Edit</a>
   </div>";
   ?>
@section('content')

@include('includes.box-copy')

<?php
#EMBED YOUTUBE VIDEO

  if ( isset( $_POST[ 'ytembed' ] ) ) {
    $code = $_POST[ 'ytembed' ];
    preg_match(
      '/[\\?\\&]v=([^\\?\\&]+)/', $code,
      $matches
    );
    $vid = $matches[ 1 ]; // should contain the youtube user id
    $array = [];
    $array[ "video" ] = $vid;
    $box = DB::table('boxes')->where('user_id', $user->id)->limit(1);
    $box->update($array);
    header( "Refresh:0" );
  }
?>
@endsection
