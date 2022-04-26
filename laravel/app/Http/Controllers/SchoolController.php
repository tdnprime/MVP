<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function index()
    {
        $articles = DB::table('school')->get();
        $user = Auth::user();
        return view('school.index', compact('user', $user))
                ->with('article', $articles);
    }

    public function article(Request $request)
    {
        $article = $request['article'];
        $user = Auth::user();
        return view('school.' . $article, compact('user', $user));
    }

}
