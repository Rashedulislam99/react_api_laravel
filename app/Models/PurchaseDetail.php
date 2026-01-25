<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
   protected $table = 'purchase_details';
    public $timestamps = false;
    protected $fillable = [
         'purchase_id',
         'product_id',
         'qty',
         'price',
         'discount',
         'subtotal',];

         public function purchase()
         {
             return $this->belongsTo(Purchase::class);
         }
}
