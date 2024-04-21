<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers;
use App\Models\User;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'user_id', 'total_amount', 'status', 'earned_points', 'reward_redeemed'];

    public function customer(){
        return $this->belongsTo(Customers::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
