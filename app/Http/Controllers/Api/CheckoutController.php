<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Braintree;

// DB Models
use App\Order;
use App\Restaurant;

// Mail Models
use App\Mail\ConfirmOrderMailToCustomer;
use App\Mail\ConfirmOrderMailToRestaurant;

class CheckoutController extends Controller
{
    public function payment_token() {
        // Braitree gateway
        $gateway = $this->braintree_gateway();

        // Client token generation
        $clientToken = $gateway->clientToken()->generate([
            "customerId" => config('services.braintree.customerIDTest')
        ]);

        return $clientToken;
    }

    public function payment_request(Request $request)
    {   
        // Customer data validation
        $validator = Validator::make($request->customer, [
            "customer_name" => "required|max:50",
            "customer_address" => "required|max:150",
            "customer_phone" => "required|min:9",
            "customer_email" => "required|email|max:50",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // Braitree gateway
        $gateway = $this->braintree_gateway();

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

        // Braintree transaction define
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
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

            $restaurant = Restaurant::find($request->customer['restaurant_id'])->first();

            // Confirm Order Mail to Customer
            $restaurant_name = $restaurant->name;
            Mail::to($request->customer['customer_email'])->send(new ConfirmOrderMailToCustomer($restaurant_name, $transaction->id));

            // Confirm Order Mail to Restaurant
            $restaurant_email = Restaurant::find($request->customer['restaurant_id'])->user()->first()->email;
            Mail::to($restaurant_email)->send(new ConfirmOrderMailToRestaurant($transaction->id));

            // Prepare response
            $response = [
                'transaction_id' => $transaction->id,
                'restaurant' => $restaurant,
                'customer' => $request->customer,
                'dishes' => $order,
                'amount' => $amount,
            ];

            return response()->json($response);

        } else {

            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return response()->json([
                'errors' => 'An error occurred with the message: ' . $result->message,
            ]);
        }
    }

    private function braintree_gateway() {
        return new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);
    }
}
