<?php

namespace App\Http\Controllers\Admin\Utilities;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WaterManageController extends Controller
{
    public function index(Request $request) {
        return view('admin/utilities/water-manage');
    }
}
