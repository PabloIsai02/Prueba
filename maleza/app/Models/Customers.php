<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rewardprogram;


class Customers extends Model
{
    use HasFactory;

    protected $fillable = ['name','email', 'phone','rewardprogram_id','discount_percentage', 'accumulated_points'];



    public function rewardprogram(){
        return $this->belongsTo(Rewardprogram::class);
    }
}
