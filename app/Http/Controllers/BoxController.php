<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Box;
use Illuminate\Http\Request;


class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $boxes = Box::latest()->paginate(5);

        return view('subscription_box.index',compact('boxes','user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function ship()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        return view('subscription_box.ship', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        return view('subscription_box.create', compact('user'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $box = new Box();

        $box->user_id = $id;
        $box->price = $request->input('price');
        $box->page_name = $request->input('page_name');
        $box->box_supply = $request->input('box_supply');
        $box->curation = $request->input('curation');
        $box->save();

        return view('home/step-one-markup');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        return view('subscription_box.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::find($user_id);

        $box = $user->boxes()->first();

        return view('subscription_box.edit' , compact('box', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id)
    {
        $box = DB::table('boxes')->where('user_id', $user_id)->limit(1);

        $request->validate([
            'price' => 'required',
            'page_name' => 'required',
            'box_supply' => 'required',
            'curation' => 'required'
        ]);

        $array = array(
            'price' => $request->get('price'),
            'page_name' => $request->get('page_name'),
            'box_supply' => $request->get('box_supply'),
            'curation' => $request->get('curation'),
           );

        $box->update($array);

        return redirect()->route('box.index')
                        ->with('success','Subscription Box updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        $box->delete();

        return redirect()->route('subscription_box.create')
                        ->with('success','Subscription deleted successfully');

    }
}
