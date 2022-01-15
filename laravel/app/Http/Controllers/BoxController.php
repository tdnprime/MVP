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

        $pattern = "/";
        $box_url = str_replace($pattern, "", $_SERVER["REQUEST_URI"]);

        $box = DB::table("boxes")
            ->join('users', 'boxes.user_id', '=', 'users.id')
            ->where("box_url", '=', $box_url)
            ->select('boxes.*', 'users.given_name', 'users.family_name')
            ->get();
        $box = $box[0];
        self::setThumb($box);
        self::setShippingDetails($box);
        $user = User::find($box->user_id);
        return view('subscription_box.index', compact('box', 'user'));
    }
    /**
     * Gets and saves Youtube video ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function embedVideo()
    {
        if (isset($_POST['ytembed'])) {
            $code = $_POST['ytembed'];
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $code, $matches);
            if ($matches[1]) {
                $vid = $matches[1]; // should contain the youtube user id
                $array = [];
                $array['video'] = $vid;
                $box = DB::table('boxes')
                    ->where('user_id', $user->id)
                    ->limit(1);
                $box->update($array);
            } else {
                // Serve error message
            }
        }
    }

    private function createProduct($box)
    {
        require_once dirname(__DIR__, 3) . '/php/paypal-connect.php';
        $config = parse_ini_file(dirname(__DIR__, 3) . '/config/app.ini', true);
        $endpoint = $config['paypal']['productsEndpoint'];
        $data = [
            'name' => 'A subscription box',
            'description' => 'Various products for entertainment purposes',
            'type' => 'PHYSICAL',
            'category' => 'ENTERTAINMENT_AND_MEDIA',
            'home_url' => 'https://boxeon.com', // Update
        ];
        $media = "Content-Type: application/json, Authorization: Bearer $token";
        $cp = sendcurl(json_encode($data), $endpoint, $media);

        $box->product_id = $cp['id'];
        $array = ['product_id' => $box->product_id];

        $box = DB::table('boxes')
            ->where('user_id', $user->id)
            ->limit(1);
        $box->update($array);

        header('Refresh:0');
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
        if (gettype($box->created_at) != 'integer') {
            $created_at = (int) $box->created_at->toDateTimeString();
        } else {
            $created_at = $box->created_at;
        }
        $box->preenddate = gmdate('F d', $created_at + 2629743);
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

        if ($user->boxes()->first() != null) {
            return redirect()->route('box.edit', $id);
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
        if(isset($box)){
        self::setThumb($box);
        self::setShippingDetails($box);
        }
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
