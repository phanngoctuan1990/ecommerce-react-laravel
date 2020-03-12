<?php

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
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price')->default(0);
            $table->decimal('original_price')->default(0);
            $table->string('seller_name')->nullable();
            $table->integer('ratings')->unsigned()->default(0);
            $table->integer('number_of_ratings')->unsigned()->default(0);
            $table->unsignedTinyInteger('is_fast_shipping')->unsigned()->default(0)->comment('flag to check fast shipping or not (0 => false, 1 => true)');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->decimal('prev_price')->nullable();
            $table->text('snack_bar_message')->nullable();
            $table->dateTime('time_stamp')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
