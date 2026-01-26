<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
   public function customer()
   {
       return $this->belongsTo(Customer::class, 'customer_id');
   }
}
