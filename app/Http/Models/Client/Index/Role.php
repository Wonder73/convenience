<?php

namespace App\Http\Models\Client\Index;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primarykey = 'id';
    protected $fillable = [];
    public $timestamps = false;
    
}
