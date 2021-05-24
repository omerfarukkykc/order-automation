<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ['total_price','user_id'];
    public function getUser(){
        return $this->hasOne("App\Models\User","id","user_id");
    }
    public function getProductList(){
        return $this->hasMany("App\Models\User","id","order_id");
    }
}
