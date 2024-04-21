<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\Models\Products;
class Orderdetails extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','product_id','quantity','unit_price'];

    public function product(){
        return $this->belongsTo(Products::class);
    }

    public function order(){
        return $this->belongsTo(Orders::class);
    }

}
