<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->string("url",255);
            $table->string("name", 255);
            $table->string("sku", 50)->nullable();
            $table->string("short_content", 255)->nullable();
            $table->text("content")->nullable();
            $table->double("price")->nullable();
            $table->double("discount")->nullable();
            $table->integer("stock");
            $table->tinyInteger("status")->default(1);
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
};
