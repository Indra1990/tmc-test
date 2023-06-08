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
            $table->uuid('id')->primary();
            $table->string('sku')->nullable(false)->unique() ;
            $table->string('name')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->string('category_id')->nullable(false);
            $table->integer('created_by');
            $table->timestamps();

            $table->index(['sku','name','price','stock','created_at']);

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
