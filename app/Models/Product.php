<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    public $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'stock',
        'discount',
        'image_url',
        'slug',
        'brand_id',
        'category_id',
        'delete_at'
        
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


    public function brand(){

    return $this->belongsTo(Brand::class, 'brand_id');
    }
}
