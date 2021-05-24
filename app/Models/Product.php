<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name','price'];
    public function getCategory(){
        return $this->hasOne('App\Models\ProductCategory','product_id');
    }
}
