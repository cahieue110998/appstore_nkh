<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name','slug','description','quantity','price','promotional','idCategory','idProductType','image','status'];

    public function productType(){
        return $this->belongsTo(ProductType::class,'idProductType','id');
    }

    public function Category(){
        return $this->belongsTo(Category::class,'idCategory','id');
    }
}
