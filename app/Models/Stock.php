<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;
    protected $table = 'stocks';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
