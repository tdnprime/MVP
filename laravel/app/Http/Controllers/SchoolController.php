<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function what()
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }
        $array = array(
            'R0l1vo_AEvQ',
            'xJUbw7hiKV4',
            'HVxmzVoAzZM',
            'gRrw-UquIJE',
            'wXQ5zy9hC5Y',
           
            'HcjNe0ZJeZY'
        );

        return view('school.index', compact('user', $user))
            ->with('what', $array);
    }
    public function how()
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
            $array = array(
                'wLLCcOlQ284',
                'g1Yd3P3iuUg',
                'DCRV1FZei9c',
                'u4CpXQuYTZw'
            );

            return view('school.index', compact('user', $user))
                ->with('how', $array);
        }
    }
    public function why()
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }
        $array = array(
            'ad-GuV6YIMI',
            '_Es46L1ayNg',
            'dRnPvobdpew',
            'PfT4wHmSBfs'
        );

        return view('school.index', compact('user', $user))
            ->with('why', $array);
    }
}
