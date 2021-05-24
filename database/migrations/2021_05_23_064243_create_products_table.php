<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price');
            $table->integer('category_id');
            $table->timestamps();
        });
    for ($i=1; $i < 11 ; $i++) { 
        $product = new Product();
        $product->name = "Menü".$i;
        $product->price = 9.90 * $i;
        $product->category_id = 1;
        $product->save();
    }
    for ($i=1; $i < 11 ; $i++) { 
        $product = new Product();
        $product->name = "Burger".$i;
        $product->price = 5.90*$i;
        $product->category_id = 2;
        $product->save();
    }
    for ($i=1; $i < 11 ; $i++) { 
        $product = new Product();
        $product->name = "İçecek".$i;
        $product->price = 1.5*$i;
        $product->category_id = 3;
        $product->save();
    }
    for ($i=1; $i < 11 ; $i++) { 
        $product = new Product();
        $product->name = "Tatlı".$i;
        $product->price = 3*$i;
        $product->category_id = 4;
        $product->save();
    }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
