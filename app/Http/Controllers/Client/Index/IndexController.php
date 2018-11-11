<?php

namespace App\Http\Controllers\Client\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
  public function index(Request $request){
    return view('client\index');
  }
}
