<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Shippo;
use Shippo_Transaction;

class LabelsController extends Controller
{
    private function PDFMerge()
    {
        $pdfMerger = PDFMerger::init();
      
    }

    public function generate()
    {
        $config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);

        $id = auth()->user()->id;
        // Add date logic
        $subs = DB::table('subscriptions')
            ->where('creator_id', '=', $id)
            ->where('status', '=', 1)
            ->select('*')
            ->get();

        $token = $config['shippo']['token'];
        Shippo::setApiKey($token);
        $pdfMerger = PDFMerger::init();
        $count = count($subs);
        for ($i = 0; $i < $count; $i++) {
            // Purchase the desired rate.
            $transaction = Shippo_Transaction::create(array(
                'rate' => $subs[$i]->rate_id,
                'label_file_type' => "PDF_4x6",
                'async' => false));

            // Retrieve label url and tracking number or error message
            if ($transaction["status"] == "SUCCESS") {
                if ($transaction["object_state"] == "VALID") {
                    // Combine for printing
                    fopen(dirname(__DIR__, 3) . "/storage/app/public/pdf/label.pdf", "w");
                    file_put_contents(dirname(__DIR__, 3) . "/storage/app/public/pdf/label.pdf", file_get_contents( $transaction['label_url']));
                   $pdfMerger->addPDF(dirname(__DIR__, 3) . "/storage/app/public/pdf/label.pdf", 'all');
                   $pdfMerger->merge();
                   return $pdfMerger->save('file_path.pdf', 'browser');
                
                    // Save object_id + tracking number

                    //Send tracking number to PayPal
                }

            } else {
                //
            }


        }
    }
}
