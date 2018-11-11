<?php

namespace App\Http\Controllers\Client\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function userCenter(){
        return view('client/userCenter');
    }
    
    public function updateUser(){
        return view('home/updateUser');
    }
}