@extends('layouts.app')
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@mastashake08" />
<meta name="twitter:title" content="{{env('APP_TITLE')}}" />
<meta name="twitter:description" content="{{env('APP_TITLE')}} is a funding app that allows you to collect payments for your goals easily and effectively. Sign up for {{env('APP_TITLE')}} for free at https://www.quikpay.com" />
<meta name="twitter:image" content="http://www.jyroneparker.com/wp-content/uploads/2016/01/charity.jpg" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome To {{env('APP_TITLE')}}</div>

                <div class="panel-body">
                    {{env('APP_TITLE')}} is a simple app to get paid! The premise is simple:
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-user"></i> Sign Up </li>
                        <li class="list-group-item"><i class="fa fa-send"></i> Send Your {{env('APP_TITLE')}} URL To Anyone </li>
                        <li class="list-group-item"><i class="fa fa-usd"></i> Payments Go Straight To Your Debit Card (Must be non-prepaid and U.S.)</li>
                    </ul>
                    This web application is perfect for those who need to do fundraising, especially crowdfunding.
                    Keep 95% of all payments collected. Very simple, very straight forward. Sign up now it's free and forever will be!
                    <br>
                    <a href="/register" class="btn btn-success btn-lg">REGISTER NOW!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
