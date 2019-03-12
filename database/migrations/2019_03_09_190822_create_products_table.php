<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // heavily refactor this model into stock , product product_sale_item from site https://www.vertabelo.com/blog/technical-articles/modeling-a-database-for-recording-sales-part-2-creating-tables-for-products-and-services
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->bigInteger('quantity_left');
            $table->double('cost_price',8,2);
            $table->double('selling_price',8,2);
            $table->unsignedBigInteger('media_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
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
