<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeAccount extends Model
{
    //
    protected $fillable = [
      'user_id',
      'stripe_id'
    ];
}
