<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Index\User;

class CheckIdentityController extends Controller
{
    //检查水电费管理员
    public function utilitiesManage(Request $request) {
        $user = new User();
        $data = $request -> all();
        $roleId = 4;
        
        //检查用户的角色
        $res = $user -> checkIdentity($data, $roleId);

        return $res;
    }
}
