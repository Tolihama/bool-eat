<?php

namespace App\Http\Controllers\Api;

// require_once __DIR__ . '/../../../vendor/braintree/braintree_php/lib/Braintree.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Braintree;

use App\Order;

class CheckoutController extends Controller
{
    public function payment_request(Request $request) {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        // Order amount calculate from DB data
        $order = $request->order;
        $amount = 0;
        foreach ($order as $dish) {
            $price = DB::table('dishes')
                ->where('id', $dish['id'])
                ->select('price')
                ->first();
            $amount += $dish['quantity'] * floatval($price->price);
        }

        // Payment nonce
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
/*             'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ], */
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        if ($result->success) {
            // Send transaction to Braintree
            $transaction = $result->transaction;

            // Save order in DB
            $new_order = new Order();
            $new_order->fill($request->customer);
            $new_order->save();

            $order_id = Order::all()->last()->id;

            foreach ($order as $dish) {
                DB::table('dish_order')->insert([
                    'order_id' => $order_id,
                    'dish_id' => $dish['id'],
                    'quantity' => $dish['quantity'],
                ]);
            }


            return response()->json('Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return response()->json('An error occurred with the message: '.$result->message);
        }
    }
}
