<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','balance', 'cost', 'total_value', 'limit', 'status'];
    public function product(){
        return $this->belongsTo(Products::class);
    }

}
