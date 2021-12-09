<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['code_order','idUser','name','address','email','phone','money','message','status'];

    public function User(){
        return $this->belongsTo(User::class,'idUser','id');
    }

}
