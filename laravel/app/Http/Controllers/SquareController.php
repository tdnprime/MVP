<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Nikolag\Square\Facades\Square;
use Nikolag\Square\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SquareController extends Controller
{
    private function charge(Request $request)
    {
        return $transaction = Square::charge([
            'amount' => '500',
            'card_nonce' => $request['card'],
            'location_id' => env('SQUARE_LOCATION'),
            'currency' => 'USD',
            'source_id' => 'xxxxxxxx',
        ]);
    }
    private function createCustomer($buyer)
    {

        $arr = array(
            'first_name' => $buyer->given_name,
            'last_name' => $buyer->family_name,
            'company_name' => $buyer->given_name . "" . $buyer->family_name,
            'nickname' => $buyer->given_name ?? '',
            'phone' => $buyer->phone ?? '',
            'note' => $buyer->note ?? '',
            'email' => $buyer->email,
        );
        $customer = new Customer($arr);
        // $customer->save();
        return $customer;

    }
    private function chargeWithCustomer(Customer $customer)
    {

        $transaction = Square::setCustomer($customer)
            ->charge([
                'amount' => '500',
                'card_nonce' => 'xxxxx',
                'location_id' => 'xxxxx',
                'currency' => 'USD',
                'source_id' => 'xxxxxx',
            ]);
        return $transaction;
    }
    public function labels(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        //process data, find or create customer, create product, create plan
        $buyer = DB::table('boxes')
        ->join('users', 'users.id', '=', 'boxes.user_id')
        ->where('user_id', '=', $user->id)
        ->select('users.given_name', 'users.family_name', 
        'boxes.address_line_1', 'users.email',
        'boxes.address_line_2', 'boxes.admin_area_1',
        'boxes.admin_area_2', 'boxes.country_code', 'boxes.postal_code')
        ->get();

       // $customer = self::createCustomer($buyer[0]);
        self::charge();
    }

}
