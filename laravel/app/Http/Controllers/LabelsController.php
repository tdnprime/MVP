<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Shippo;
use Shippo_Transaction;

class LabelsController extends Controller
{
  
    private function storeTracking($transaction, $sub){

      DB::table('subscriptions')
      ->where('user_id', '=', $sub->user_id)
      ->update(['tracking' => $transaction['tracking_number']]);
    }
    private function storeLabel($transaction, $sub){

      DB::table('subscriptions')
      ->where('user_id', '=', $sub->user_id)
      ->update(['label' => $transaction['object_id']]);
    }
    private function getShippingCount($id){
      $box = DB::table('boxes')
      ->where('user_id', '=', $id)
      ->select('shipping_count')
      ->get();
      return $box[0]->shipping_count;
    }
    private function updateShippingCount($id){
      $count = self::getShippingCount($id) + 1;
      DB::table('boxes')
      ->where('user_id', '=', $id)
      ->update(['shipping_count' => $count]);
    }
    private function permission($id){
      $box = DB::table('boxes')
      ->where('user_id', '=', $id)
      ->select('shipping_cost')
      ->get();
      if($box[0]->shipping_cost == 1){
        return array('msg' => 'You don\'t have shipping labels because your buyers aren\'t paying for shipping.');
      }else{
        return true;
      }
    }

    public function generate()
    {
        $config = parse_ini_file(dirname(__DIR__, 3) . 
        "/config/app.ini", true);
     
        $id = auth()->user()->id;
        $permission = self::permission($id); 
        if(is_array($permission)){
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
                   '/'.  $id . ".pdf";
                    // Merge PDFs
                    fopen($path, "w");
                    file_put_contents($path, 
                    file_get_contents($transaction['label_url']));
                    $pdfMerger->addPDF($path, 'all');
                    $pdfMerger->merge();            
                    // Save label's object_id and tracking number 
                    self::storeLabel($transaction, $subs[$i]);
                }else{
                  // Handle error
                }

            } else {
                // Handle error
            }

        }
               self::updateShippingCount($id);
               return $pdfMerger->save('labels.pdf', 'browser');
            
    }

}
