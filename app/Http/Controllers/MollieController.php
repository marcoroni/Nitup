<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Product;
use App\User;
use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MollieController extends Controller
{
    public function paymentRequest() {

        require_once 'https://api.mollie.nl/v1/payments';

        $mollie = new Mollie_API_Client;
        $mollie->setApiKey('test_dHar4XY7LxsDOtmnkVtjNVWXLSlXsM');

        $user = User::where('id', \Auth::user()['id'])->first();
        $orders = Order::where('user_id', $user->id)->get();

        if(!empty(Order::where('user_id', $user->id)->first())) {
            $total = 0;
            foreach ($orders as $order) {
                $total += Product::where('product_id', $order->product_id)->first()['price'] * $order->amount;
            }
        } else {
            return redirect('/')->withErrors("U heeft momenteel geen bestellingen.");
        }

        try
        {
            $payment = $mollie->payments->create(
                array(
                    'amount'      => $total,
                    'description' => 'My first payment',
                    'redirectUrl' => '/games',
                    'metadata'    => [
                        'order_id' => '12345'
                    ]
                )
            );

            /*
             * Send the customer off to complete the payment.
             */
            header("Location: " . $payment->getPaymentUrl());

            $orders = Order::where('user_id', $user->id)->delete();
            $orders->save();
            exit;
        }
        catch (Mollie_API_Exception $e)
        {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
            echo " on field " . htmlspecialchars($e->getField());
        }
    }
}
