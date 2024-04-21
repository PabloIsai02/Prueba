<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewardprogram extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','required_points', 'discount_percentage'];
}
