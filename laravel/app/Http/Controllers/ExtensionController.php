<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ExtensionController extends Controller
{
    public function fetch(){

        $creators = DB::table('_creators_')
        ->where('email', '=', null)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->get();

        return json_encode($creators);
    }

    public function save(Request $request){

        $channel = json_decode($request['channel']);

        DB::table('_creators_')
        ->where('id', '=', $channel->id)
        ->update(['email' => $channel->email]);

        return;

    }
}
