<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{

    use HasFactory;

    protected $table = 'product_types';
    protected $fillable = ['idCategory','name','slug','status'];

    public function Category(){
        return $this->belongsTo(Category::class,'idCategory','id');
    }
    public function Products(){
        return $this->hasMany(Product::class,'idProductType','id');
    }
}
