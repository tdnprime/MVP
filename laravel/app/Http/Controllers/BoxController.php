<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

        $pattern = "/";
        $box_url = str_replace($pattern, "", $_SERVER["REQUEST_URI"]);

        $box = Box::join('users', 'boxes.user_id', '=', 'users.id')
            ->where("box_url", '=', $box_url)
            ->select('boxes.*', 'users.given_name', 'users.family_name')
            ->get();

        if (isset($box[0])) {
            $box = $box[0];
            self::setThumb($box);
            self::setShippingDetails($box);
            //$user = User::find($box->user_id);
            return view('box.index', compact('user', 'user'))
                ->with('box', $box);
        }
    }

public function serve(Request $request){

    $box_name = $request["name"];

    if ($user = Auth::user()) {
        $id = auth()->user()->id;
        $user = User::find($id);
    }

    return view('box.'. $box_name, compact('user', 'user'));


}

    public function setCookie(Request $request)
    {
        $minutes = 10;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('name', 'box', $minutes));
        return $response;
    }
    public function createProduct($id)
    {

        //Create a Product on PayPal

    }
    /**
     * Gets and saves Youtube video ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function embed(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        if (isset($request['ytembed'])) {
            $code = $request['ytembed'];
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $code, $matches);
            if ($matches[1]) {
                $vid = $matches[1];
                $array = [];
                $array['video'] = $vid;
                $box = DB::table('boxes')
                    ->where('user_id', $user->id)
                    ->limit(1);
                $box->update($array);

                // self::createProduct($user->id); use if PayPal subscription is enabled

                Session::flash('message', 'Your box is live at');
                return redirect()->route('box.edit', $id);
            } else {
                return redirect()->route('box.edit', $id)
                    ->with('message', 'Oops! Something went wrong. Please try again.');
            }
        }
    }

    private function fileCheck($img)
    {
        $response = get_headers($img, 1);
        return $file_exists = strpos($response[0], '404') === false;
    }

    private function setThumb($box)
    {
        $img0 = 'https://img.youtube.com/vi/' . $box->video . '/maxres0.jpg';
        $img1 = 'https://img.youtube.com/vi/' . $box->video . '/maxres1.jpg';
        $img2 = 'https://img.youtube.com/vi/' . $box->video . '/maxres2.jpg';
        $img3 = 'https://img.youtube.com/vi/' . $box->video . '/maxres3.jpg';
        $img4 = 'https://img.youtube.com/vi/' . $box->video . '/hqdefault.jpg';

        if (self::fileCheck($img0)) {
            $image = $img0;
        } elseif (self::fileCheck($img1)) {
            $image = $img1;
        } elseif (self::fileCheck($img2)) {
            $image = $img2;
        } elseif (self::fileCheck($img3)) {
            $image = $img3;
        } else {
            $image = $img4;
        }
        $box->image = $image;
    }

    private function setShippingDetails($box)
    {
        //;

        $box->preenddate = $box->created_at->addMonths(1)->diffForHumans();
        if ($box->shipping_cost == 0) {
            $box->shipping = '+ shipping';
            $box->discount = '90% off on';
            $box->shipping_cost = 1;
        } else {
            $box->shipping = 'Free shipping';
            $box->discount = 'free';
            $box->shipping_cost = 0;
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


        return view('box.create', compact('user'));
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
        $box->page_name = $request->input('page_name');

        $user->boxes()->save($box);

        return redirect()->route('box.edit', $id)
            ->with(['box' => $box]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        return view('box.show', compact('post'));
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
        if (isset($box)) {
            self::setThumb($box);
            self::setShippingDetails($box);
        }
        return view('box.edit', compact('box', 'user'));
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
    protected function url(Request $request)
    {

        $box_url = json_decode($request['url']);
        $re = DB::table('boxes')
            ->where('box_url', '=', $box_url->url)
            ->select('box_url')
            ->get();
        if (isset($re[0])) {
            return json_encode(array('msg' => 'Unavailable'));
            // return route('box.url', 'url');
        } else {
            return json_encode($url = array('msg' => 'Available'));
            //return route('box.url', 'url');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function destroy(Box $box)
    {
        $box->delete();

        return redirect()->route('box.create')
            ->with('success', 'Subscription deleted successfully');

    }
}
