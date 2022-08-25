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
        Schema::create('fixed_pages', function (Blueprint $table) {
            $table->id();
            $table->string("url", 255);
            $table->string("name", 255);
            $table->string("title", 100)->nullable();
            $table->string("keyw", 255)->nullable();
            $table->string("desc", 300)->nullable();
            $table->string("image", 255)->nullable();
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
        Schema::dropIfExists('fixed_pages');
    }
};
