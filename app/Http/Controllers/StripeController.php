<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    //
    public function __construct()
    {
      // Set your secret key: remember to change this to your live secret key in production
      // See your keys here https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function handleCharge(Request $request){
      // Create the charge on Stripe's servers - this will charge the user's card
      $amount = $request->amount;
      //The user gets to keep 95% of the transaction. Stripe gets 2.9% + $0.30, I keep the rest. $$$$$
      $application_fee = ($amount - ($amount * 0.029 + 0.30) - (0.95 * $amount)) *100;

      try {
          $user = \App\User::find($request->user_id);

        \Stripe\Charge::create(array(
          "amount" => $amount*100, // amount in cents, again
          "currency" => "usd",
          "source" => $request->token,
          "description" => $request->description,
          'destination' => $user->stripeAccount->stripe_id,
          'application_fee' => $application_fee
          ));

          \App\Charge::Create([
            'user_id' => $user->id,
            'amount' => $amount
          ]);
          event(new \App\Events\ChargeSucceeded($request->email, $user));
            return response()->json(['status' => 'Payment Succeeded!']);
      } catch(\Stripe\Error\Card $e) {
        // The card has been declined
        return response()->json(['status' => 'Payment Declined!']);
      }
    }
}
