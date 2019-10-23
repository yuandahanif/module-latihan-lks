<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $table = 'table_orders';
    protected $guarded = ['id','created_at','updated_at'];

    public function bus(){
        return $this->BelongsTo('App\bus');
    }
    
    public function driver()
    {
        return $this->BelongsTo('App\driver');
    }
}
