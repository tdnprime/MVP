<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ShippingController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Shippo;
use Shippo_Transaction;

class LabelsController extends Controller
{

    private function storeTracking($transaction, $sub)
    {

        DB::table('subscriptions')
            ->where('user_id', '=', $sub->user_id)
            ->update(['tracking' => $transaction['tracking_number']]);
    }
    private function storeLabel($transaction, $sub)
    {

        DB::table('subscriptions')
            ->where('user_id', '=', $sub->user_id)
            ->update(['label' => $transaction['object_id']]);
    }
    private function getShippingCount($id)
    {
        $box = DB::table('boxes')
            ->where('user_id', '=', $id)
            ->select('shipping_count')
            ->get();
        return $box[0]->shipping_count;
    }
    private function updateShippingCount($id)
    {
        $count = self::getShippingCount($id) + 1;
        DB::table('boxes')
            ->where('user_id', '=', $id)
            ->update(['shipping_count' => $count]);
    }
    private function permission($id)
    {
        $box = DB::table('boxes')
            ->where('user_id', '=', $id)
            ->select('shipping_cost')
            ->get();
        if ($box[0]->shipping_cost == 1) {
            return array('msg' => 'You don\'t have shipping labels because your buyers aren\'t paying for shipping.');
        } else {
            return true;
        }
    }

    public function generate()
    {
        $config = parse_ini_file(dirname(__DIR__, 3) .
            "/config/app.ini", true);

        $id = auth()->user()->id;
        $permission = self::permission($id);
        if (is_array($permission)) {
            // denied
            return $permission;
        }

        $subs = DB::table('subscriptions')
            ->where('creator_id', '=', $id)
            ->where('status', '=', 1)
            ->where('order_id', '<>', null)
            ->where('rate_id', '<>', null)
            ->select('rate_id', 'user_id')
            ->get();

        $token = $config['shippo']['token'];
        Shippo::setApiKey($token);
        $pdfMerger = PDFMerger::init();

        $count = count($subs);
        for ($i = 0; $i < $count; $i++) {
            // Purchase the saved rate
            $transaction = Shippo_Transaction::create(array(
                'rate' => $subs[$i]->rate_id,
                'label_file_type' => "PDF_4x6",
                'async' => false));
            // Get label url, object_id, and tracking number
            if ($transaction["status"] == "SUCCESS") {
                if ($transaction["object_state"] == "VALID") {
                    // Set temp location
                    $path = dirname(__DIR__, 3) .
                    "/storage/app/public/tmp/labels/" . time() .
                        '/' . $id . ".pdf";
                    // Merge PDFs
                    fopen($path, "w");
                    file_put_contents($path,
                        file_get_contents($transaction['label_url']));
                    $pdfMerger->addPDF($path, 'all');
                    $pdfMerger->merge();
                    // Save label's object_id and tracking number
                    self::storeLabel($transaction, $subs[$i]);
                } else {
                    // Handle error
                }

            } else {
                // Handle error
            }

        }
        self::updateShippingCount($id);
        return $pdfMerger->save('labels.pdf', 'browser');

    }
    public function due()
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $subs = DB::table('subscriptions')
            ->where('creator_id', '=', $id)
            ->where('status', '=', 1)
            ->where('order_id', '<>', null)
            ->where('rate_id', '<>', null)
            ->select('rate', 'user_id')
            ->get();

        $addr = DB::table('boxes')
            ->where('user_id', '=', $id)
            ->select('address_line_1', 'address_line_2',
                'admin_area_1', 'admin_area_2',
                'country_code', 'postal_code')
            ->get();

        $due = array(
            'total' => $subs->sum('rate'),
            'count' => $subs->count('rate'),
        );

        return view('box.ship', compact('user', $user))
            ->with('due', $due)
            ->with('address', $addr[0]);
    }


    public function getShippingAddress($id){

      return DB::table('boxes')
      ->where('user_id', $id)
      ->select('address_line_1', 'address_line_2',
          'admin_area_1', 'admin_area_2',
          'country_code', 'postal_code')
      ->get();
    }

    // Gets the shipping rates for each subscriber
    public function rates(Request $request)
    {
        $config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);

        $id = auth()->user()->id;
        $user = User::find($id);
       
        // Use USPS.

        $subs = DB::table('subscriptions')
            ->where('creator_id', '=', $user->id)
            ->where('status', '=', 1)
            ->where('order_id', '<>', null)
            ->select('fullname', 'creator_id', 'user_id', 'address_line_1', 'address_line_2',
                'admin_area_1', 'admin_area_2',
                'country_code', 'postal_code')
            ->get();
           
        $shipping = new ShippingController();
        $total = 0;
        $count = 0;
        
        foreach ($subs as $to) {
       
            $request['to'] = $to;
        
            $rate = $shipping->rates($request);
          
            $array = array(
                'rate_id' => $rate['results'][1]->object_id,
                'rate' => $rate['results'][1]->amount,
                'shipment' => $rate['results'][1]->shipment,
                'carrier' => $rate['results'][1]->provider,
            );
            DB::table('subscriptions')
                ->where('user_id', '=', $to->user_id)
                ->update($array);

            $total += $rate['results'][1]->amount;
            $count += 1;

        }
        $due = array(
            'total' => $total,
            'count' => $count,
            'description' => 'Priority Mail Express',
            'appId' => $config['square']['appId'],
            'locationId' => $config['square']['locationId']
        );
        $address = self::getShippingAddress($id);
        return view('square.index', compact('user', $user))
            ->with('due', $due)
            ->with('address', $address[0]);

    }
    public function showAddress(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $address = self::getShippingAddress($id);
        return view('shipping.from-address', compact('user', $user))
            ->with('address', $address[0]);

    }

}
