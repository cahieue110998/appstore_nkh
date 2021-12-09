<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $fillable = ['idOrder','idProduct','quantity','price'];

    public function Order(){
        return $this->belongsTo(Order::class,'idOrder','id');
    }

    public function Product(){
        return $this->belongsTo(Product::class,'idProduct','id');
    }
}
