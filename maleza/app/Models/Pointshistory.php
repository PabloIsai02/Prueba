<?php

namespace App\Models;
use App\Models\Customers;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointshistory extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','order_id','earned_points','redeemed_points'];

    public function customer(){
        return $this->belongsTo(Customers::class);
    }

    public function order(){
        return $this->belongsTo(Orders::class);
    }

}
