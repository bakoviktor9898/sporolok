<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPrice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','price_id'];
    public $timestamps = false;

    public function price(){
        return $this->hasOne(Price::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
