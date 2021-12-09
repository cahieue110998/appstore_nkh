<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['idUser','email','address','phone','active'];

    public function User(){
        return $this->belongsTo(User::class,'idUser','id');
    }
}
