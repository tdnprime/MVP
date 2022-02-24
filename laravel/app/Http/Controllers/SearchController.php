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
                'users.profile_photo_path', 'boxes.box_url', 'boxes.page_name',
                'boxes.proddesc', 'users.id')
            ->get();

        if (!isset($creator[0]->id)) {

            return view('search.index', compact('user', 'user'))
                ->with('invite', $request['creator']);
        }

        $user = Auth::user();
        $subscribers = DB::table("subscriptions")
            ->join('users', 'users.id', '=', 'subscriptions.creator_id')
            ->where('subscriptions.creator_id', '=', $user->id)
            ->where('sub_id', '<>', null)
            ->select('users.family_name', 'users.given_name',
                'users.profile_photo_path', 'subscriptions.*',
                'subscriptions.price', 'subscriptions.frequency',
                'subscriptions.admin_area_1', 'subscriptions.country_code')
            ->get();

        return view('search.index', compact('user', 'user'))
            ->with('results', $creator)
            ->with('subscribers', count($subscribers));

    }
}
