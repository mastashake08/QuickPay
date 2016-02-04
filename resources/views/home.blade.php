@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Share your personal link so anyone in the world can send you money!
                    <br>
                    <h2><a target="_blank" href="{{url(Auth::user()->slug)}}">{{url(Auth::user()->slug)}}</a></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Payments</div>

                <div class="panel-body">
                    You have made ${{Auth::user()->charges->sum('amount')}} over the lifetime of your account.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
