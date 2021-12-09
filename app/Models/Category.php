<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name','slug','status'];

    public function productTypes(){
        return $this->hasMany(ProductType::class,'idCategory','id');
    }

    public function Products(){
        return $this->belongsTo(Product::class,'idCategory','id');
    }
}
