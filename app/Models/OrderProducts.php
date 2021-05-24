<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table = "order_products";
    protected $fillable = ['order_id','product_id','quantities'];
    public function getProducts(){
        return $this->hasOne("Product","product_id","id");
    }
}
