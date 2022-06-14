<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function producttags(){
        return $this->hasMany(ProductsTag::class , 'product_id');
    }
}
