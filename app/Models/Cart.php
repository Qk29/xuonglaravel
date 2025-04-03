<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    public function cartDetails(){
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'cart_id', 'id');
    }
}
