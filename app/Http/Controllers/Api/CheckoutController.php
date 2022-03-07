<?php

namespace App\Http\Controllers\Api;

// require_once __DIR__ . '/../../../vendor/braintree/braintree_php/lib/Braintree.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Braintree;

class CheckoutController extends Controller
{
    public function payment_request(Request $request) {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $amount = '10';
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
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            // return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
            return response()->json('Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            // return back()->withErrors('An error occurred with the message: '.$result->message);
            return response()->json('An error occurred with the message: '.$result->message);
        }
    }
}
