<?php

namespace App\Http\Controllers;

use Livewire\Component;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SearchProducts extends Component
{
    public $search = '';
 
    public function render()
    {
        return view('livewire.index', [
            'products' => Products::where('name', $this->search)->get(),
        ]);
    }
}



class SearchController extends Controller
{
    public function index()
    {
        
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }
    
        return view('livewire.index', compact('user', 'user'));

    }
}
