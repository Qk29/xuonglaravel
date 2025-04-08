<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'status',
        'slug',
        'delete_at'
    ];

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
