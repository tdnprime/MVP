<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        if (!$id = auth()->user()) {
         
            $pattern = "/";
            $box_url = str_replace($pattern, "", $_SERVER["REQUEST_URI"]);
            $boxes = DB::table('boxes')
                ->where('box_url', '=', $box_url)
                ->select('user_id')
                ->get();
            $user = User::find($boxes[0]->user_id);
            return view('subscription_box.index', compact('boxes', 'user'))
                ->with('i', (request()->input('page', 1) - 1) * 5);

        } else {
            
            $id = auth()->user()->id;
            $user = User::find($id);
            $boxes = Box::latest()->paginate(5);
            return view('subscription_box.index', compact('boxes', 'user'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
            
        }

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

        if ($user->boxes()->first() != null) {
            return redirect()->route('box.edit', $id)
                ->with('success', 'Subscription Box already exist');
        }

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

        $box->pre_order = $request->input('pre_order');
        $box->special_offer = $request->input('special_offer');
        $box->pre_order = $request->input('pre_order');
        $box->price = $request->input('price');
        $box->box_url = $request->input('box_url');
        $box->shipping_cost = $request->input('shipping_cost');
        $box->curation = $request->input('curation');
        $box->box_supply = $request->input('box_supply');
        $box->in_stock = $request->input('box_supply');

        $box->num_products = $request->input('num_products');
        $box->box_weight = $request->input('box_weight');
        $box->box_length = $request->input('box_length');
        $box->box_width = $request->input('box_width');
        $box->box_height = $request->input('box_height');
        $box->address_line_1 = $request->input('address_line_1');
        $box->address_line_2 = $request->input('address_line_2');
        $box->admin_area_1 = $request->input('admin_area_1');
        $box->admin_area_2 = $request->input('admin_area_2');
        $box->country_code = $request->input('country_code');
        $box->postal_code = $request->input('postal_code');
        $box->prodname = $request->input('prodname');
        $box->proddesc = $request->input('proddesc');

        $user->boxes()->save($box);
        return redirect()->route('box.edit', $id)
            ->with('success', 'Subscription Box created successfully');

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

        $box = $user->boxes()->first(); // NOTED

        return view('subscription_box.edit', compact('box', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $box = DB::table('boxes')->where('user_id', $user_id)->limit(1);

        $request->validate([
            'price' => 'required',
            'page_name' => 'required',
            'box_supply' => 'required',
            'curation' => 'required',
        ]);

        $array = array(
            'price' => $request->get('price'),
            'page_name' => $request->get('page_name'),
            'box_supply' => $request->get('box_supply'),
            'curation' => $request->get('curation'),
        );

        $box->update($array);

        return redirect()->route('box.index')
            ->with('success', 'Subscription Box updated successfully');
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
            ->with('success', 'Subscription deleted successfully');

    }
}
