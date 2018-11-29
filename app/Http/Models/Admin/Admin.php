<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected $primary = 'id';
    protected $table = 'admin';
    protected $fillable = ['username','password','remember_token','created_at','updated_at'];
}