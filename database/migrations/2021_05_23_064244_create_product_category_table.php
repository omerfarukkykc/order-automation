<?php

use App\Models\ProductCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->timestamps();
            
        });
        $category =new ProductCategory();
        $category->category_name = "Menü";
        $category->save();
        $category =new ProductCategory();
        $category->category_name = "Burger";
        $category->save();
        $category =new ProductCategory();
        $category->category_name = "İçecek";
        $category->save();
        $category =new ProductCategory();
        $category->category_name = "Tatlı";
        $category->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category');
    }
}
