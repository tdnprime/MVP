<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CommissionController extends Controller
{
    public function home(){

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('commission.home', compact('user', $user));
    }
}
