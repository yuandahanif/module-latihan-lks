<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    //
    protected $table = 'table_drivers';
    protected $guarded = ['id','created_at','updated_at'];

    public function order()
    {
        return $this->hasOne('App\order');
    }
}
