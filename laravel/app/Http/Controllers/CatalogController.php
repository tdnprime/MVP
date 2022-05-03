<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('catalog.index', compact('user', 'user'));
        
    }
}
