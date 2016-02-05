<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'address_line1' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_zip' => 'required',
            'dob_day' => 'required',
            'dob_month' => 'required',
            'dob_year' => 'required',
            'stripe_token' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $account = \Stripe\Account::create(array(
        "managed" => true,
        "country" => "US",
        "email" => $data['email'],
        "legal_entity" => [
          "dob" => [
            "day" => $data['dob_day'],
            "month" => $data['dob_month'],
            "year" => $data['dob_year']
            ],
         "first_name" => $data['first_name'],
         "last_name" => $data['last_name'],
          "type" => "individual",
          "ssn_last_4" => $data['last_4'],
          "address" => [
            "city" => $data['address_city'],
            "country" => "US",
            "line1" => $data['address_line1'],
            "line2" => $data['address_line2'],
            "postal_code" => $data['address_zip'],
            "state" => $data['address_state']
            ]
          ],
          "tos_acceptance" => [
            "date" => time(),
            "ip" => $_SERVER['REMOTE_ADDR']
            ],
       "external_account" => $data['stripe_token']
      ));
      $user = User::create([
          'name' => $data['first_name'] .' '. $data['last_name'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'api_token' => str_random(60),
          'slug' => str_random(10)
      ]);

    $stripeAccount =  \App\StripeAccount::Create([
        'user_id' => $user->id,
        'stripe_id'=> $account->id
        ]);


        return $user;
    }
}
