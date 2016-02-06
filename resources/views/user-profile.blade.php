@extends('layouts.app')
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@mastashake08" />
<meta name="twitter:title" content="Help {{$user->name}} reach their goal!" />
<meta name="twitter:description" content="{{$user->name}} is using {{env('APP_TITLE')}} to reach their financial goal. Help them reach it and sign up for {{env('APP_TITLE')}} for free at https://www.quikpay.com" />
<meta name="twitter:image" content="http://www.jyroneparker.com/wp-content/uploads/2016/01/charity.jpg" />
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('failure'))
    <div class="alert alert-danger">
        {{ session('failure') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}} Payment Link</div>

                <div class="panel-body">
                  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
                  <script src="https://checkout.stripe.com/checkout.js"></script>

<button id="customButton">Pay {{$user->name}}</button>

<script>



$('#customButton').on('click', function(e) {

  var ans = prompt('How Much Would You Like To Pay?');
  if(ans >= 1){
  // Open Checkout with further options
  var handler = StripeCheckout.configure({
    key: "{{env('STRIPE_KEY')}}",
    image: 'http://www.jyroneparker.com/wp-content/uploads/2016/01/charity.jpg',
    locale: 'auto',
    token: function(token) {
      console.log(token);
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
      var data = {email:token.email,token:token.id,user_id:{{$user->id}},amount:ans, description:'QuickPay Payment'};
      console.log(data);
      $.post( "charge", data, function( data ) {
        alert(data.status);
} );
    }
  });
  handler.open({
    name: '{{$user->name}}',
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
