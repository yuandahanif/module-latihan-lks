<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    //
    protected $table = 'table_bus';
    protected $guarded = ['id','created_at','updated_at'];
    
    public function order(){
        return $this->hasOne('App\order');
    }
}
