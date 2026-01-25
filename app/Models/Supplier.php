<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   public $timestamps = false;
   protected $table = 'suppliers';

   protected $fillable = [
       'name',
       'email',
       'phone',
       'address'
   ];
}
