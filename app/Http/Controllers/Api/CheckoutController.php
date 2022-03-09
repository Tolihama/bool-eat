<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Braintree;

// DB Models
use App\Order;
use App\Restaurant;

// Mail Models
use App\Mail\ConfirmOrderMailToCustomer;
use App\Mail\ConfirmOrderMailToRestaurant;

class CheckoutController extends Controller
{
    public function payment_request(Request $request) {
        /**
         * TODO: VALIDAZIONE DELLA FORM CON I RIFERIMENTI DEL CLIENTE
         */


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

            // Confirm Order Mail to Customer
            $restaurant_name = Restaurant::find($request->customer['restaurant_id'])->first()->name;
            // $request->customer['customer_email']
            Mail::to('toli@toli.it')->send(new ConfirmOrderMailToCustomer($restaurant_name, $transaction->id));

            // Confirm Order Mail to Restaurant
            $restaurant_email = Restaurant::find($request->customer['restaurant_id'])->user()->first()->email;
            Mail::to($restaurant_email)->send(new ConfirmOrderMailToRestaurant($transaction->id));

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
