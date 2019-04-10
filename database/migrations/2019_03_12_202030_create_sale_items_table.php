<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            // TODO add cost price here for profit loss report
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->integer('quantity_sold');
            $table->decimal('tax',14,4)->default(0.05);
            $table->decimal('price_per_unit',8,3);
            $table->decimal('price',8,3);
            $table->timestamps();
        });

         Schema::table('sale_items', function (Blueprint $table) {
             $table->foreign('product_id')->references('id')->on('products');
             $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
