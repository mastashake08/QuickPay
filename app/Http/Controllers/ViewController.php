<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    //
    public function getUserPage($slug){

	$user = \App\User::Where('slug', '=', $slug);

	return view('user-profile')->with(['user' => $user]);

    }
}
