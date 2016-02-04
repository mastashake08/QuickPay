@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}} Payment Link</div>

                <div class="panel-body">
                  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
                  <script src="https://checkout.stripe.com/checkout.js"></script>

<button id="customButton">Pay {{Auth::user()->name}}</button>

<script>

var handler = StripeCheckout.configure({
  key: "{{env('STRIPE_KEY')}}",
  image: '/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    // Use the token to create the charge with a server-side script.
    // You can access the token ID with `token.id`
  }
});

$('#customButton').on('click', function(e) {

  var ans = prompt('How Much Would You Like To Pay?');
  if(ans >= 1){
  // Open Checkout with further options
  handler.open({
    name: '{{Auth::user()->name}}',
    description: 'QuickPay Payment',
    amount: ans*100
  });
  e.preventDefault();
}
else {
  alert('MUST BE AT LEAST $1.00!');
}
});

// Close Checkout on page navigation
$(window).on('popstate', function() {
  handler.close();

});
</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
