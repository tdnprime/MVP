<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function creator(Request $request)
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

        $creator = DB::table('users')
            ->join('boxes', 'boxes.user_id', '=', 'users.id')
            ->where('users.given_name', 'like', '%' . $request['creator'] . '%')
            ->select('users.given_name', 'users.family_name',
                'users.profile_photo_path', 'boxes.box_url',
                'boxes.proddesc', 'users.id')
            ->get();

        $subscribers = DB::table('subscriptions')
            ->where('creator_id', '=', $creator[0]->id)
            ->select('creator_id')
            ->get();

        return view('search.index', compact('user', 'user'))
            ->with('results', $creator)
            ->with('subscribers', count($subscribers));

    }
}
