<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;
    protected $table = 'purchases';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_id');
    }
}
