<?php

namespace App\Http\Controllers;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class PartnerController extends Controller
{
    public function apply(Request $request)
    {

        $partner = new Partner();
        $partner->name = $request['name'];
        $partner->phone = $request['phone'];
        $partner->views = $request['views'];
        $partner->platform = $request['platform'];
        $partner->country_code = $request['country_code'];
        $partner->save((array) $partner);
        Session::flash('message', 'Thank you! Your application was received.'); 
        $user = Auth::user();
        return view('partner.index', compact('user'));

    }
}
