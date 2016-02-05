@extends('layouts.app')

@section('content')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
jQuery(function($) {
$('#sign-up-form').submit(function(event) {
    var $form = $(this);
    console.log('SUBMIT')
    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);
     Stripe.setPublishableKey("{{env('STRIPE_KEY')}}");
    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});

function stripeResponseHandler(status, response) {
  var $form = $('#sign-up-form');

  if (response.error) {
    // Show the errors on the form
    console.log(response.eror);
    $form.find('button').prop('disabled', false);
  } else {
    // response contains id and card, which contains additional card details
    var token = response.id;
    console.log(token);
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="stripe_token" />').val(token));
    // and submit
    $form.get(0).submit();
  }
}
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="sign-up-form" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
            							<label class="col-md-4 control-label">Date Of Birth </label>
            							<div class="col-md-2">
            								<input type="tel" class="form-control" placeholder="Day" name="dob_day" value="{{ old('dob_day') }}">
            							</div>
            							<div class="col-md-2">
            								<select class="form-control" name="dob_month" value="{{ old('dob_month') }}">
            								 <option value="1">January</option>
            								 <option value="2">Feburary</option>
            								 <option value="3">March</option>
            								 <option value="4">April</option>
            								 <option value="5">May</option>
            								 <option value="6">June</option>
            								 <option value="7">July</option>
            								 <option value="8">August</option>
            								 <option value="9">September</option>
            								 <option value="10">October</option>
            								 <option value="11">November</option>
            								 <option value="12">December</option>
            								</select>
            							</div>
            							<div class="col-md-2">
            								<input type="tel" class="form-control" placeholder="Year" name="dob_year" value="{{ old('dob_year') }}" >
            							</div>
            						</div>

                        <div class="form-group{{ $errors->has('address_line1') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address Line 1</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address_line1" value="{{ old('address_line1') }}">

                                @if ($errors->has('address_line1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_line2') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address_line2" value="{{ old('address_line2') }}">

                                @if ($errors->has('address_line2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_city') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address City</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address_city" value="{{ old('address_city') }}">

                                @if ($errors->has('address_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('address_state') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address State</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address_state" value="{{ old('address_state') }}">

                                @if ($errors->has('address_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_zip') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address Zip</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address_zip" value="{{ old('address_zip') }}">

                                @if ($errors->has('address_zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" >
                  				<label for="number" class="col-md-4 control-label" placeholer="MUST BE U.S. NON-PREPAID DEBIT CARD">Card Number</label>

                  				<div class="col-sm-6">
                  					<input type="text" class="form-control"  data-stripe="number" value="{{ old('number') }}" >


                  				</div>
                  			</div>

                  			<div class="form-group">
                  				<label for="number" class="col-md-4 control-label">Security Code</label>

                  				<div class="col-sm-6">
                  					<input type="text" class="form-control"  data-stripe="cvc" value="{{ old('cvc') }}">
                  				</div>
                  			</div>

                  			<div class="form-group">
                  				<label class="col-md-4 control-label">Expiration</label>

                  				<div class="col-md-3">
                  					<input type="text" class="form-control"  placeholder="MM" maxlength="2" value="{{ old('exp-month') }}"data-stripe="exp-month" >
                  				</div>

                  				<div class="col-md-3">
                  					<input type="text" class="form-control"  placeholder="YYYY" maxlength="4" data-stripe="exp-year" value="{{ old('exp-year') }}">
                            <input type="hidden" data-stripe="currency" value="usd">
                  				</div>
                  			</div>



                        <div class="form-group{{ $errors->has('last_4') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last 4 Of SSN</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_4" value="{{ old('last_4') }}">

                                @if ($errors->has('last_4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
